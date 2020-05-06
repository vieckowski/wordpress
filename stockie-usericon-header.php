<?php
    // parts/elements/header-menu-optional-nav.php
	// Settings
	$header_style = StockieSettings::header_menu_style();

	$show_search = ! StockieSettings::get( 'header_hide_search', 'global' );
	$aligment_class = '';
	if ( $header_style == 'style3' ) {
		$show_search = false;
		$aligment_class = ' right';
	}
	if ( $header_style == 'style6' || $header_style == 'style5' ) {
		$show_search = false;
	}

	$have_woocomerce = function_exists( 'WC' );
	$have_woocomerce_wl = function_exists( 'YITH_WCWL' );
	$have_wpml = function_exists( 'icl_get_languages' );
	$wpml_show_in_header = StockieSettings::wpml_menu_item_is_displayed();
	$cart_visible = StockieSettings::get( 'woocommerce_cart_icon', 'global' );

	$header_button = StockieSettings::header_button();

	if( $header_button ) {
		$button_text = StockieSettings::get( 'text_for_button', 'global' );
		$button_link = StockieSettings::get( 'link_for_button', 'global' );
	}

?>

<?php if ( $show_search || ( $have_wpml && $wpml_show_in_header ) || $have_woocomerce || $have_woocomerce_wl ) : ?>

<ul class="menu-other<?php echo esc_attr( $aligment_class ); ?>">
	<li>
		<?php get_template_part( 'parts/elements/header-button' ); ?>
	</li>
	<?php if ( $header_style != 'style3' ) : ?>
	<p>Xs</p>
	<?php if ( $show_search ) : ?>
		<li class="search">
			<a data-nav-search="true">
				<i class="icon ion ion-md-search brand-color-hover-i"></i>
				<?php if ( $header_style == 'style6' ) { esc_html_e( 'Search', 'stockie' ); } ?>
			</a>
		</li>
	<?php endif; ?>
	<?php if ( $have_woocomerce ) : ?>
		<?php if ( $cart_visible !== false ) : ?>
            <?php if ($have_woocomerce_wl) : ?>
                <li>
                    <a href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url('user' . '/' . get_current_user_id())); ?>"
                       class="wishlist">
                        <i class="icon ion ion-md-heart-empty brand-color-hover-i"></i>
                        <span>
	                        <?php if ($header_style == 'style6') {
	                            esc_html_e('Wishlist', 'stockie');
	                        } ?>
                        </span>
                    </a>
                </li>
            <?php endif; ?>
		<li class="header-cart">
            <span class="cart-total font-titles">
            	<a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>"><?php echo WC()->cart->get_cart_total(); ?></a>	
            </span>
			<a href="#" class="cart">
				<span class="icon">
					<svg version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 12 16" xml:space="preserve">
					<path class="st0" d="M9,4V3c0-1.7-1.3-3-3-3S3,1.3,3,3v1H0v10c0,1.1,0.9,2,2,2h8c1.1,0,2-0.9,2-2V4H9z M4,3c0-1.1,0.9-2,2-2
						s2,0.9,2,2v1H4V3z"/>
					</svg>
                    <span class="cart-count brand-bg-color"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
				</span>
			</a>
			<div class="submenu_cart cart">
				<div class="cart_header">
					<div class="cart_heading">
						<h6 class="cart_heading_title"><?php esc_html_e( 'Review Cart', 'stockie' ); ?></h6>
					</div>
					<div class="close close-bar" id="close_cart">
						<div class="close-bar-btn btn-round round-animation" tabindex="0">
							<i class="ion ion-md-close"></i>	
						</div>
					</div>
				</div>
				<div class="widget_shopping_cart_content">
					<?php woocommerce_mini_cart(); ?>
				</div>
			</div>
			<div class="cart-overlay"></div>
		</li>
		<?php endif; ?>

	<?php endif; ?>
	<?php endif; ?>
</ul>

<?php endif; ?>