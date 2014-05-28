<?php
global $newsletter; // Newsletter object
global $post; // Current post managed by WordPress

/*
 * Some variabled are prepared by Newsletter Plus and are available inside the theme,
 * for example the theme options used to build the email body as configured by blog
 * owner.
 *
 * $theme_options - is an associative array with theme options: every option starts
 * with "theme_" as required. See the theme-options.php file for details.
 * Inside that array there are the autmated email options as well, if needed.
 * A special value can be present in theme_options and is the "last_run" which indicates
 * when th automated email has been composed last time. Is should be used to find if
 * there are now posts or not.
 *
 * $is_test - if true it means we are composing an email for test purpose.
 */

// Helper functions
function truncateWords($input, $numwords, $padding="")
{
    $output = strtok($input, " \n");
    while(--$numwords > 0) $output .= " " . strtok(" \n");
    if($output != $input) $output .= $padding;
    return $output;
}

function create_custom_excerpt($content) {
    return truncateWords(strip_tags(preg_replace('/<a[^>]*.mp3[^>]*>[^<]*<\/a>/', '', $content)), 70, "...");
}


// This array will be passed to WordPress to extract the posts
$filters = array();

// Maximum number of post to retrieve
$filters['showposts'] = (int)$theme_options['theme_max_posts'];
if ($filters['showposts'] == 0) $filters['showposts'] = 6;


// Include only posts from specified categories. Do not filter per category is no
// one category has been selected.
if (is_array($theme_options['theme_categories'])) {
    $filters['cat'] = implode(',', $theme_options['theme_categories']);
}

// Retrieve the posts asking them to WordPress
$posts = get_posts($filters);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
  <title>Phusis newsletter</title>
  <style type="text/css">
  @media screen and (max-width:639px) {
    #comment_image {
      display: none;
    }

    table[class="wrapper"] {
      width:100% !important;
      border:
    }

    table[class="article"] {
      width:100% !important;
    }
  }
  </style>
</head>

<body>
<table cellspacing="0" cellpadding="0" class="wrapper" style="font-size: 14px; font-family: sans-serif; width: 640px; margin: 0 auto;"><tr><td>
<table cellspacing="0" cellpadding="0" id="header" width="100%">
<tr><td colspan="2"><h1 style="font-family: 'Hoefler Text', 'Constantia', Georgia, 'Times New Roman', Times, serif; font-weight: normal;"><img src="<?php bloginfo('url'); ?>/wp-content/extensions/newsletter/emails/themes/phusis/newsletter_title_philosophie.png" alt="Phusis Philosophie et Animations; Michel Herren et Cie.; www.phusis.ch" width="50%" style="min-width: 400px; max-width: 100%;"></h1></td></tr>

<tr>
<td id="comment_image" style="vertical-align: middle; padding: 30px; width: 74px;"><img src="<?php bloginfo('url'); ?>/wp-content/extensions/newsletter/emails/themes/phusis/cygne_blanche.png" width="74" height="90" alt=""></td>

<td id="newsletter_comment" style="text-align: justify; padding: 10px; font-family: sans-serif;">
GRÂCE À L’ENGAGEMENT ENTHOUSIASTE de nouveaux collaborateurs, PHUSIS a le plaisir d’ouvrir un double chantier sur Dionysos, dieu artiste de la phusis, noyau générateur de tout phénomène vivant. Sous cette rubrique, nous présentons, traduisons et (ré)actualisons – court passage après court passage – les Bacchantes : tragédie grecque d’Euripide consacrée à Dionysos. Sous la rubrique Témoignages sur Dionysos, nous ferons de même avec les multiples textes le concernant qui nous sont parvenus à travers les âges. L’enjeu est de taille : permettre à Dionysos de se dévoiler à nouveau, comme formidable clé de lecture et ressource de notre pensée et de nos vies.
</td>
</tr>
</table>

<table cellspacing="0" cellpadding="0" id="articles" width="100%">
<tr>
  <td>

            <?php
            // Do not use &post, it leads to problems...
            $post_counter = 0;
            foreach ($posts as $post) {
                $post_counter += 1;

                // Setup the post (WordPress requirement)
                setup_postdata($post);

                // The theme can "suggest" a subject replacing the one configured, for example. In this case
                // the theme, is there is no subject, suggest the first post title.
                if (empty($theme_options['subject'])) $theme_options['subject'] = $post->post_title;

                // Extract a thumbnail, return null if no thumb can be found
                $image = nt_post_image(get_the_ID());
            ?>
            <table cellspacing="0" cellpadding="0" class="article" style="width: 50%; float: left; padding: 0; margin: 0; min-height: 320px;"><tr>
              <td>
                 <h2 style="font-family: 'Hoefler Text', 'Constantia', Georgia, 'Times New Roman', Times, serif; font-weight: normal; margin: 10px; font-size: 18px;">
                   <a style="text-decoration: none;" href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
                  <p style="margin: 10px; text-align: justify; font-family: sans-serif;">
                    <?php if ($image != null) { ?>
                    <img src="<?php echo $image; ?>" width="100%" height="120px" alt="" style="margin-bottom: 10px;"><br>
                    <?php } ?>

                    <?php echo create_custom_excerpt($post->post_content); ?>
                  </p>
              </td>
            </tr></table>
<?php
}
?>
</td>
</tr>
</table>
<p style="padding: 0 10px; font-family: sans-serif;">Découvrez les activités de <a href="http://www.phusis.ch/animations/">Phusis | Animations</a> et <a href="http://www.phusis.ch/steve/">PHUSIS | Vins</a>.</p>

<p style="padding: 0 10px; font-family: sans-serif;">Pour se désinscrire de la newsletter, <a href="{unsubscription_url}">cliquez ici</a>.</p>
</td></tr></table>
</body>
</html>
