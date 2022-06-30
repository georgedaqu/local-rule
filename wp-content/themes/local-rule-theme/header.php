<?php

// if(!is_user_logged_in()){
// 	wp_redirect( 'https://local-rule.com/coming-soon/' );
// }

$instagram = get_field('field_62ac908ff306d', 'options');
$facebook = get_field('field_62ac90a7f306e', 'options');
$youtube = get_field('field_62b2fcf629810', 'options');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<?php wp_head(); ?>

	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.svg">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/scripts/css/main.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/scripts/css/nini.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/scripts/css/giorgi.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/scripts/css/daqu.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/scripts/swiper/swiper.css">

	<script src="<?php echo get_template_directory_uri(); ?>/scripts/js/main.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/scripts/giorgi.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/scripts/nini.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/scripts/daqu.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/scripts/swiper/swiper.js"></script>

	<!-- light gallery -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/scripts/lightgallery/lightgallery.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
	<script src="<?php echo get_template_directory_uri(); ?>/scripts/lightgallery/lightgallery.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/scripts/lightgallery/fullscreen.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/scripts/lightgallery/zoom.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>

	<?php echo get_field("custom_scripts", "options"); ?>

</head>
<body>

<?php if(is_active_sidebar('header_widget')): ?>
	<?php dynamic_sidebar('header_widget'); ?>
<?php endif; ?>

<div class="resp_menu_toggle">
	<div></div>
	<div></div>
</div>
<span class="resp_menu_overlay"></span>

<div class="resp_menu">
	<div class="resp_menu_wrapper">
		<div class="resp_header">
			<div class="logo">
				<a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo(); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="<?php echo get_bloginfo(); ?>">
				</a>
			</div>
			<div class="resp_menu_close">
				<em class="fa-light fa-xmark-large"></em>
			</div>
		</div>
		<!-- <div class="resp_search">
			<form action="index.php" autocomplete="off">
				<div class="form_item">
					<input type="search" class="underline" placeholder="Search">
					<button type="submit">
						<em class="fa-light fa-magnifying-glass"></em>
					</button>
				</div>
			</form>
		</div> -->
		<div class="resp_cart">
			<a href="<?php echo wc_get_cart_url(); ?>" title="Cart">
				<em class="fa-regular fa-bag-shopping"></em>
			</a>
			<div class="cart_details">
				<h3>
					<a href="<?php echo wc_get_cart_url(); ?>" title="Cart">
						Your Cart
						<?php $cart_count = WC()->cart->get_cart_contents_count(); ?>
						<?php if ( $cart_count ) : ?>
							<span>(<?php echo $cart_count; ?> Item)</span>
						<?php endif; ?>
					</a>
				</h3>

			</div>
		</div>
		<div class="resp_menu_ul">
			<?php
			wp_nav_menu(array(
				'menu'			  => 'Mobile Menu',
				'items_wrap' 	  => '<ul>%3$s</ul>',
				'container'       => false,
				'menu_class'      => 'nav',
				'list_item_class' => 'nav-item',
				'link_class'      => 'nav-link',
			));
			?>
		</div>
		<?php if (!is_user_logged_in()) : ?>
			<div class="resp_buttons">
				<ul>
					<li>
						<a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>" title="Login In">login in</a>
					</li>
					<li>
						<a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>" title="Sign Up">sign up</a>
					</li>
				</ul>
			</div>
		<?php endif; ?>
		<div class="resp_socials">
			<h4>follow us</h4>
			<ul>
				<li><a href="<?php echo $instagram; ?>">
					<em class="fa-brands fa-instagram"></em>
				</a></li>
				<li><a href="<?php echo $facebook; ?>">
					<em class="fa-brands fa-facebook-f"></em>
				</a></li>
				<li><a href="<?php echo $youtube; ?>">
					<em class="fa-brands fa-youtube"></em>
				</a></li>
			</ul>
		</div>
<!--		<div class="resp_contact">-->
<!--			<input type="email" name="email" id="email" placeholder="Your Email">-->
<!--			<button type="submit">send-->
<!--				<em class="fa-thin fa-angle-right"></em>-->
<!--			</button>-->
<!--		</div>-->
		<div class="resp_footer_menu">
			<?php
			wp_nav_menu(array(
				'menu'			  => 'Support',
				'items_wrap' 	  => '<ul>%3$s</ul>',
				'container'       => false,
				'menu_class'      => 'nav',
				'list_item_class' => 'nav-item',
				'link_class'      => 'nav-link',
			));
			?>
		</div>
	</div>
</div>

<header class="trans-all-2" style="position:absolute;">
	<div class="container">
		<div class="header_left">
			<div class="logo">
				<a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo(); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="<?php echo get_bloginfo(); ?>">
				</a>
			</div>
			<nav class="navigation">
				<?php
				wp_nav_menu(array(
					'theme_location'  => 'header_menu',
					'menu'			  => 'header_menu',
					'items_wrap' 	  => '<ul>%3$s</ul>',
					'container'       => false,
					'menu_class'      => 'nav',
					'list_item_class' => 'nav-item',
					'link_class'      => 'nav-link',
					'menu_id' => 'menu-main-menu'
				));
				?>
			</nav>
		</div>
		<div class="header_right">
			<!-- <div class="search">
				<form action="index.php" autocomplete="off">
					<div class="form_item">
						<input type="search" class="white" placeholder="Search">
						<button type="submit">
							<em class="fa-light fa-magnifying-glass"></em>
						</button>
					</div>
				</form>
			</div> -->
			<div class="header_buttons">
				<ul>
					<li>
						<a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>" title="My Account">
							<em class="fa-regular fa-user"></em>
						</a>
					</li>
					<li>
						<a href="<?php echo wc_get_cart_url(); ?>" title="Cart">
							<em class="fa-regular fa-bag-shopping"></em>
							<?php $cart_count = WC()->cart->get_cart_contents_count(); ?>
							<?php if ( $cart_count ) : ?>
								<span><?php echo $cart_count; ?></span>
							<?php endif; ?>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</header>
<style>
	@media(max-width: 768px){
		header{
			position: absolute !important;
		}
		div.resp_menu_toggle{
			position: absolute !important;
		}
		.woocommerce-store-notice,
		p.demo_store{
			position: absolute !important;
		}
	}
</style>