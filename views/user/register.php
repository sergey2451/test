<?php include ROOT . '/views/layouts/header.php'; ?>

<body>
	<div class="container">
		<nav class="nav">
			<ul class="links">
				<li class="signup"><a class="link signup active" href="#" id="btn-signup">sign up</a></li>
				<li class="signin"><a class="link signin" href="/user/login/" id="btn-signin">sign in</a></li>
			</ul>
		</nav>
		<!-- sign-up form -->
		<div class="sign-form">
			<form class="form" method="POST" id="sign_up_form">
				<h1>Registration</h1>
				<label for="login">Login</label>
				<input class="form-styling" id="login" type="text" name="login" value="<?php echo $login; ?>"><span class="error" id="loginErr"></span>
				<label for="password">Password</label>
				<input class="form-styling" id="password" type="password" name="password" value="<?php echo $password; ?>"><span class="error" id="passwordErr"></span>
				<label for="confirm_password">Confirm password</label>
				<input class="form-styling" id="confirm_password" type="password" name="confirm_password" value="<?php echo $confirm_password; ?>"><span class="error" id="confirm_passwordErr"></span>
				<label for="email">Email</label>
				<input class="form-styling" id="email" type="email" name="email" value="<?php echo $email; ?>"><span class="error" id="emailErr"></span>
				<label for="name">Name</label>
				<input class="form-styling" id="name" type="text" name="name" value="<?php echo $name; ?>"><span class="error" id="nameErr"></span>
				<input class="btn" onclick="handleSubmit()" name="submit" value="sign up" id="sign-up-button" readonly>
				<span class="error" id="sign-up-errors"></span>
				<span class="success" id="sign-up-success"></span>
			</form>
		</div>
		<!-- /sign-up form -->
	</div>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="../../template/js/ajax.js"></script>
</body>

</html>