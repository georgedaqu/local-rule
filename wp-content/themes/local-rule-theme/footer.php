<?php
$instagram = get_field('field_62ac908ff306d', 'options');
$facebook = get_field('field_62ac90a7f306e', 'options');
?>
<footer class="trans-all-2">
	<div class="container">
		<div class="footer_left">
			<div class="logo">
				<img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="<?php echo get_bloginfo(); ?>">
			</div>
			<div class="socials">
				<h5>Follow us</h5>
				<ul>
					<li>
						<a href="<?php echo $instagram; ?>" target="_blank" title="Instagram">
							<em class="fa-brands fa-instagram"></em>
						</a>
					</li>
					<li>
						<a href="<?php echo $facebook; ?>" target="_blank" title="Facebook">
							<em class="fa-brands fa-facebook-f"></em>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="footer_mid">
			<div class="footer_menu">
				<h3>Shop</h3>
				<?php
				wp_nav_menu(array(
					'menu'			  => 'Shop',
					'items_wrap' 	  => '<ul>%3$s</ul>',
					'container'       => false,
					'menu_class'      => 'nav',
					'list_item_class' => 'nav-item',
					'link_class'      => 'nav-link',
				));
				?>
			</div>
			<div class="footer_menu">
				<h3>About us</h3>
				<?php
				wp_nav_menu(array(
					'menu'			  => 'About us',
					'items_wrap' 	  => '<ul>%3$s</ul>',
					'container'       => false,
					'menu_class'      => 'nav',
					'list_item_class' => 'nav-item',
					'link_class'      => 'nav-link',
				));
				?>
			</div>
			<div class="footer_menu">
				<h3>Support</h3>
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
		<div class="footer_right">
			<h3>Stay in Touch</h3>
			<h5>Sign up to our newsletter to keep up to date</h5>
			<?php echo do_shortcode('[mc4wp_form id="485"]'); ?>
		</div>
	</div>
</footer>
<script>
	var front_categories = new Swiper(".front_categories", {
		speed: 1000,
		loop: true,
		slidesPerView: 2,
		spaceBetween: 30,
		centeredSlides: false,
		navigation: {
			nextEl: ".front_categories_next",
			prevEl: ".front_categories_prev",
		},
		breakpoints: {
			1200: {
				slidesPerView: 4,
				spaceBetween: 20,
				centeredSlides: true,
			},
			768: {
				slidesPerView: 3,
				spaceBetween: 20,
				centeredSlides: true,
			}
		}
	});

	// latest products slider
	var latest_products_slider = new Swiper(".latest_products_slider", {
		speed: 1000,
		loop: false,
		slidesPerView: 3,
		slidesPerView: 1.7,
		spaceBetween: 0,
		centeredSlides: true,
		navigation: {
			nextEl: ".latest_products_slider_next",
			prevEl: ".latest_products_slider_prev",
		},
		breakpoints: {
			1200: {
				loop: false,
				slidesPerView: 4,
				spaceBetween: 20,
				centeredSlides: false
			},
			768: {
				loop: false,
				slidesPerView: 3,
				spaceBetween: 20,
				centeredSlides: false
			},
			365: {
				loop: true,
				slidesPerView: 1,
				slidesPerView: 1.7,
				spaceBetween: 15,
				centeredSlides: true
			},
			300: {
				loop: true,
				slidesPerView: 1,
				slidesPerView: 1.5,
				spaceBetween: 10,
				centeredSlides: true
			}
		}
	});

	// latest products slider
	var related_products_slider = new Swiper(".related_products_slider", {
		speed: 1000,
		loop: false,
		slidesPerView: 3,
		slidesPerView: 1.7,
		spaceBetween: 0,
		centeredSlides: true,
		navigation: {
			nextEl: ".related_products_slider_next",
			prevEl: ".related_products_slider_prev",
		},
		breakpoints: {
			1200: {
				loop: false,
				slidesPerView: 4,
				spaceBetween: 20,
				centeredSlides: false
			},
			768: {
				loop: false,
				slidesPerView: 3,
				spaceBetween: 20,
				centeredSlides: false
			},
			365: {
				loop: true,
				slidesPerView: 2.3,
				spaceBetween: 15,
				centeredSlides: false
			}
		}
	});

	// about page slider
	var aboutSlider = new Swiper(".about-slider", {
		speed: 1000,
		loop: true,
		centeredSlides: true,
		spaceBetween: 0,
		slidesPerView: 1.5,
		autoplay: {
			delay: 4000,
		},
		breakpoints: {
			768: {
				slidesPerView: 3.5,
				centeredSlides: true,
			},
			576: {
				slidesPerView: 3,
			},
			365: {
				slidesPerView: 2,
				centeredSlides: true,
			}
		}
	});

	// Thumbs gallery
	var thumbs_gallery = new Swiper(".thumbs_gallery", {
		spaceBetween: 3,
		slidesPerView: 4,
		freeMode: false,
		watchSlidesProgress: true,
		slideToClickedSlide: true,
		direction: 'horizontal',
		breakpoints: {
			1080: {
				direction: 'vertical',
			}
		}
	});
	var image_gallery = new Swiper(".image_gallery", {
		spaceBetween: 10,
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
		thumbs: {
			swiper: thumbs_gallery,
		},
	});
</script>


<?php wp_footer(); ?>

</body>
</html>
