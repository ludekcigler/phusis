<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);



function make_directory($dir_name, $permissions = 0755) {
  if (!is_dir($dir_name)) {
    mkdir($dir_name, $permissions);
  }
}

/**
 * Copy a file, or recursively copy a folder and its contents
 * @param       string   $source    Source path
 * @param       string   $dest      Destination path
 * @param       string   $permissions New folder creation permissions
 * @return      bool     Returns true on success, false on failure
 */
function xcopy($source, $dest, $permissions = 0755)
{
    // Check for symlinks
    if (is_link($source)) {
        return symlink(readlink($source), $dest);
    }

    // Simple copy for a file
    if (is_file($source)) {
        return copy($source, $dest);
    }

    // Make destination directory
    make_directory($dest, $permissions);

    // Loop through the folder
    $dir = dir($source);
    if (!$dir) {
      return false;
    }

    while (false !== $entry = $dir->read()) {
        // Skip pointers
        if ($entry == '.' || $entry == '..') {
            continue;
        }

        // Deep copy directories
        xcopy("$source/$entry", "$dest/$entry");
    }

    // Clean up
    $dir->close();
    return true;
}

function copy_with_wildcards($src_pattern, $dest_dir) {
  foreach (glob($src_pattern) as $src_file) {
    copy($src_file, sprintf('%s/%s', $dest_dir, basename($src_file)));
  }
}

function xcopy_with_wildcards($src_pattern, $dest_dir) {
  // Make plugin directory
  make_directory($dest_dir);

  foreach (glob($src_pattern) as $src_file) {
    xcopy($src_file, sprintf('%s/%s', $dest_dir, basename($src_file)));
  }
}

function xcopy_contents_with_wildcards($src_dir, $dest_dir) {
  $dir = dir($src_dir);
  if (!$dir) {
    return false;
  }

  while (false !== $entry = $dir->read()) {
    // Skip pointers
    if ($entry == '.' || $entry == '..') {
      continue;
    }

    xcopy_with_wildcards(sprintf('%s/%s/*', $src_dir, $entry), sprintf('%s/%s', $dest_dir, $entry));
  }

  $dir->close();
}

function rrmdir($dir) {
  foreach(glob($dir . '/*') as $file) {
    if(is_dir($file))
      rrmdir($file);
    else
      unlink($file);
  }
  rmdir($dir);
}

// Local directories (for testing)
// $REPO_DIR = '/Users/lcigler/Documents/Personal/Dev/phusis';
// $DEST_ROOT = '/Users/lcigler/test';
// $sites = array('opsuisse');

// Remote directories (for production)
$REPO_DIR = dirname(__FILE__).'/../repo';
$DEST_ROOT = dirname(__FILE__).'/..';
$sites = array('phusis', 'steve', 'philosophie', 'animations');

foreach ($sites as $site) {
  $theme_repo_dir = sprintf('%s/wp-content/themes/phusis', $REPO_DIR);
  $theme_dest_dir = sprintf('%s/%s/wp-content/themes/phusis', $DEST_ROOT, $site);

  // Install shared files
  copy_with_wildcards(sprintf('%s/*.*', $theme_repo_dir), $theme_dest_dir);
  xcopy(sprintf('%s/images', $theme_repo_dir), sprintf('%s/images/', $theme_dest_dir));

  // Install site-specific files
  copy_with_wildcards(sprintf('%s/%s/*.*', $theme_repo_dir, $site), $theme_dest_dir);

  // Install plugins
  $plugins_repo_dir = sprintf('%s/wp-content/plugins', $REPO_DIR);
  $plugins_dest_dir = sprintf('%s/%s/wp-content/plugins', $DEST_ROOT, $site);
  xcopy_contents_with_wildcards($plugins_repo_dir, $plugins_dest_dir);
  /*
  $dir = dir($plugins_repo_dir);
  while ($dir && false !== $entry = $dir->read()) {
    // Skip pointers
    if ($entry == '.' || $entry == '..') {
      continue;
    }

    xcopy_with_wildcards(sprintf('%s/%s/*', $plugins_repo_dir, $entry), sprintf('%s/%s', $plugins_dest_dir, $entry));
  }*/

  // Install extensions (like newsletter template)
  $ext_repo_dir = sprintf('%s/wp-content/extensions', $REPO_DIR);
  $ext_dest_dir = sprintf('%s/%s/wp-content/extensions', $DEST_ROOT, $site);
  xcopy_with_wildcards(sprintf('%s/*', $ext_repo_dir), $ext_dest_dir);
}

echo "SUCCESS!";

?>
