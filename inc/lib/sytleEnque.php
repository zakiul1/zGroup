<?php
function zgroup_scripts()
{
    wp_enqueue_style('zgroup-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_style_add_data('zgroup-style', 'rtl', 'replace');
    wp_enqueue_style('output', get_template_directory_uri() . '/dist/output.css', array());
    wp_enqueue_script('zgroup-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
    wp_enqueue_script('zgroup-main-js', get_template_directory_uri() . '/js/app.js', array(), _S_VERSION, true);

    wp_enqueue_script('flowbite', 'https://cdn.jsdelivr.net/npm/flowbite@latest/dist/flowbite.min.js', array(), false, true);
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'zgroup_scripts');