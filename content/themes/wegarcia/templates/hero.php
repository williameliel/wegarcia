<div class="hero" style="background-image: url(<?php echo  wp_get_attachment_url(get_post_thumbnail_id()); ?>);">
  <article <?php post_class("container vertical"); ?>> 
      <header>
          <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <div class="hidden"><?php  get_template_part('templates/entry-meta');  ?></div>
        </header>
        <div class="entry-summary hidden">
          <?php the_excerpt(); ?>
          <a href="<?php the_permalink(); ?>" title="<?php esc_attr( get_the_title() ); ?>" >Read More...</a>
        </div>
      </div>
  </article>
</div>
