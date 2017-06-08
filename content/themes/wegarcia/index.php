<?php /* get_template_part('templates/page', 'header'); */ ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>
<?php $i=0; ?>
<?php while (have_posts()) : the_post(); ?>
  <?php if(!$i && !is_paged()): ?>
    <?php get_template_part('templates/hero', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
  <?php else: ?>
    <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
  <?php endif; ?>
  <?php $i++; ?>
<?php endwhile; ?>

<?php the_posts_navigation(); ?>
