function handleSubmit() {

	let formData = {
		login: $("#login").val(),
		password: $('#password').val(),
		confirm_password: $('#confirm_password').val(),
		email: $("#email").val(),
		name: $('#name').val(),
	};

	$.ajax({
		url: '/user/register',
		method: 'POST',
		dataType: 'json',
		data: formData,
		success: function(data) {
			if (data.success) {
				$('#sign-up-errors').html(data.message).hide();
				$('#sign-up-success').html(data.message).show();
				$('#sign_up_form')[0].reset();
				$('#loginErr').html(data.errors[0]).hide();
				$('#passwordErr').html(data.errors[1]).hide();
				$('#confirm_passwordErr').html(data.errors[2]).hide();
				$('#emailErr').html(data.errors[3]).hide();
				$('#nameErr').html(data.errors[4]).hide();
			} else {
				$('#loginErr').html(data.errors[0]).show();
				$('#passwordErr').html(data.errors[1]).show();
				$('#confirm_passwordErr').html(data.errors[2]).show();
				$('#emailErr').html(data.errors[3]).show();
				$('#nameErr').html(data.errors[4]).show();
				$('#sign-up-errors').html(data.message).show();
				$('#sign-up-success').html(data.message).hide();

				if (data.errors[0] === '') {
					$('#loginErr').html(data.errors[5]).show();
				}

				if (data.errors[3] === '') {
					$('#emailErr').html(data.errors[6]).show();
				}
			}
		}
	});

	return false;
}

function signIn() {
	
	let formData = {
		login: $("#login").val(),
		password: $('#password').val(),
	};

	$.ajax({
		url: '/user/login',
		method: 'POST',
		dataType: 'json',
		data: formData,
		success: function(data) {
			if (data.success) {
				$('#sign-in-errors').html(data.message).hide();
				$('#sign-in-success').html(data.message).hide();
				$('#sign_in_form')[0].reset();
				$('#loginErr').html(data.errors[0]).hide();
				$('#passwordErr').html(data.errors[1]).hide();
				window.location.href = data.url;
				return false;
			} else {
				$('#loginErr').html(data.errors[0]).show();
				$('#passwordErr').html(data.errors[1]).show();
				$('#sign-in-errors').html(data.message).show();
				$('#sign-in-success').html(data.message).hide();
			}
		}
	});

	return false;
}