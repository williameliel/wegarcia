<!-- includes/hero.php  -->
<div class="hero">
    <?php include('clones/content_box.php'); ?>
    <div class="slick-slider hero__slider" id="hero_slider_<?php echo $layout['index']; ?>">
        <?php if(!empty($layout['slides'])){ ?>
            <?php foreach ($layout['slides'] as $slide_key => $slide_value) { ?>
                <?php $url = isset($slide_value['image']['sizes']) ? $slide_value['image']['sizes']['large'] : false;  ?>
                <?php if ($url) { ?>
                    <div class="hero__slider__slide" style="background-image: url(<?php echo $url; ?>);">
                    <?php if ($slide_value['title']): ?>
                        <h2><?php echo $slide_value['title'] ?></h2>
                    <?php endif ?>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>

</div>
