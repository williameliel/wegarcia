<?php $header_logo = get_field('header_logo','option'); ?>
<nav class="navbar navbar-default">
    <div class="container nav-wrap">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo home_url('/'); ?>">
          <?php if (!empty($header_logo)){ ?>
              <img src="<?php echo $header_logo ?>" alt="<?php echo bloginfo('name'); ?>" >
          <?php }else{ ?>
           <?php echo bloginfo('name'); ?>
            <small><?php echo bloginfo('description'); ?></small>
          <?php } ?>
        </a>
      </div>
      <div id="navbar" class="navbar-collapse collapse ">
        <?php 
        if (has_nav_menu('primary_navigation')) :

          wp_nav_menu([
              'theme_location' => 'primary_navigation',
              'menu_class' => 'navbar nav navbar-nav'
          ]);

        endif;
        ?>
       
      </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->

  </nav>
