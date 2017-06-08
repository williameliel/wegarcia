<?php

// load custom fields - For production: xport and add here after doing the editing on the ACF plugin admin page
// require_once 'acf/custom-fields--layouts.php';
// require_once 'acf/custom-fields--foo.php';
// put message in ACF interface to warn people to edit custom fields here
function acf_warning( $hook ) {
    if ('edit.php' != $hook) {
        return;
    }

    $javascript = "
        var acfFieldGroupEl = document.getElementById('acf-field-group-wrap');

        if (acfFieldGroupEl) {
            var warningEl = document.createElement('h3');
            warningEl.innerHTML = 'WARNING: Custom Field definitions are in " . basename(__FILE__) . "';
            warningEl.style.color = 'red';
            acfFieldGroupEl.insertBefore(warningEl, acfFieldGroupEl.firstChild);
        }
    ";

    wp_enqueue_script( 'acf-warning-js', '/iAmNotReal.js', array(), '1.0', true); // needed because Wordpress is weird
    wp_add_inline_script( 'acf-warning-js', $javascript);
}

add_action('admin_enqueue_scripts', 'acf_warning');
