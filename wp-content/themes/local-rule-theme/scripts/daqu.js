$(document).ready(function ($) {
	// Woocommerce notice
	var $navbar = $("#wpadminbar");
	var $navbarHeight = $navbar.outerHeight();
	var $woonotice = $("p.woocommerce-store-notice");
	var $wooheight = $woonotice.outerHeight();
	var $headerHeight = $("header").outerHeight();
	var allHeight = $headerHeight + $wooheight;
	setTimeout(function () {
		if ($woonotice.is(":visible")) {
			$("header, .resp_menu_toggle").css("margin-top", `${$wooheight}px`);
			$("body").css("padding-top", `${$wooheight}px`);
		} else {
			$("div.tabs_nav_wrap").css("top", `${$headerHeight}px`);
		}
	}, 500);
	$("a.woocommerce-store-notice__dismiss-link").click(function () {
		$("header, .resp_menu_toggle").css("marginTop", "0");
		$("body").css("paddingTop", "0");
	});
	// Cart quantity update
	$("body").on("click", ".incdec", function () {
		var $button = $(this);
		var $input = $button
			.parent(".plus_minus")
			.siblings(".hidden_quantity")
			.find("input.input-text");
		var oldValue = $input.val();
		var newVal;
		if ($.trim($button.text()) == "+") {
			newVal = parseFloat(oldValue) + 1;
		} else {
			// Don't allow decrementing below zero
			if (oldValue >= 1) {
				newVal = parseFloat(oldValue) - 1;
			} else {
				newVal = 0;
			}
		}
		$input.val(newVal);
		$("button.update-cart").removeAttr("disabled").trigger("click");
	});
	// Wrap text inside menu
	$("nav.woocommerce-MyAccount-navigation ul li a")
		.contents()
		.filter(function () {
			return this.nodeType == 3 && $.trim(this.nodeValue).length;
		})
		.wrap("<span />");
});
