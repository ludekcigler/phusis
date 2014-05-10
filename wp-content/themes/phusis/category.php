<?php get_header(); ?>

<div id="content">

	<div id="entry_content">


	<?php
    $category_array = get_the_category();
    $category_id = $category_array[count($category_array)-1]->cat_ID;
    $recent_posts_params = 'included_cats='.$category_id.'&limit=10000&prefix=&suffix=&output_template=<div class="post type-post hentry"><h2 style="clear: both"><a href="{url}">{title}</a></h2><p class="date">{date} | <a href="{url}#respond" title="Commentaires">Commentaires (<span class="commentcount">{commentcount}</span>)</a></p><div class="entry"><img alt="{imagealt}" src="{imagesrc}" class="alignright size-medium" />{excerpt:160:a: Suite:link:0}... <a href="{url}">Suite</a></div></div>';

    if (is_category('les-bacchantes')) 
    {
        //$post_args = array('category' => $category_id, 'posts_per_page' => -1, 'order' => 'ASC', 'order_by' => 'post_date' );
        $recent_posts_params = $recent_posts_params.'&sort-order1=SORT_ASC';
    } else {
        //$post_args = array('category' => $category_id, 'posts_per_page' => -1, 'order' => 'DESC', 'order_by' => 'post_date' );
    }
    

    if (function_exists('recent_posts')) {
        recent_posts($recent_posts_params);
    }
    //$all_posts = get_posts($post_args);
     
    
    /*if (count($all_posts) > 0) : ?>

		<?php foreach ($all_posts as $post) : setup_postdata($post); ?>
				<?php if(is_home()) { if ( function_exists('wp_list_comments') ) { ?> <div <?php post_class(); ?>> <?php }} ?>
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permalien vers <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<p class="date"><?php the_time('j F Y') ?><span class="comments"> | <?php comments_popup_link('Commentaires (<span class="commentcount">0</span>)', 'Commentaires (<span class="commentcount">1</span>)', 'Commentaires (<span class="commentcount">%</span>)'); ?></span></p>
				
				
				<div class="entry">
					<?php the_excerpt('&raquo; Lisez tout &laquo;'); ?>
				
						<?php if (is_singular()) { ?>
							<?php comments_template(); ?>
						<?php } ?>
				</div>
				<?php if(is_home()) { if ( function_exists('wp_list_comments') ) { ?></div><!-- close post_class --><?php }} ?>
				
		<?php endforeach; ?>

		<div class="navigation">
			<p class="alignleft"><?php next_posts_link('&laquo; Anciens articles') ?></p>
			<p class="alignright"><?php previous_posts_link('Récents articles &raquo;') ?></p>
		</div>
		
	
			

	<?php else : ?>

		
		<div class="entry">
		<span class="error"><img src="<?php bloginfo('template_directory'); ?>/images/mal.png" alt="error duck" /></span>
		<p>Hmmm, seems like what you were looking for isn't here.  You might want to give it another try - the server might have hiccuped - or maybe you even spelled something wrong (though it's more likely <strong>I</strong> did).</p>
		</div>


	<?php endif; */ ?>
	
	
</div> <!-- close entry_content -->



<?php //get_sidebar(); ?>

<?php get_footer(); ?>
