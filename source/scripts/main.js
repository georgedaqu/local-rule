import "select2";

import "./libs/hamburger_menu.js";
import "./libs/artmedia_functions.js";
import "./libs/additional_functions.js";
import "./libs/plugin_parameters.js";

import $ from "jquery";
window.jQuery = $;
window.$ = $;

// hero text animation
$(window).on("load", function () {
	// when dom loaded hero_content added calss animate_text and will started animation
	$(".hero_content").addClass("animate_text");
});

$(document).ajaxComplete(function(event, xhr, settings) {
	if(settings.url === '/?wc-ajax=update_shipping_method'){
		if($('#shipping_method_0_local_pickup29').is(':checked')){
			$(".woocommerce-shipping-destination").addClass("hidden_element");
		}else{
			$(".woocommerce-shipping-destination").removeClass("hidden_element");
		}
	}
	if(settings.url === '/?wc-ajax=update_order_review'){
		$("div.woocommerce-checkout-review-order table.shop_table tfoot tr td").attr("colspan", "2");
	}
});

$(document).ready(function ($) {
	// Remove address on pick up at store
	if($('#shipping_method_0_local_pickup29').is(':checked')){
		$(".woocommerce-shipping-destination").addClass("hidden_element");
	}

	// ajax for gallery
	const productVariations = $(".variations_form").data("product_variations");
	const colorRadio = $(".pa-color-ajax-class");
	const sizeRadio = $(".pa-size-ajax-class");
	let changeGallery = false;

	colorRadio.change(function () {
		let color = $(this).data("name");
		$(".color_span").html(": " + color);
		changeGallery = true;
	});
	sizeRadio.change(function () {
		let size = $(this).data("size");
		$(".size_span").html(": " + size);
	});

	if(!sizeRadio.length && colorRadio.length){
		colorRadio.each(function () {
			if ($(this).is(":checked")) {
				let color = $(this).data("color");
				let variationId = false;
				$.each(productVariations, function (i, item) {
					if (item["attribute_pa_color"] === color) {
						variationId = i;
					}
				});
				if(variationId){
					$(".color_span").html(": " + color);
					$("#add-to-cart-button").prop("disabled", false);
					$(".variations_form input[name=variation_id]").val(variationId);
				}
			}
		});
	}

	$(".variation-ajax-class").change(function () {
		if (sizeRadio.length && colorRadio.length) {
			if (sizeRadio.is(":checked") && colorRadio.is(":checked")) {
				$("#add-to-cart-button").prop("disabled", false);
			}
		} else if (sizeRadio.length) {
			if (sizeRadio.is(":checked")) {
				$("#add-to-cart-button").prop("disabled", false);
			}
		} else if (colorRadio.length) {
			if (colorRadio.is(":checked")) {
				$("#add-to-cart-button").prop("disabled", false);
			}
		}
		let color = false;
		let size = false;
		let productID = false;
		let variationId = false;

		if (sizeRadio.is(":checked") && colorRadio.is(":checked")) {
			sizeRadio.each(function () {
				if ($(this).is(":checked")) {
					size = $(this).data("size");
				}
			});
			colorRadio.each(function () {
				if ($(this).is(":checked")) {
					color = $(this).data("color");
				}
			});
			productID = $("#product-gallery-container").data("productid");
			window.history.pushState(
				"",
				"Product Variation",
				"?attribute_pa_color=" + color
			);

			$.each(productVariations, function (i, item) {
				if (
					item["attribute_pa_color"] === color &&
					item["attribute_pa_size"] === size
				) {
					variationId = i;
				}
			});
		} else if (sizeRadio.is(":checked")) {
			sizeRadio.each(function () {
				if ($(this).is(":checked")) {
					size = $(this).data("size");
				}
			});

			if (colorRadio.length === 0) {
				$.each(productVariations, function (i, item) {
					if (item["attribute_pa_size"] === size) {
						variationId = i;
					}
				});
			}
		} else if (colorRadio.is(":checked")) {
			colorRadio.each(function () {
				if ($(this).is(":checked")) {
					color = $(this).data("color");
				}
			});
			productID = $("#product-gallery-container").data("productid");
			window.history.pushState(
				"",
				"Product Variation",
				"?attribute_pa_color=" + color
			);

			if (sizeRadio.length === 0) {
				$.each(productVariations, function (i, item) {
					if (item["attribute_pa_color"] === color) {
						variationId = i;
					}
				});
			}
		}

		if (variationId !== false) {
			$(".variations_form input[name=variation_id]").val(variationId);
			$.ajax({
				type: "POST",
				url: "/wp-admin/admin-ajax.php",
				data: {
					action: "product_gallery",
					variationId: variationId,
				},
				success: function (res) {
					$("#product_stock").html(res);
				},
			});
		}

		if (color && productID && changeGallery) {
			changeGallery = false;
			$.ajax({
				type: "POST",
				url: "/wp-admin/admin-ajax.php",
				data: {
					action: "product_gallery",
					variationColor: color,
					productID: productID,
				},
				success: function (res) {
					$("#product-gallery-container").empty();
					$("#product-gallery-container").html(res);
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
					lightGallery(document.getElementById("main_gallery"), {
						mode: "lg-slide",
						cssEasing: "cubic-bezier(0.25, 0, 0.25, 1)",
						counter: false,
						share: false,
						autoplay: false,
						download: false,
						actualSize: false,
						selector: "div.image",
					});
					$(".play-trigger").on("click", function () {
						$(this).fadeOut(200);
						var $video = $(".image_gallery .swiper-wrapper .swiper-slide video");
						$video.attr("controls", "");
						$video[0].play();
					});
				},
			});
		}
	});

	// Submit filter form
	$("#id_show_all_size").click(function () {
		$(".form_uncheck_size").prop("checked", false);
		$("#form_filter_id_for_submit").submit();
	});
	$("#id_show_all_color").click(function () {
		$(".form_uncheck_color").prop("checked", false);
		$("#form_filter_id_for_submit").submit();
	});
	$(".form_submit_jj").click(function () {
		$("#form_filter_id_for_submit").submit();
	});
	// Update quantity
	$(document).on("click", "div.plus, div.minus", function () {
		var qty = $(this).parent(".quantity").find(".qty");
		var val = parseFloat(qty.val());
		var max = parseFloat(qty.attr("max"));
		var min = parseFloat(qty.attr("min"));
		var step = parseFloat(qty.attr("step"));
		if ($(this).is(".plus")) {
			if (max && max <= val) {
				qty.val(max).change();
			} else {
				qty.val(val + step).change();
			}
		} else {
			if (min && min >= val) {
				qty.val(min).change();
			} else if (val > 1) {
				qty.val(val - step).change();
			}
		}
	});
});
