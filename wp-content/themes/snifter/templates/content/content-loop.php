<div class="content-loop fitvid">
<?php while ( have_posts() ) { ?>
	<?php the_post(); ?>
	<?php the_content(); ?>
<?php } // while() ?>
</div> <?php // .content-loop ?>