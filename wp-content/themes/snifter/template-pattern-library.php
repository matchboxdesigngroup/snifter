<div class="row">
	<?php // Template Name: Pattern Library ?>
	<?php get_template_part( 'templates/partials/featured-image' ); ?>

	<h3>Button Default</h3>
	<a class="btn">Anchor</a>
	<input class="btn" type="submit" name="pattern_library_submit" value="Submit">
	<button class="btn" type="button">Button</button>

	<?php for ( $i = 1; $i <= 1; $i++ ) { ?>
	<h3>Button Theme <?php echo esc_attr( $i); ?></h3>
	<a class="btn-theme<?php echo esc_attr( $i); ?>">Anchor</a>
	<input class="btn btn-theme<?php echo esc_attr( $i); ?>" type="submit" name="pattern_library_submit" value="Submit">
	<button class="btn btn-theme<?php echo esc_attr( $i); ?>" type="button">Button</button>
	<?php } // for() ?>

	<?php for ( $i = 1; $i <= 4; $i++ ) { ?>
	<h3>Button Theme <?php echo esc_attr( $i); ?></h3>
	<a class="btn-color<?php echo esc_attr( $i); ?>">Anchor</a>
	<input class="btn btn-color<?php echo esc_attr( $i); ?>" type="submit" name="pattern_library_submit" value="Submit">
	<button class="btn btn-color<?php echo esc_attr( $i); ?>" type="button">Button</button>
	<?php } // for() ?>

	<hr style="clear:both;">

	<h2>Default Content</h2>
	<?php get_template_part( 'templates/content/content-pattern-library-content-loop' ); ?>
	<hr style="clear:both;">