<?php get_header(); ?>

<div id="content">

	<div id="entry_content">


	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
				<?php if(is_home()) { if ( function_exists('wp_list_comments') ) { ?> <div <?php post_class(); ?>> <?php }} ?>
                <p class="print_cygne"><img src="<?php bloginfo('template_directory'); ?>/images/cygne_blanche.png"></p>
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<p class="date"><?php the_time('j F Y') ?> <?php if ( comments_open() ) : ?><span class="comments">| <?php comments_popup_link('Commentaires (<span class="commentcount">0</span>)', 'Commentaires (<span class="commentcount">1</span>)', 'Commentaires (<span class="commentcount">%</span>)'); ?></span><?php endif; ?> | <?php the_category(', '); ?></p>
				
				
				<div class="entry">
					<?php the_content('&raquo; Lisez tout &laquo;'); ?>

                    <?php 
                        //echo '<p><a href="'.get_category_link($post->post_category).'/">Articles du même genre</a></p>'; 
                    ?>
					
					<p class="tags"><?php the_tags('<strong>Libellés:</strong> ', ', ', ''); ?></p>
						<?php if (is_single()) { ?>
							<?php comments_template(); ?>
						<?php } ?>
				</div>
				<?php if(is_home()) { if ( function_exists('wp_list_comments') ) { ?></div><!-- close post_class --><?php }} ?>
				
		<?php endwhile; ?>

		<div class="navigation">
			<p class="alignleft"><?php next_posts_link('&laquo; Anciens articles') ?></p>
			<p class="alignright"><?php previous_posts_link('Récents articles &raquo;') ?></p>
		</div>
		
	
			

	<?php else : ?>

		
		<div class="entry">
		<span class="error"><img src="<?php bloginfo('template_directory'); ?>/images/mal.png" alt="error duck" /></span>
		<p>Hmmm, seems like what you were looking for isn't here.  You might want to give it another try - the server might have hiccuped - or maybe you even spelled something wrong (though it's more likely <strong>I</strong> did).</p>
		</div>


	<?php endif; ?>
	
	
</div> <!-- close entry_content -->



<?php get_sidebar(); ?>

</div> <!-- close content -->

<?php get_footer(); ?>
