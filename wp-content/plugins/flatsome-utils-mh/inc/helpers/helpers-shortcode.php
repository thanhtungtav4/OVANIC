<?php


function get_flatsome_repeater_start_flatsome_utils( $atts, $atts_full = [] ) {
    $atts = wp_parse_args( $atts, array(
      'class' => '',
      'visibility' => '',
      'title' => '',
      'style' => '',
      'columns' => '',
      'columns__sm' => '',
      'columns__md' => '',
      'slider_nav_position' => '',
      'slider_bullets' => 'false',
      'slider_nav_color' => '',
      'auto_slide' => 'false',
      'format' => '',
    ) );

	$row_classes      = array();
	$row_classes_full = array();

	if ( $atts['class'] ) {
		$row_classes[]      = $atts['class'];
		$row_classes_full[] = $atts['class'];
	}

	if ( $atts['visibility'] ) {
		$row_classes[]      = $atts['visibility'];
		$row_classes_full[] = $atts['visibility'];
	}

    if($atts['type'] == 'slider-full'){
      $atts['columns'] = false;
      $atts['columns__sm'] = false;
      $atts['columns__md'] = false;
    }

    if(empty($atts)) return;

    if(!empty($atts['filter'])){
      $row_classes[] = 'row-isotope';
    }

    $rtl = 'false';

    if(is_rtl()) {
      $rtl = 'true';
    }

    if(empty($atts['auto_slide'])) $atts['auto_slide'] = 'false';

    // Group slider cells
    $group_cells = '"100%"';

    // Add column classes
    if(!empty($atts['columns']) && $atts['type'] !== 'grid'){
      if($atts['columns'])  $row_classes[] = 'large-columns-'.$atts['columns'];

      if(empty($atts['columns__md']) && $atts['columns'] > 3) {$row_classes[] = 'medium-columns-3';}
      else{$row_classes[] = 'medium-columns-'.$atts['columns__md'];}

      if(empty($atts['columns__sm']) && $atts['columns'] > 2) {$row_classes[] = 'small-columns-2';}
      else{$row_classes[] = 'small-columns-'.$atts['columns__sm'];}
    }

    // Add Row spacing
    if(!empty($atts['row_spacing'])){
      $row_classes[] = 'row-'.$atts['row_spacing'];
    }

    // Add row width
    if(!empty($atts['row_width'])){
      if($atts['row_width'] == 'full-width') $row_classes[] = 'row-full-width';
    }

    // Add Shadows 
    if(!empty($atts['depth'])){
       $row_classes[] = 'has-shadow';
          $row_classes_full[] = 'box-shadow-'.$atts['depth'];
          $row_classes[] = 'row-box-shadow-'.$atts['depth'];
    }
    if(!empty($atts['depth_hover'])){
       $row_classes[] = 'has-shadow';
          $row_classes_full[] = 'box-shadow-'.$atts['depth_hover'].'-hover';
          $row_classes[] = 'row-box-shadow-'.$atts['depth_hover'].'-hover';
    }

    if($atts['type'] == 'masonry'){
      wp_enqueue_script('flatsome-masonry-js');
      $row_classes[] = 'row-masonry';
    }

    if($atts['type'] == 'grid'){
      wp_enqueue_script('flatsome-masonry-js');
      $row_classes[] = 'row-grid';
    }

    if($atts['type'] == 'slider'){
      $row_classes[] = 'slider row-slider';

      if($atts['slider_style']) $row_classes[] = 'slider-nav-'.$atts['slider_style'];

      if($atts['slider_nav_position']) $row_classes[] = 'slider-nav-'.$atts['slider_nav_position'];

      if($atts['slider_nav_color']) $row_classes[] = 'slider-nav-'.$atts['slider_nav_color'];

      // Add slider push class to normal text boxes
      if(!$atts['style'] || $atts['style'] == 'default' || $atts['style'] == 'normal' || $atts['style'] == 'bounce') $row_classes[] = 'slider-nav-push';

      $slider_options = '{"imagesLoaded": true, "groupCells": '.$group_cells.', "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": '.$atts['slider_bullets'].', "rightToLeft": '.$rtl.', "autoPlay" : '.$atts['auto_slide'].'}';

    } else if($atts['type'] == 'slider-full'){
      $row_classes_full[] = 'slider slider-auto-height row-collapse';

      if($atts['slider_nav_position']) $row_classes_full[] = 'slider-nav-'.$atts['slider_nav_position'];

      if($atts['slider_style']) $row_classes_full[] = 'slider-nav-'.$atts['slider_style'];

      $slider_options = '{"imagesLoaded": true, "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": '.$atts['slider_bullets'].', "rightToLeft": '.$rtl.', "autoPlay" : '.$atts['auto_slide'].'}';
    }

	$row_classes_full = array_unique( $row_classes_full );
	$row_classes      = array_unique( $row_classes );

  $row_classes[]      = 'flatsome-ultils-mh-ux';
	$row_classes_full = implode( ' ', $row_classes_full );
	$row_classes      = implode( ' ', $row_classes );
  ?>

  <?php if($atts['title']){?>
  <div class="row">
    <div class="large-12 col">
      <h3 class="section-title"><span><?php echo $atts['title']; ?></span></h3>
    </div>
  </div>
  <?php } ?>
  <div class="flatsome-utils-mh-section">
  <?php if($atts['type'] == 'slider') { // Slider grid ?>
  <div class="row <?php echo $row_classes; ?>"  data-flickity-options='<?php echo $slider_options; ?>' data-mh-ux='<?php echo json_encode($atts_full) ?>'>

  <?php } else if($atts['type'] == 'slider-full') { // Full slider ?>
  <div id="<?php echo $atts['id']; ?>" class="<?php echo $row_classes_full; ?>" data-flickity-options='<?php echo $slider_options; ?>' data-mh-ux='<?php echo json_encode($atts_full) ?>'>

  <?php } else if($atts['type'] == 'masonry') { // Masonry grid ?>
  <div id="<?php echo $atts['id']; ?>" class="row <?php echo $row_classes; ?>" data-packery-options='{"itemSelector": ".col", "gutter": 0, "presentageWidth" : true}' data-mh-ux='<?php echo json_encode($atts_full) ?>'>

  <?php } else if($atts['type'] == 'grid') { ?>
  <div id="<?php echo $atts['id']; ?>" class="row <?php echo $row_classes; ?>" data-packery-options='{"itemSelector": ".col", "gutter": 0, "presentageWidth" : true}' data-mh-ux='<?php echo json_encode($atts_full) ?>'>

  <?php } else if($atts['type'] == 'blank') { //Blank type ?>
  <div class="container">

  <?php } else { // Normal Rows ?>
  <div class="row <?php echo $row_classes; ?>" data-mh-ux='<?php echo json_encode($atts_full) ?>'>
  <?php }
}

function get_flatsome_repeater_end_flatsome_utils($type, $query = '', $atts = ''){
  echo '</div>';
  if($query)
    flatsome_ultils_mh_pagination($query, $atts);
  echo '</div>';

}

function  flatsome_ultils_mh_pagination($wp_query, $atts) {

  

    $prev_arrow = is_rtl() ? get_flatsome_icon('icon-angle-right') : get_flatsome_icon('icon-angle-left');
    $next_arrow = is_rtl() ? get_flatsome_icon('icon-angle-left') : get_flatsome_icon('icon-angle-right');
    $page_ = isset($atts['page']) ? intval($atts['page']) : 1;
    $total = $wp_query->max_num_pages;
    $big = 999999999; // need an unlikely integer
    if( $total > 1 )  {

        if(isset($atts['flatsome_ultils_mh_pagination_loadmore']) && $atts['flatsome_ultils_mh_pagination_loadmore'] == 'true' && $atts['type'] == 'row')
        {
          echo '<div class="text-center"><a class="button primary flatsome-utils-loadmore-btn" data-total="'.$total.'" data-current="'.$page_.'"> <span>'.$atts['flatsome_ultils_mh_pagination_loadmore_label'].'</span> </a></div>';

        }  
        else{
           if( !$current_page = $page_ )
               $current_page = 1;
           if( get_option('permalink_structure') ) {
               $format = 'page/%#%/';
           } else {
               $format = '&paged=%#%';
           }
          $pages = paginate_links(array(
              'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
              'format'        => $format,
              'current'       => max( 1, $page_ ),
              'total'         => $total,
              'mid_size'      => 3,
              'type'          => 'array',
              'prev_text'     => $prev_arrow,
              'next_text'     => $next_arrow,
           ) );

          if( is_array( $pages ) ) {
              $paged = ( $page_ == 0 ) ? 1 : $page_;
              echo '<ul class="page-numbers nav-pagination links text-center flatsome-ultils-mh-pagination">';
              foreach ( $pages as $page ) {
                      $page = str_replace("page-numbers","page-number",$page);
                      echo "<li>$page</li>";
              }
             echo '</ul>';
          }
        }

         
    }
    
}
