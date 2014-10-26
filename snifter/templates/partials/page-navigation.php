<?php
// @todo Add pagination
// @todo previous/next page navigation

// public function pagination( $max_num_pages = null, $range = 2, $output = true ) {
// 	$showitems  = ( $range * 2 ) + 1;
// 	$pagination = '';

// 	global $paged;
// 	if ( empty( $paged ) ){
// 		$paged = 1;
// 	}

// 	if ( is_null( $max_num_pages ) ) {
// 		global $wp_query;
// 		$max_num_pages = $wp_query->max_num_pages;
// 		if ( ! $max_num_pages )
// 			$max_num_pages = 1;
// 	} // if()

// 	if ( 1 != $max_num_pages ) {
// 		$pagination .= "<div class='pagination'>";
// 		if ( $paged > 2 && $paged > $range + 1 && $showitems < $max_num_pages )
// 			$pagination .= "<a href='".get_pagenum_link( 1 )."'>&laquo;</a>";
// 		if ( $paged > 1 && $showitems < $max_num_pages )
// 			$pagination .= "<a href='".get_pagenum_link( $paged - 1 )."'>&lsaquo;</a>";

// 		for ( $i = 1; $i <= $max_num_pages; $i++ ) {
// 			if ( 1 != $max_num_pages &&( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $max_num_pages <= $showitems ) ) {
// 				$pagination .= ( $paged == $i )? "<span class='current'>".$i.'</span>':'<a href="'.get_pagenum_link( $i ).'" class="inactive" >'.$i.'</a>';
// 			} // if()
// 		} // for()

// 		if ( $paged < $max_num_pages && $showitems < $max_num_pages ) {
// 			$pagination .= "<a href='".get_pagenum_link( $paged + 1 )."'>&rsaquo;</a>";
// 		}

// 		if ( $paged < $max_num_pages - 1 &&  $paged + $range - 1 < $max_num_pages && $showitems < $max_num_pages ) {
// 			$pagination .= "<a href='".get_pagenum_link( $max_num_pages )."'>&raquo;</a>";
// 		}

// 		$pagination .= "</div>\n";
// 	} // if()

// 	if ( $output ) {
// 		$allowed_html = array(
// 			'div' => array(
// 				'class' => array(),
// 				'id'    => array(),
// 			),
// 			'a' => array(
// 				'href'  => array(),
// 				'class' => array(),
// 				'id'    => array(),
// 			),
// 			'span'    => array(
// 				'class' => array(),
// 				'id'    => array(),
// 			),
// 		);
// 		echo wp_kses( $pagination, $allowed_html );
// 	} // if()

// 	return $pagination;
// } // pagination()



// wp_link_pages( array(
// 	'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
// 	'after'       => '</div>',
// 	'link_before' => '<span>',
// 	'link_after'  => '</span>',
// ) );