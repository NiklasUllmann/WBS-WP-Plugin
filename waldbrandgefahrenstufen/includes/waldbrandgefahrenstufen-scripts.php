<?php
// Add Scripts
function wbs_add_scripts()
{
    // Add Main CSS
    // Add Main JS
    wp_enqueue_script('wbs-main-script', plugins_url() . '/waldbrandgefahrenstufen/js/main.js');
}

add_action('wp_enqueue_scripts', 'wbs_add_scripts');
