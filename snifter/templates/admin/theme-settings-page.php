<?php global $sn_settings; ?>
<?php $theme = wp_get_theme(); ?>
<div>
	<h2><?php echo esc_attr( "{$theme->Name} Options" ); ?></h2>
	<form action="options.php" method="post">
		<?php settings_fields( $sn_settings->option_group ); ?>
		<?php do_settings_sections( $sn_settings->page_slug ); ?>
		<input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e( 'Save Settings' ); ?>">
	</form>
</div>