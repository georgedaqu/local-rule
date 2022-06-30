jQuery(document).ready(function ($) {
	// Sub menu positioning based on viewport width
	$(window).bind("load resize", function (e) {
		$("nav.navigation > ul > li ul").each(function (e) {
			var $this = $(this);
			var $panjara = $(window).width();
			var $sigane = $this.outerWidth();
			var $mdebareoba = $this.offset();
			var $mdebareoba_left = $mdebareoba.left;
			var $jamshi = $sigane + $mdebareoba_left;
			if ($jamshi > $panjara) {
				$this.addClass("rtl");
			} else {
				$this.removeClass("rtl");
			}
		});
	});
	// Automatic select of horizontal menu of active items
	$("nav.navigation > ul > li ul li.active").parents("li").addClass("active");
	// Sub menu arrow
	$("nav.navigation > ul > li").each(function () {
		var $this = $(this);
		if ($this.has("ul").length) {
			$this.addClass("hasul");
		}
	});
	// Clone to responsive menu
	var clone = $("nav.navigation > ul").clone();
	// $('div.resp_menu div.resp_menu_ul').html(clone);
	// Responsive menu
	$("div.resp_menu_toggle").click(function () {
		var $this = $(this);
		var $resp_menu = $("div.resp_menu");
		$("span.resp_menu_overlay").fadeIn(300);
		$this.addClass("resp_menu_toggled");
		$resp_menu.addClass("opened");
		$("html, body").addClass("toggled");
		$("body").css("overflow", "hidden");
	});

	$("span.resp_menu_overlay").click(function () {
		$(".resp_menu").removeClass("opened");
		$("html, body").removeClass("toggled");
		$("span.resp_menu_overlay").fadeOut(300);
		$("body").css("overflow", "");
		$("em.fa-xmark-large").css("transform", "rotate(90deg)");
	});

	$("div.resp_menu_close").click(function () {
		var $resp_menu = $("div.resp_menu");
		$resp_menu.removeClass("opened");
		$("html, body").removeClass("toggled");
		$("span.resp_menu_overlay").fadeOut(300);
		$("body").css("overflow", "");
	});

	$("div.resp_menu div.resp_menu_ul ul li")
		.has("ul")
		.find("> a")
		.wrap('<div class="parent_menu"></div>').after(`
		<div class="plus_minus">
			<div class="plus"></div>
			<div class="minus"></div>
		</div>
	`);
	$(
		"div.resp_menu div.resp_menu_ul ul li div.parent_menu div.plus_minus"
	).click(function () {
		var $this = $(this);
		var $resp_sub_menu = $this.parent("div.parent_menu").next("ul");
		if ($resp_sub_menu.is(":hidden")) {
			$this.addClass("plus_minus_toggled");
			$resp_sub_menu.slideDown(400);
		} else {
			$this.removeClass("plus_minus_toggled");
			$resp_sub_menu.slideUp(400);
		}
	});

	// on scroll fix menu
	$(window).scroll(function () {
		let height = $("header").outerHeight();
		if ($(window).scrollTop() >= height) {
			$("header").addClass("positioning");
			$("header").css("position", "fixed");
			$(".resp_menu_toggle").addClass("positioning");

			setTimeout(function () {
				$("header").addClass("sliding");
				$(".resp_menu_toggle").addClass("fixed sliding");
			}, 10);
		}
		if ($(window).scrollTop() == 0) {
			$("header").removeClass("sliding positioning");
			$("header").css("position", "absolute");
			$(".resp_menu_toggle").removeClass("fixed sliding positioning");
		}
	});
	// on scroll fix menu

	// search effects

	$(".header_right .search form input.white")
		.blur(function () {
			if ($(this).val().length === 0) {
				$("input.white").removeClass("focus");
			}
		})
		.focus(function () {
			$(this).addClass("focus");
		});

	// search effects
});
