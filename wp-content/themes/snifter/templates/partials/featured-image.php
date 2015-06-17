<?php
$size = 'featured-image-size';
$attr = array(
	'class' => 'featured-image',
);
?>
<div class="featured-image">
	<?php if ( has_post_thumbnail() ) { ?>
	<?php the_post_thumbnail( $size, $attr ); ?>
	<?php } // if() ?>
</div> <?php // .featured-image ?>