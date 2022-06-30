$(document).ready(function () {
	// Selector styling
	$('select.selectori').select2({
		allowClear: true,
		minimumResultsForSearch: -1,
	});
	// Gallery
	$('.magnific').each(function () {
		$(this).magnificPopup({
			delegate: 'a',
			type: 'image',
			gallery: {
				enabled: true,
			},
			zoom: {
				enabled: true,
				duration: 300,
			},
		});
	});
	if ($('.magnific_video').length) {
		$('.magnific_video').magnificPopup({
			disableOn: 700,
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false,
		});
	}
});
