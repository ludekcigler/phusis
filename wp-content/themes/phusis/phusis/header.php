<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title><?php
	if (is_home()) {
		echo bloginfo('name');
	} elseif (is_404()) {
		echo '404 Not Found';
	} elseif (is_category()) {
		echo 'Category:'; wp_title('');
	} elseif (is_search()) {
		echo 'Search Results';
	} elseif ( is_day() || is_month() || is_year() ) {
		echo 'Archives:'; wp_title('');
	} else {
		echo bloginfo('name'); echo wp_title('|');
	}
	?>
	</title>


	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/phusis.css" type="text/css" media="screen" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php bloginfo('url'); ?>/xmlrpc.php?rsd" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="shortcut icon" href="/favicon.ico" />


	<!--[if lte IE 7]>
	<link href="<?php bloginfo('template_directory'); ?>/ie.css" type="text/css" rel="stylesheet" media="screen" />
	<![endif]-->

	<!--[if lte IE 6]>
	<link href="<?php bloginfo('template_directory'); ?>/ie6.css" type="text/css" rel="stylesheet" media="screen" />
	<![endif]-->

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' );?>
	<?php wp_head(); ?>

</head>

<body>
<div id="wrapper">
	<div class="search" id="<?php if (rand(0, 1) == 0) { echo 'search-phusis'; } else { echo 'search-cygne'; } ?>">
        <h1><img alt="<?php bloginfo('description'); ?>" width="480" height="42" src="<?php bloginfo('template_directory'); ?>/images/phusis_phrase_phusis.png" /></h1>
        <p id="phrase_du_jour"><a href="http://phusis.ch/phusis/aphorismes/"><?php stray_random_quote(); ?></a></p>
		<span class="twitter"><!-- If you want to integrate Twitter, use http://rick.jinlabs.com/code/twitter/ and put the code snippet here.  --></span>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
        <?php if (is_page('Bienvenue')) { ?>
        <p id="featuredposts"><span class="title">À ne pas manquer :</span> <?php get_featured_posts(array('before' => '', 'after' => '', 'max_posts' => 1, 'method' => 'echo')); ?> </p>
        <?php } ?>
	</div>

	<div id="main_nav">
		<h1 class="masthead"><a href="<?php bloginfo('url');?>/etymologie/"><?php bloginfo('name'); ?></a></h1>

		<ul>
			<?php //wp_list_pages('title_li=&depth=1'); ?>
<?php $output = wp_list_pages('echo=0&depth=1&title_li=' );
echo $output;
?>
		    <li class="otherblog"><a href="/steve/">PHUSIS Vins</a></li>
		    <li class="otherblog"><a href="/michel/">PHUSIS Philosophie</a></li>
		</ul>

        <p class="video">
            <?php if (function_exists('recent_posts')) recent_posts('included_cats=17&limit=2&prefix=&suffix=&output_template=<a href="{url}"><span class="title">{title}</span><span class="date">{date}</span><span class="preview"><img src="{videopreviewsrc}" width="64" height="48" alt="Aperçu : {title}" /><span class="flash-icon" ></span></span></a>'); ?>
        </p>


	</div>
