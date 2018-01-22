function resumeOptions(hide = false) {
	let highlightsDefault = 5;
	let showHideSpeed = 500;
	$('.resumeOptions input[type="checkbox"]').each(function () {
		if ($(this).attr('data-section').match(/-extended/)) {
			if ($(this).attr('data-section').match(/summary/)) {
				let summaryElement = $('#resume').find('> div [data-section="summary"] p:nth-of-type(n+2)');
				if ($(this).is(':checked')) {
					hide ? summaryElement.show({duration: 0, complete: function() { resizeBands(); }}) : summaryElement.fadeIn(showHideSpeed,function () { resizeBands() });
				} else {
					hide ? summaryElement.hide({duration: 0, complete: function() { resizeBands(); }}) : summaryElement.fadeOut(showHideSpeed,function () { resizeBands() });
				}
			} else if ($(this).attr('data-section').match(/highlights/)) {
				let highlightsElement = $('#resume').find('> div [data-section$="highlights"] li:nth-child(n+' + (highlightsDefault + 1) + ')');
				if ($(this).is(':checked')) {
					hide ? highlightsElement.show({duration: 0, complete: function() { resizeBands(); }}) : highlightsElement.fadeIn(showHideSpeed,function () { resizeBands() });
				} else {
					hide ? highlightsElement.hide({duration: 0, complete: function() { resizeBands(); }}) : highlightsElement.fadeOut(showHideSpeed,function () { resizeBands() });
				}
			}
		} else {
			let sectionElement = $('#resume').find('> div [data-section="' + $(this).attr('data-section') + '"]');
			if ($(this).is(':checked')) {
				hide ? sectionElement.show({duration: 0, complete: function() { resizeBands(); }}) : sectionElement.fadeIn(showHideSpeed,function () { resizeBands() });
			} else {
				hide ? sectionElement.hide({duration: 0, complete: function() { resizeBands(); }}) : sectionElement.fadeOut(showHideSpeed,function () { resizeBands() });
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
	resumeOptions(true);
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

	$('.cm_wireframe').svgInject();
});