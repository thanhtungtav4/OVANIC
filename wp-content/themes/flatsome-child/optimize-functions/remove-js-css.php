<?php
//Dequeue Styles
function dequeue_unnecessary_styles() {
     if (!current_user_can( 'manage_options' )) {
        //wp_dequeue_style( 'jquery-selectBox' );
        
        // Loại trừ css
        if (!is_page('home') && !is_page('products') && !is_front_page()) {
            //wp_dequeue_style( 'jquery-selectBox' );
           
        }
     }
    
}
add_action( 'wp_print_styles', 'dequeue_unnecessary_styles' );

//Dequeue JavaScripts
function dequeue_unnecessary_scripts() {
    if (!current_user_can( 'manage_options' )) {
        //wp_dequeue_script( 'jquery-core' );
       
        // Loại trừ js
        if (!is_page('home') && !is_page('products') && !is_front_page()) {
            //wp_dequeue_script( 'jquery-core' );
          
            
        }
    }
   
}
add_action( 'wp_print_scripts', 'dequeue_unnecessary_scripts' );
