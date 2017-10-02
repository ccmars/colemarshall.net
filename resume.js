function resumeOptions() {
	let highlightsDefault = 5;
	$('.resumeOptions input[type="checkbox"]').each(function () {
		if ($(this).attr('data-section').match(/-extended/)) {
			if ($(this).attr('data-section').match(/summary/)) {
				if ($(this).is(':checked')) {
					$('#resume').find('> div [data-section="summary"] p:nth-of-type(n+2)').show();
				} else {
					$('#resume').find('> div [data-section="summary"] p:nth-of-type(n+2)').hide();
				}
			} else if ($(this).attr('data-section').match(/highlights/)) {
				if ($(this).is(':checked')) {
					$('#resume').find('> div [data-section$="highlights"] li:nth-child(n+' + (highlightsDefault + 1) + ')').show();
				} else {
					$('#resume').find('> div [data-section$="highlights"] li:nth-child(n+' + (highlightsDefault + 1) + ')').hide();
				}
			}
		} else {
			if ($(this).is(':checked')) {
				console.log($(this).attr('data-section') + ' show');
				$('#resume').find('> div [data-section="' + $(this).attr('data-section') + '"]').show();
			} else {
				console.log($(this).attr('data-section') + ' hide');
				$('#resume').find('> div [data-section="' + $(this).attr('data-section') + '"]').hide();
			}
		}
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
});