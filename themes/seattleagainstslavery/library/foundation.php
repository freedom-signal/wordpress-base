<?php
/**
 * Foundation PHP template
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

/**
 * A fallback when no navigation is selected by default.
 */

if ( ! function_exists( 'foundationpress_menu_fallback' ) ) :
	function foundationpress_menu_fallback() {
		echo '<div class="alert-box secondary">';
		/* translators: %1$s: link to menus, %2$s: link to customize. */
		printf(
			__( 'Please assign a menu to the primary menu location under %1$s or %2$s the design.', 'foundationpress' ),
			/* translators: %s: menu url */
			sprintf(
				__( '<a href="%s">Menus</a>', 'foundationpress' ),
				get_admin_url( get_current_blog_id(), 'nav-menus.php' )
			),
			/* translators: %s: customize url */
			sprintf(
				__( '<a href="%s">Customize</a>', 'foundationpress' ),
				get_admin_url( get_current_blog_id(), 'customize.php' )
			)
		);
		echo '</div>';
	}
endif;

// Add Foundation 'is-active' class for the current menu item.
if ( ! function_exists( 'foundationpress_active_nav_class' ) ) :
	function foundationpress_active_nav_class( $classes, $item ) {
		if ( $item->current == 1 || $item->current_item_ancestor == true ) {
			$classes[] = 'is-active';
		}
		return $classes;
	}
	add_filter( 'nav_menu_css_class', 'foundationpress_active_nav_class', 10, 2 );
endif;

/**
 * Use the is-active class of ZURB Foundation on wp_list_pages output.
 * From required+ Foundation http://themes.required.ch.
 */
if ( ! function_exists( 'foundationpress_active_list_pages_class' ) ) :
	function foundationpress_active_list_pages_class( $input ) {

		$pattern = '/current_page_item/';
		$replace = 'current_page_item is-active';

		$output = preg_replace( $pattern, $replace, $input );

		return $output;
	}
	add_filter( 'wp_list_pages', 'foundationpress_active_list_pages_class', 10, 2 );
endif;

/**
 * Enable Foundation responsive embeds for WP video embeds
 */

if ( ! function_exists( 'foundationpress_responsive_video_oembed_html' ) ) :
	function foundationpress_responsive_video_oembed_html( $html, $url, $attr, $post_id ) {

		// Whitelist of oEmbed compatible sites that **ONLY** support video.
		// Cannot determine if embed is a video or not from sites that
		// support multiple embed types such as Facebook.
		// Official list can be found here https://codex.wordpress.org/Embeds
		$video_sites = array(
			'youtube', // first for performance
			'collegehumor',
			'dailymotion',
			'funnyordie',
			'ted',
			'videopress',
			'vimeo',
		);

		$is_video = false;

		// Determine if embed is a video
		foreach ( $video_sites as $site ) {
			// Match on `$html` instead of `$url` because of
			// shortened URLs like `youtu.be` will be missed
			if ( strpos( $html, $site ) ) {
				$is_video = true;
				break;
			}
		}

		// Process video embed
		if ( true == $is_video ) {

			// Find the `<iframe>`
			$doc = new DOMDocument();
			$doc->loadHTML( $html );
			$tags = $doc->getElementsByTagName( 'iframe' );

			// Get width and height attributes
			foreach ( $tags as $tag ) {
				$width  = $tag->getAttribute( 'width' );
				$height = $tag->getAttribute( 'height' );
				break; // should only be one
			}

			$class = 'responsive-embed'; // Foundation class

			// Determine if aspect ratio is 16:9 or wider
			if ( is_numeric( $width ) && is_numeric( $height ) && ( $width / $height >= 1.7 ) ) {
				$class .= ' widescreen'; // space needed
			}

			// Wrap oEmbed markup in Foundation responsive embed
			return '<div class="' . $class . '">' . $html . '</div>';

		} else { // not a supported embed
			return $html;
		}

	}
	add_filter( 'embed_oembed_html', 'foundationpress_responsive_video_oembed_html', 10, 4 );
endif;

/**
 * Get mobile menu ID
 */

if ( ! function_exists( 'foundationpress_mobile_menu_id' ) ) :
	function foundationpress_mobile_menu_id() {
		if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) {
			echo 'off-canvas-menu';
		} else {
			echo 'mobile-menu';
		}
	}
endif;

/**
 * Get title bar responsive toggle attribute
 */

if ( ! function_exists( 'foundationpress_title_bar_responsive_toggle' ) ) :
	function foundationpress_title_bar_responsive_toggle() {
		if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) === 'topbar' ) {
			echo 'data-responsive-toggle="mobile-menu"';
		}
	}
endif;
