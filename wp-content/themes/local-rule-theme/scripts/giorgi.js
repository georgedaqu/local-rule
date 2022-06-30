jQuery(document).ready(function ($) {
	// filters

	$("div.filter-block > h3").on("click", function () {
		var filterBody = $("div.filter-block div.form_container");
		if (filterBody.is(":hidden")) {
			$(this).addClass("visible");
			$(filterBody).fadeIn(300);
		} else {
			$(this).removeClass("visible");
			$(filterBody).fadeOut(300);
		}
	});

	$(document).on("click", function (e) {
		if (!$(e.target).closest("div.filter-block").length > 0) {
			$("div.filter-block div.form_container").fadeOut(300);
			$("div.filter-block div.form_container").removeClass("visible");
		}
	});

	// filter inside dropdown

	$("div.form_container form h5").on("click", function () {
		$(this).toggleClass("opened");
		var filter_content = $(this).next("ul");
		if (filter_content.is(":hidden")) {
			filter_content.slideDown(400);
		} else {
			filter_content.slideUp(400);
		}
	});

	//slider video paly/pause

	$(".play-trigger").on("click", function () {
		$(this).fadeOut(200);
		var $video = $(".image_gallery .swiper-wrapper .swiper-slide video");
		$video.attr("controls", "");
		$video[0].play();
		// $video.on("pause", function () {
		// 	$(".play-trigger").fadeIn(200);
		// });
		// $video.on("ended", function () {
		// 	$(".play-trigger").fadeIn(200);
		// });
	});

	//lightgallery

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

	//form swithcer

	$(".form_switcher").on("click", function () {
		let create_account = $(this).hasClass("create_account");
		let log_in = $(this).hasClass("login");

		if (create_account) {
			$("div.u-column1").css("display", "none");
			$("div.u-column2").css("display", "block");
		}
		if (log_in) {
			$("div.u-column2").css("display", "none");
			$("div.u-column1").css("display", "block");
		}
	});
});
