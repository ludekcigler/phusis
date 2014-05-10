<?php get_header(); ?>

<div id="content">

	<div id="entry_content">


	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
				<?php if(is_home()) { if ( function_exists('wp_list_comments') ) { ?> <div <?php post_class(); ?>> <?php }} ?>
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permalien vers <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<p class="date"><?php the_time('j F Y') ?> <span class="comments">| <?php comments_popup_link('Commentaires (<span class="commentcount">0</span>)', 'Commentaires (<span class="commentcount">1</span>)', 'Commentaires (<span class="commentcount">%</span>)'); ?></span></p>
				
				
				<div class="entry">
					<?php the_content('&raquo; Lisez tout &laquo;'); ?>
				
						<?php if (is_singular()) { ?>
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
		<p>Hmmm, il semble que ce que vous cherchez n'est pas là. Vous pouvez l'essayer encore une fois - peut-être le server s'abstiné pour un petit moment - ou alors vous avez fait une faute de frappe?</p>
		</div>


	<?php endif; ?>
	
	
</div> <!-- close entry_content -->



<?php //get_sidebar(); ?>

<?php get_footer(); ?>
