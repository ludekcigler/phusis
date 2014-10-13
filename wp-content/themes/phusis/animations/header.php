<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title><?php
	if (is_home()) {
		echo bloginfo('name');
	} elseif (is_404()) {
		echo '404 Pas trouvé';
	} elseif (is_category()) {
		echo 'Categorie:'; wp_title('');
	} elseif (is_search()) {
		echo 'Resultats de la recherche';
	} elseif ( is_day() || is_month() || is_year() ) {
		echo 'Archives:'; wp_title('');
	} else {
		echo bloginfo('name'); echo wp_title('|');
	}
	?>
	</title>


	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all, print" />
  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/animations.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/print.css" type="text/css" media="print" />
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

<body class="animations">
<div id="wrapper">
	<div class="search" id="<?php if (rand(0, 1) == 0) { echo 'search-phusis'; } else { echo 'search-cygne'; } ?>">
    <h1><img alt="<?php bloginfo('description'); ?>" width="520" height="42" src="<?php bloginfo('template_directory'); ?>/images/phusis_phrase_animations.png" /></h1>
    <img alt="Phusis" id="print_header" height="140" src="<?php bloginfo('template_directory'); ?>/images/cygne_print_michel.png" />

		<span class="twitter"><!-- If you want to integrate Twitter, use http://rick.jinlabs.com/code/twitter/ and put the code snippet here.  --></span>

    <!-- New menu -->
    <div id="highlight-menu">
      <?php
      /*$article_list_template = '<li><a href="{url}"><span class="date">{date:d.m.}</span> <span class="title">{title:18:trim}</span></a></li>';
      $highlight_image_template = '<a href="{url}"><img alt="{imagealt}" src="{imagesrc}" height="72" width="64" /></a>';

      $recent_posts_params='limit=3&prefix=<ul class="derniers-articles">&suffix=</ul>&output_template='.$article_list_template;*/ ?>

      <div class="highlight-menu-item">
      <div>
      <a href="<?php bloginfo('url');?>/animations/">
      <h3>Animations</h3>
      <p><img src="<?php bloginfo('template_directory'); ?>/images/animations/menu_sport.jpg" /></p>
      </a>
      </div>
      </div>

      <div class="highlight-menu-item">
      <div>
      <a href="<?php bloginfo('url');?>/communication/">
      <h3>Communication</h3>
      <p><img src="<?php bloginfo('template_directory'); ?>/images/animations/menu_communication.jpg" /></p>
      </a>
      </div>
      </div>

      <div class="highlight-menu-item">
      <div>
      <a href="<?php bloginfo('url');?>/traductions/">
      <h3>Traductions</h3>
      <p><img src="<?php bloginfo('template_directory'); ?>/images/animations/menu_traductions.jpg" /></p>
      </a>
      </div>
      </div>

      <div class="highlight-menu-item">
      <div>
      <a href="<?php bloginfo('url');?>/conferences/">
      <h3>Conférences</h3>
      <p><img src="<?php bloginfo('template_directory'); ?>/images/animations/menu_conferences.jpg" /></p>
      </a>
      </div>
      </div>

      <div style="clear:none"></div>
    </div>

		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	</div>

	<div id="main_nav">
		<h1 class="masthead"><a href="<?php bloginfo('url');?>/qui-sommes-nous/"><?php bloginfo('name'); ?></a></h1>

		<ul>
			<?php //wp_list_pages('title_li=&depth=1'); ?>
      <?php $output = wp_list_pages('echo=0&depth=1&title_li=' );
      echo $output;
      ?>
      <li class="otherblog"><a href="/phusis/">PHUSIS</a></li>
      <li class="otherblog"><a href="/philosophie/">PHUSIS Philosophie</a></li>
	    <li class="otherblog"><a href="/steve/">PHUSIS Vins</a></li>
		</ul>

	</div>
