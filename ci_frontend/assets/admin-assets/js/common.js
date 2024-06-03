function ajaxPost(_url, _parameters, _successCallback) {
	// $( 'button, button[type=submit], input[type=submit]' ).prop('disabled', true);
	// showBlurLoading();

	$.ajax({
		url: _url,
		type: "POST",
		dataType: "json",
		data: _parameters,
	})
		.done(function (response) {
			_successCallback(response);

			// $( 'button, button[type=submit], input[type=submit]' ).prop('disabled', false);
			// hideBlurLoading();
		})
		.fail(function (xhr, status) {
			console.log("URL: " + _url);
			console.log("AJAX Request Error.");
			console.log("Status: " + status);

			console.log("/** --- --- --- */");

			console.log("XHR: ");
			console.log(xhr);
			// errorSwal(xhr.responseText);

			// $( 'button, button[type=submit], input[type=submit]' ).prop('disabled', false);
			// hideBlurLoading();
		});
}

function successSwal(_message, _redirect = "") {
	swal({
		title: "Success!",
		html: _message,
		type: "success",
		allowEscapeKey: false,
		allowOutsideClick: false,
		showLoaderOnConfirm: true,
		preConfirm: function () {
			return new Promise(function (success) {
				if (_redirect == "") {
					swal.close();
				} else {
					// setTimeout(() => {
					window.location.href = _redirect;
					// success();
					// }, 500);
				}
				// setTimeout(() => {
				// 	((_redirect == '') ? swal.close() : window.location.href = _redirect);
				// 	success();
				// }, 500);
			});
		},
	});
}

function errorSwal(_message) {
	swal({
		title: "Error!",
		html: _message,
		type: "error",
	});
}
