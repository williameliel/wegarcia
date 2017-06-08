<!-- includes/info_gallery.php -->
<div class="info_gallery container relative">
  <?php include('clones/content_box.php'); ?>
  <?php if (!empty($layout['images'])){ ?>
  <div class="col-md-8 col-xs-12">
    <div class="slick-slider">
      <?php foreach($layout['images'] as $k => $image){ ?>
      <div class="figure image-<?php echo $k; ?>">
        <img src="<?php echo $image['sizes']['medium_large'] ?>" class="img-responsive" alt="<?php echo $image['alt']; ?>">
        <div class="figure-caption text-right "><?php echo $image['title'] ?></div>
      </div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
</div>
