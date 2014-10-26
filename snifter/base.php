<?php get_template_part( 'templates/head' ); ?>
	<body <?php body_class(); ?>>

		<!--[if lt IE 7]><div class="alert"><?php _e( 'You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots' ); ?></div><![endif]-->

		<?php do_action( 'get_header' ); ?>
		<?php get_template_part( 'templates/header' ); ?>
		<div class="wrap" role="document">
			<div class="content">
				<?php get_template_part( 'templates/partials/page-header' ); ?>
				<section id="primary" class="content-area main" role="main">
					<?php include sn_template_path(); ?>
				</section><?php //.main ?>
				<?php if ( true ) { ?>
				<aside class="sidebar" role="complementary">
					<?php include sn_sidebar_path(); ?>
				</aside><?php //.sidebar ?>
				<?php } // if() ?>
			</div><?php //.content ?>
		</div><?php //.wrap ?>
		<?php get_template_part( 'templates/footer' ); ?>
	</body>
</html>