  <?php /* Content Box reusable snippet */ ?>
  <div class="content_box col-xs-10 col-md-4 col-centered">
    <?php if (!empty($layout['sur_title'])) {?>
      <h3 class="text-center"><?php echo $layout['sur_title']; ?></h3>
    <?php  } ?>
    <?php if (!empty($layout['title'])) {?>
      <h2 class="text-center"><?php echo $layout['title']; ?></h2>
    <?php  } ?>
    <?php if (!empty($layout['content'])) {?>
      <div class="col-centered col-xs-12 text-center"><?php echo $layout['content']; ?></div>
    <?php  } ?>
    <?php include('cta.php'); ?>
  </div>
