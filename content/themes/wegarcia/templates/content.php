<article <?php post_class("container"); ?>>
<?php echo $i; ?>
  <header>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php  get_template_part('templates/entry-meta');  ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
    <a href="<?php the_permalink(); ?>" title="<?php esc_attr( get_the_title() ); ?>" >Read More...</a>
  </div>
</article>
