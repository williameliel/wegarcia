<?php if (!empty($layout['cta'])){ ?> 
  <div class="col-centered text-center">
    <?php foreach($layout['cta'] as $k => $cta){ ?>
      <a href="<?php echo $cta['url'] ?>" class="btn btn-default" title="<?php echo $cta['cta'] ?>"><?php echo $cta['cta'] ?></a>
    <?php } ?>
  </div>
<?php } ?>