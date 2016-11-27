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
		var anonyMessage = $.trim($("#anonyMessage").val());
		if (!anonyMessage)
		{
			console.log("Message empty");
			return;
		}

		var anonyWho = $('#anonyWho').val();
		var avatarNum = $('.anonyWhoPic:visible').data('avatar');

		$('#anonySubmit').prop('disabled', true);
		var anonySubmitControl = 5;
		var anonySubmitDisabled = true;
		var anonySubmitSending = true;
		var originalText = $('#anonySubmit').text();
		$('#anonySubmit').text('訊息發送中...');
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
				content: anonyMessage,
				avatar: avatarNum
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

	$('#logFileSelect').change(function() {
		$('#logFileSelect').prop('disabled', true);
		$('#logRefresh').fadeIn();

		$.ajax({
			url: 'controller.php',
			method: 'post',
			data: {
				action: 'getlogfile',
				filename: $(this).val()
			},
			dataType: 'json'
		}).done(function(result) {
			// console.log(result);
			$('#logContent').html('');
			var log = result['getlogfile'];
			$.each(log, function(index, item) {
				var logHTML =
				"<div class='logEntry row'>"+
					"<div class='logTime col-xl-2 col-md-3'>" + log[index].request_time_local + "</div>"+
					"<div class='logIPPort col-xl-2 col-md-9' title='" + log[index].user_agent + "'>"+
						"<span class='logIP'>" + log[index].remote_addr + "</span><span class='logPort'>:" + log[index].remote_port + "</span>"+
					"</div>"+
					"<div class='logName col-xl-1 col-md-3'>" + log[index].username + "</div>"+
					"<div class='logMessage col-xl-7 col-md-9'>" + log[index].content + "</div>"+
				"</div>";
				$('#logContent').append(logHTML);
			});
			$('#logFileSelect').prop('disabled', false);
			$('#logTitle').show();
		}).fail(function(jqXHR, textStatus, errorThrown) {
			console.log("AJAX failed:\n" + textStatus + "\n" + errorThrown );
			console.log(jqXHR);
			$('#logFileSelect').prop('disabled', false);
		});
	});
	$('#logRefresh').click(function() {
		$(this).prop('disabled', true);
		$('#logFileSelect').change();
		$(this).prop('disabled', false);
	});
});
