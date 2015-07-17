<?php global $content_width; ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>>
  <!--<![endif]-->

  <head>
    <meta charset="utf-8">
    <title>
      <?php wp_title('|', true, 'right'); ?>
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--[if IE 8]> <meta name="viewport" content="width=1170, maximum-scale=1.0, user-scalable=yes"> <![endif]-->
    <!--[if gt IE 8]><!-->
    <script>
      var screenWidth  = (typeof screen.width === 'undefined') ? 0 : screen.width,
        windowWidth    = (typeof window.outerWidth === 'undefined') ? 0 : window.outerWidth,
        deviceWidth    = <?php echo esc_attr($content_width); ?>,
				mobileWidth    = 767,
        respMeta       = '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>',
        noRespMeta     = '<meta name="viewport" content="width='+deviceWidth+', maximum-scale=1.0, user-scalable=yes">',
        noWidthDefined = (screenWidth === 0 && windowWidth === 0);

      // Get the device width
      if (screenWidth === 0 && !noWidthDefined) {
        deviceWidth = windowWidth;
      } else if (windowWidth === 0 && !noWidthDefined) {
        deviceWidth = screenWidth;
      } // if/elseif/else()

      // This allows the template to be responsive under 767 but not when above
      if (deviceWidth > mobileWidth) {
        // Sets the viewport to 1200
        document.write(noRespMeta);
      } else {
        // Sets the viewport to device size
        document.write(respMeta);
      } // if/else()

    </script>
    <!--<![endif]-->

    <?php wp_head(); ?>

      <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
  </head>
