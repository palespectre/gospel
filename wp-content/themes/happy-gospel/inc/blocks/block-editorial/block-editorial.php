<?php

function gutenberg_block_editorial() {
    wp_register_script(
        'block-editorial',
        get_template_directory_uri().'/inc/blocks/block-editorial/block-editorial.js',
        array( 'wp-blocks', 'wp-element', 'wp-i18n' )
    );
    wp_register_style(
        'block-editorial',
        get_template_directory_uri().'/inc/blocks/block-editorial/block-editorial-backoffice.css',
        array( 'wp-edit-blocks' )
    );
    if (function_exists('register_block_type')) {
            register_block_type('ec/block-editorial', array(
                'editor_script' => 'block-editorial',
                'editor_style' => 'block-editorial'
            ) );
        }
}
add_action( 'init', 'gutenberg_block_editorial' );