<?php
// [tabgroup]
// function ux_tabgroup_flatsome_utils( $params, $content = null, $tag = '' ) {


// 	$GLOBALS['tabs'] = array();
// 	$GLOBALS['tab_count'] = 0;
// 	$i = 1;

// 	extract(shortcode_atts(array(
// 		'title' => '',
// 		'style' => 'line',
// 		'align' => 'left',
// 		'class' => '',
// 		'visibility' => '',
// 		'type' => '', // horizontal, vertical
// 		'nav_style' => 'uppercase',
// 		'nav_size' => 'normal',
// 		'id' => 'panel-'.rand(),
// 		'history' => 'false',
// 	), $params));

// 	if($tag == 'tabgroup_vertical'){
// 		$type = 'vertical';
// 	}

// 	$content = flatsome_contentfix($content);

// 	$wrapper_class[] = 'tabbed-content';
// 	if ( $class ) $wrapper_class[] = $class;
//   if ( $visibility ) $wrapper_class[] = $visibility;

// 	$classes[] = 'nav';

// 	if($style) $classes[] = 'nav-'.$style;
// 	if($type == 'vertical') $classes[] = 'nav-vertical';
// 	if($nav_style) $classes[] = 'nav-'.$nav_style;
// 	if($nav_size) $classes[] = 'nav-size-'.$nav_size;
// 	if($align) $classes[] = 'nav-'.$align;


// 	$classes = implode(' ', $classes);
// 	// print_r($GLOBALS['tabs']);
// 	if( is_array( $GLOBALS['tabs'] )){
// 		foreach( $GLOBALS['tabs'] as $key => $tab ){
// 			// if($key == 1)
// 			// debug($tab);
// 			if($tab['title']) $id = flatsome_to_dashed($tab['title']);
// 			$active = $key == 0 ? ' active is_loaded' : ''; // Set first tab active by default.
// 			$tabs[] = '<li class="tab'.$active.' has-icon flatsome-utils-tabs-ajax"><a href="#tab_'.$id.'"><span>'.$tab['title'].'</span></a></li>';

// 			if($key == 0)
// 				$panes[] = '<div class="panel'.$active.' entry-content" id="tab_'.$id.'">'.flatsome_contentfix($tab['content']).'</div>';
// 			else{
// 				$format_cs = $tab['content'];
// 				$format_cs = str_replace('[', '[--', $tab['content']);
// 				$format_cs = str_replace(']', '--]', $format_cs);

// 				$input = "<span class='tab_sc_fs_ut'>".$format_cs."</span>";
// 				$panes[] = '<div class="panel'.$active.' entry-content" id="tab_'.$id.'">'.$input.'</div>';
// 			}

// 			$i++;
// 		}
// 			if($title) $title = '<h4 class="uppercase text-'.$align.'">'.$title.'</h4>';
// 			$return = '
// 		<div class="'.implode(' ', $wrapper_class).'">
// 			'.$title.'
// 			<ul class="'.$classes.'">'.implode( "\n", $tabs ).'</ul><div class="tab-panels">'.implode( "\n", $panes ).'</div></div>';
// 	}


// 	return $return;
// }

// function ux_tab_flatsome_utils( $params, $content = null) {
// 	extract(shortcode_atts(array(
// 			'title' => '',
// 			'title_small' => ''
// 	), $params));

// 	$x = $GLOBALS['tab_count'];
// 	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );
// 	$GLOBALS['tab_count']++;
// }


// add_shortcode('tabgroup_flatsome_utils', 'ux_tabgroup_flatsome_utils');
// add_shortcode('tabgroup_vertical_flatsome_utils', 'ux_tabgroup_flatsome_utils');
// add_shortcode('tab_flatsome_utils', 'ux_tab_flatsome_utils' );



function ux_tabgroup_flatsome_utils( $params, $content = null, $tag = '' ) {
	$GLOBALS['tabs'] = array();
	$GLOBALS['tab_count'] = 0;
	$i = 1;

	extract(shortcode_atts(array(
		'title' => '',
		'style' => 'line',
		'align' => 'left',
		'class' => '',
		'visibility' => '',
		'type' => '', // horizontal, vertical
		'nav_style' => 'uppercase',
		'nav_size' => 'normal',
		'id' => 'panel-'.rand(),
		'history' => 'false',
	), $params));

	if($tag == 'tabgroup_vertical'){
		$type = 'vertical';
	}

	$content = do_shortcode( $content );

	$wrapper_class[] = 'tabbed-content';
	if ( $class ) $wrapper_class[] = $class;
  if ( $visibility ) $wrapper_class[] = $visibility;

	$classes[] = 'nav';

	if($style) $classes[] = 'nav-'.$style;
	if($type == 'vertical') $classes[] = 'nav-vertical';
	if($nav_style) $classes[] = 'nav-'.$nav_style;
	if($nav_size) $classes[] = 'nav-size-'.$nav_size;
	if($align) $classes[] = 'nav-'.$align;


	$classes = implode(' ', $classes);
	
	$return = '';

	if( is_array( $GLOBALS['tabs'] )){

		foreach( $GLOBALS['tabs'] as $key => $tab ){
			if($tab['title']) $id = flatsome_to_dashed($tab['title']);
			$active = $key == 0 ? ' active is_loaded' : ''; // Set first tab active by default.
			$tabs[] = '<li class="tab'.$active.' has-icon flatsome-utils-tabs-ajax"><a href="#tab_'.$id.'"><span>'.$tab['title'].'</span></a></li>';
			if($key == 0)
				$panes[] = '<div class="panel'.$active.' entry-content" id="tab_'.$id.'">'.do_shortcode($tab['content']).'</div>';
			else{

				$format_cs = $tab['content'];
				$format_cs = str_replace('[', '[--', $tab['content']);
				$format_cs = str_replace(']', '--]', $format_cs);

				$input = "<span class='tab_sc_fs_ut'>".$format_cs."</span>";
				$panes[] = '<div class="panel'.$active.' entry-content" id="tab_'.$id.'">'.$input.'</div>';

			}
			$i++;
		}
			if($title) $title = '<h4 class="uppercase text-'.$align.'">'.$title.'</h4>';
			$return = '
		<div class="'.implode(' ', $wrapper_class).'">
			'.$title.'
			<ul class="'.$classes.'">'.implode( "\n", $tabs ).'</ul><div class="tab-panels">'.implode( "\n", $panes ).'</div></div>';
	}


	return $return;
}

function ux_tab_flatsome_utils( $params, $content = null) {
	extract(shortcode_atts(array(
			'title' => '',
			'title_small' => ''
	), $params));

	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );
	$GLOBALS['tab_count']++;
}


add_shortcode('tabgroup_flatsome_utils', 'ux_tabgroup_flatsome_utils');
add_shortcode('tabgroup_vertical_flatsome_utils', 'ux_tabgroup_flatsome_utils');
add_shortcode('tab_flatsome_utils', 'ux_tab_flatsome_utils' );
