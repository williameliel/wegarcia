<?php use Roots\Sage\Wrapper; ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<?php get_template_part('templates/head'); ?>
    <body <?php body_class(); ?>">

        <!--[if IE]>
          <div class="alert alert-warning">
            <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
          </div>
        <![endif]-->


        <div id="container" >
            <?php do_action('get_header'); ?>
            <header class="header">
            <?php get_template_part('templates/header'); ?>
            </header>          
       
            <main id="main" <?php body_class(array('container',' main-container')); ?>">
                <?php include Wrapper\template_path(); ?>
            </main>

            <?php do_action('get_footer'); ?>
            <?php get_template_part('templates/footer'); ?>
         
        </div>
        <?php wp_footer(); ?>

        <?php get_template_part('templates/analytics'); ?>
        
    </body>
</html>
