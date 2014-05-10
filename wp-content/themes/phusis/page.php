<?php get_header(); ?>

<div id="content">

	<div id="entry_content">


	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
			
            <?php
            $page_principale = get_post_meta($post->ID, 'page-principale', true);
            $categorie = get_post_meta($post->ID, 'categorie', true);
            $suite = get_post_meta($post->ID, 'suite', true);
            
            if ($page_principale == 'bienvenue' or $suite == 'bienvenue') {
				recent_posts('limit=1&prefix=&suffix=&output_template=<h2><a href="{url}" rel="bookmark" title="Permalien vers {title}">{title}</a></h2>');
            } else {
            ?>

                <p class="print_cygne"><img src="<?php bloginfo('template_directory'); ?>/images/cygne_blanche.png"></p>
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permalien vers <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                <?php if ( comments_open() ) : ?><p class="date"><span class="comments"><?php comments_popup_link('Commentaires (<span class="commentcount">0</span>)', 'Commentaires (<span class="commentcount">1</span>)', 'Commentaires (<span class="commentcount">%</span>)'); ?></span></p><?php endif; ?>
			<?php } ?>	
			<!-- Submenu -->
<?php
  //if($post->post_parent)
  //$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0&depth=1");
  //else
  if (!get_post_meta($post->ID, 'suite', true)) {
  $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0&depth=1");

  if ($children) {
    echo '<ul class="page_menu">'.$children.'</ul>';
  } else {
    if ($post->post_parent) {
        echo '<ul class="page_menu">'.wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0&depth=1").'</ul>';
    }
  } 
  } else if ($post->post_parent) {
   $post_parent = get_post($post->post_parent);
   $children = wp_list_pages("title_li=&child_of=".$post_parent->ID."&echo=0&depth=1");

  if ($children) {
    echo '<ul class="page_menu">'.$children.'</ul>';
  } else {
    if ($post_parent->post_parent) {
        echo '<ul class="page_menu">'.wp_list_pages("title_li=&child_of=".$post_parent->post_parent."&echo=0&depth=1").'</ul>';
    }
  } 
 
  }
  ?>
            
            <?php
            $page_principale = get_post_meta($post->ID, 'page-principale', true);
            $categorie = get_post_meta($post->ID, 'categorie', true);
            $suite = get_post_meta($post->ID, 'suite', true);
            if ($page_principale and function_exists('recent_posts')) {
                if ($page_principale == 'bienvenue') {
                    // Separate display for the bienvenue page avec photo du jour
                    echo '<div class="entry"><p>';
                    recent_posts('limit=1&prefix=&suffix=&output_template=<a href="{url}"><img alt="{imagealt}" src="{imagesrc}" class="alignright size-medium" /></a>');
                    //recent_posts('custom-key=suite&custom-op==&custom-value='.$page_principale.'&show_pages=true&limit=1&prefix=&suffix=&output_template={excerpt:80:a:::4} <a href="{url}">Suite ici...</a>');
                    recent_posts('limit=1&prefix=&suffix=&output_template={excerpt:80:a:::4} <a href="{url}">Suite ici...</a>');
                    echo '</p>';
                } else {
                    recent_posts('custom-key=suite&custom-op==&custom-value='.$page_principale.'&show_pages=true&limit=1&prefix=&suffix=&output_template=<div class="entry"><p><img alt="{imagealt}" src="{imagesrc}" class="alignright size-medium" />{excerpt:80:a:::4} <a href="{url}">Suite ici...</a></p>');
                }
            } else {
                echo '<div class="entry">';
                the_content('&raquo; Lisez tout &laquo;');
            }

                if ($categorie) {
                    $categoryId = get_term_by( 'slug', $categorie, 'category' );
                } /*else if ($suite) {
                    $categoryId = get_term_by( 'slug', $suite, 'category' );
                }*/
                
                $article_list_template = '<li><a href="{url}"><img alt="{imagealt}" src="{imagesrc}" height="48" width="64" /><span class="title">{title}</span> | <span class="date">{date}</span> | <span class="commentcount">({commentcount})</span><span class="chapeau">{excerpt:12:a:::1}...</span></a></li>';
                $recent_posts_params='prefix=<ul class="derniers-articles">&suffix=</ul>&output_template='.$article_list_template;
                
                if ($page_principale == 'bienvenue' or $suite == 'bienvenue') {
                    // Page d'accueil
                    echo '<h3>Derniers articles</h3>';
                    recent_posts('skip=1&'.$recent_posts_params);
                    echo '<p><a href="'.get_bloginfo('url').'/articles/">Tous les articles</a></p>';
                } else if ($categoryId) {
                    $categoryId = $categoryId->term_id;
                    $categories = get_categories('include='.$categoryId.'&hide_empty=0&pad_counts=1');
                    //var_dump($categories);
                    echo '<h3>Derniers articles</h3>';
                    recent_posts('included_cats='.$categoryId.'&'.$recent_posts_params);
                    if ($categorie) {
                        echo '<p><a href="'.get_bloginfo('url').'/categories/'.$categorie.'/">Tous les articles</a></p>';
                    } else if ($suite) {
                        echo '<p><a href="'.get_bloginfo('url').'/categories/'.$suite.'/">Tous les articles</a></p>';
                    }
                } else 
                if (is_singular()) {
			        comments_template();
			    }

                echo '</div>';
                ?>

				
		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Anciens articles') ?></div>
			<div class="alignright"><?php previous_posts_link('Récents articles &raquo;') ?></div>
		</div>
		
	
			

	<?php else : ?>

		
		<div class="entry">
			<p></p>
			<p class="error">???????????????????</p>
			<p class="error">???????????????????</p>
			<p class="error">???????????????????</p>
		<p>Looks like what you were looking for isn't here.  You might want to give it another try, perhaps the server hiccuped, or perhaps you spelled something wrong (or maybe I did).</p>
		</div>


	<?php endif; ?>
	
	
</div> <!-- close entry_content -->


<?php //get_sidebar(); ?>

</div> <!-- close content -->

<?php get_footer(); ?>
