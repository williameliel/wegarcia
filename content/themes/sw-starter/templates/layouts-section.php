<?php
namespace Roots\Sage\Environment;
/*
 * Layouts Section Wrapper
 * Loop trough the ACF Layouts and includes the template module
 */

$layout['index'] = $l;
$layout_name = $layout['acf_fc_layout'];
$nav_name = !empty($layout['nav_item']) ? $layout['nav_item'] : '';
$nav_slug = strtolower(str_replace(array(' ', '&'), '-', $nav_name));
$section_classes = 'layouts-section' . ' layouts-section--' . $layout_name;
if( isset($layout['layout_css_class']) ){
    $section_classes .= ' ' . $layout['layout_css_class'];
}
$path_to_template = locate_template('templates/modules/' . $layout_name . '.php');

if ( file_exists($path_to_template) ) { ?>
    <?php echo (Environment::isLocal() ? '<pre style="background-color:red; color:white; position:absolute;float:right;">'.$layout_name.'</pre>' : ''); ?>
    <section id="<?php echo $nav_slug; ?>" name="<?php echo $nav_slug; ?>" class="<?php echo $section_classes; ?> <?php echo $layout['index'] == 0 && $layout['acf_fc_layout'] == 'global_nav' ? 'global_nav_top' : '' ?>">

        <?php include($path_to_template); ?>

    </section>

<?php } else { ?>

    <!-- Template not found: <?php echo $layout_name ?>  -->

<?php } ?>