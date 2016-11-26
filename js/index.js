function textAreaAdjust(o) {
	o.style.height = '1px';
	o.style.height = (4 + o.scrollHeight) + 'px';
}

$(function() {
	$('.anonyWhoPic').parent().find('[data-name="' + $('#anonyWho').val() + '"]').fadeIn();

	$('#anonyWho').change(function() {
		$('.anonyWhoPic').hide();
		$('.anonyWhoPic').parent().find('[data-name="' + $('#anonyWho').val() + '"]').fadeIn();
	});

	$('#anonySubmit').click(function() {
		var anonyWho = $('#anonyWho').val();
		var anonyMessage = $.trim($("#anonyMessage").val());
		if (!anonyMessage)
		{
			console.log("Message empty");
			return;
		}

		$('#anonySubmit').prop('disabled', true);
		var anonySubmitControl = 5;
		var anonySubmitDisabled = true;
		var anonySubmitSending = true;
		var originalText = $('#anonySubmit').text();
		var interval = setInterval(function() {
			$('#anonySubmit').text('冷卻還有 ' + --anonySubmitControl + ' 秒');
			if (0 >= anonySubmitControl) {
				$('#anonySubmit').prop('disabled', false).text(originalText);
				anonySubmitDisabled = false;
				if (!anonySubmitSending && !anonySubmitDisabled)
				{
					$('#anonySubmit').prop('disabled', false);
				}
				clearInterval(interval);
			}
		}, 1000);

		$.ajax({
			url: 'controller.php',
			method: 'post',
			data: {
				action: 'execute',
				name: anonyWho,
				content: anonyMessage
			},
			dataType:"json"
		}).done(function(result) {
			// console.log(result);
			$('#anonyMessage').val('');
			anonySubmitSending = false;
			if (!anonySubmitSending && !anonySubmitDisabled)
			{
				$('#anonySubmit').prop('disabled', false);
			}
		}).fail(function(jqXHR, textStatus, errorThrown) {
			console.log("AJAX failed:\n" + textStatus + "\n" + errorThrown );
			console.log(jqXHR);
			anonySubmitSending = false;
			if (!anonySubmitSending && !anonySubmitDisabled)
			{
				$('#anonySubmit').prop('disabled', false);
			}
		});
	})
});
