function resumeOptions() {
	let highlightsDefault = 5;
	let showHideSpeed = 200;
	$('.resumeOptions input[type="checkbox"]').each(function () {
		if ($(this).attr('data-section').match(/-extended/)) {
			if ($(this).attr('data-section').match(/summary/)) {
				if ($(this).is(':checked')) {
					$('#resume').find('> div [data-section="summary"] p:nth-of-type(n+2)').fadeIn(showHideSpeed,function () { resizeBands() });
				} else {
					$('#resume').find('> div [data-section="summary"] p:nth-of-type(n+2)').fadeOut(showHideSpeed,function () { resizeBands() });
				}
			} else if ($(this).attr('data-section').match(/highlights/)) {
				if ($(this).is(':checked')) {
					$('#resume').find('> div [data-section$="highlights"] li:nth-child(n+' + (highlightsDefault + 1) + ')').fadeIn(showHideSpeed,function () { resizeBands() });
				} else {
					$('#resume').find('> div [data-section$="highlights"] li:nth-child(n+' + (highlightsDefault + 1) + ')').fadeOut(showHideSpeed,function () { resizeBands() });
				}
			}
		} else {
			if ($(this).is(':checked')) {
				$('#resume').find('> div [data-section="' + $(this).attr('data-section') + '"]').fadeIn(showHideSpeed,function () { resizeBands() });
			} else {
				$('#resume').find('> div [data-section="' + $(this).attr('data-section') + '"]').fadeOut(showHideSpeed,function () { resizeBands() });
			}
		}
		resizeBands();
	});
}

function resizeBands() {
	$('#resume div div[data-section] div').each(function() {
		$(this).height($(this).parent().height()+300);
	});
}

$(document).ready(function() {
	resumeOptions();
	$('.resumeOptions input[type="checkbox"]').change(function() {
		resumeOptions();
	});

	$('.resumeOptions .print').click(function() {
		window.print();
	});

	resizeBands();
	$(window).resize(function() {
		resizeBands();
	});
});