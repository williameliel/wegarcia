<!-- includes/collage.php -->
<div class="collage container">
  <?php include('clones/content_box.php'); ?>
  <?php if (!empty($layout['images'])){ ?>
  <div class="images">
    <?php foreach($layout['images'] as $k => $image){ ?>
    <figure class="figure image-<?php echo $k; ?>">
      <img src="<?php echo $image['sizes']['medium'] ?>" class="figure-img img-fluid" alt="<?php echo $image['alt']; ?>">
      <figcaption class="figure-caption text-right"><?php echo $image['title'] ?></figcaption>
    </figure>
    <?php } ?>
  </div>
  <?php } ?>
</div>
