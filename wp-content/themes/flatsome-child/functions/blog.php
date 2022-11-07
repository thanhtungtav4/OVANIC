<?php
function getPrimary($currentID){
  $category = get_the_category();
  // Get primary (Yoast) term if it is set
  $category_display = '';
  if ( class_exists('WPSEO_Primary_Term') ) {
       // Show the post's 'Primary' category, if this Yoast feature is available, & one is set
    $wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
    $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
    $term = get_term( $wpseo_primary_term );
       if ( is_wp_error( $term ) ) {
         // Default to first category (not Yoast) if an error is returned
        return $category[0];
       } else {
            // Check if category has parent
            $category_id = $term->term_id;
            $category_term = get_category($category_id);
            // if primary category is a child
            if( $category_term->category_parent > 0 ) {
              // Get parent category object
              $parent = $category_term->parent;
              $parent_object = get_category($parent);

              // Set parent category variables
              return  $parent_object;

            // if primary cateogry is a parent
            } else {

        // Yoast Primary category
            return  $term;
                //   $category_display = $term->name;
                //  $category_slug = $term->slug;

            }

       }
  } else {

    // Default, display the first category in WP's list of assigned categories
    return  $category[0];


  }

}