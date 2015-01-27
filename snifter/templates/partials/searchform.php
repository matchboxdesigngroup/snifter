<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
		<input type="search" value="<?php if ( is_search() ) { echo get_search_query(); } ?>" name="s" class="search-field" placeholder="<?php _e( 'Search', 'snifter' ); ?>">
		<label class="hide"><?php _e( 'Search for:', 'snifter' ); ?></label>
		<button type="submit" class="search-submit"><?php _e( 'Search', 'snifter' ); ?></button>
</form> <?php // .search-form ?>
