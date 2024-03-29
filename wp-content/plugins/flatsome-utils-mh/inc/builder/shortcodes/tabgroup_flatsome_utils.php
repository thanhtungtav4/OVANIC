<?php

add_ux_builder_shortcode( 'tabgroup_flatsome_utils', array(
    'type' => 'container',
    'name' => __( 'Tabs Flatsome Utils' ),
    'image' => '',
    'category' => __( 'Content' ),
    'thumbnail' =>  flatsome_ux_builder_thumbnail( 'tabs' ),
    'template' => flatsome_ux_builder_template( 'tabgroup.html' ),
    'tools' => 'shortcodes/tabgroup/tabgroup.tools.html',
    'info' => '{{ title }}',
    'allow' => array( 'tab' ),

    'children' => array(
        'draggable' => false,
        'addable_spots' => array( 'center' ),
    ),

    'toolbar' => array(
        'show_children_selector' => true,
        'show_on_child_active' => true,
    ),

    'presets' => array(
        array(
            'name' => __( 'Default' ),
            'content' => '
                [tabgroup_flatsome_utils title="Tab Title"]
                    [tab title="Tab 1 Title"][/tab]
                    [tab title="Tab 2 Title"][/tab]
                    [tab title="Tab 3 Title"][/tab]
                [/tabgroup_flatsome_utils]
            '
        ),
    ),

    'options' => array(

        'title' => array(
            'type' => 'textfield',
            'heading' => __( 'Title' ),
            'default' => __( '' ),
        ),

        'style' => array(
            'type' => 'select',
            'heading' => __( 'Style' ),
            'default' => 'line',
            'options' => require( get_template_directory() . '/inc/builder/shortcodes/values/nav-styles.php' ),
        ),

        'type' => array(
            'type' => 'select',
            'heading' => __( 'Type' ),
            'default' => 'horizontal',
            'options' => array(
                'horizontal' => 'Horizontal',
                'vertical' => 'Vertical',
            )
        ),

        'nav_style' => array(
          'type' => 'radio-buttons',
          'heading' => 'Nav Style',
          'default' => 'uppercase',
          'options' => require( get_template_directory() . '/inc/builder/shortcodes/values/nav-types-radio.php' ),
        ),

        'nav_size' => array(
            'type' => 'radio-buttons',
            'heading' => __( 'Size' ),
            'default' => 'medium',
            'options' => require( get_template_directory() . '/inc/builder/shortcodes/values/text-sizes.php' ),
        ),

        'align' => array(
            'type' => 'radio-buttons',
            'heading' => 'Tabs Align',
            'default' => 'left',
            'options' => require( get_template_directory() . '/inc/builder/shortcodes/values/align-radios.php' ),
        ),
        'advanced_options' => require( get_template_directory() . '/inc/builder/shortcodes/commons/advanced.php'),
    ),
) );
