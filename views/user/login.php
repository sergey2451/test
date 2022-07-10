<?php include ROOT . '/views/layouts/header.php'; ?>

<body>
	<div class="container">
		<nav class="nav">
			<ul class="links">
				<li class="signup"><a class="link signup" href="/user/register/" id="btn-signup">sign up</a></li>
				<li class="signin"><a class="link signin active" href="#" id="btn-signin">sign in</a></li>
			</ul>
		</nav>
		<!-- sign-in form -->
		<div class="sign-form">
			<form class="form" method="POST" id="sign_in_form">
				<h1>Authorization</h1>
				<label for="login">Login</label>
				<input class="form-styling" id="login" type="text" name="login" value="<?php echo $login; ?>"><span class="error" id="loginErr"></span>
				<label for="password">Password</label>
				<input class="form-styling" id="password" type="password" name="password" value="<?php echo $password; ?>"><span class="error" id="passwordErr"></span>
				<input class="btn" onclick="signIn()" name="submit" value="sign in" id="sign-in-button" readonly>
				<span class="error" id="sign-in-errors"></span>
				<span class="success" id="sign-in-success"></span>
			</form>
		</div>
		<!-- /sign-in form -->
	</div>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="../../template/js/ajax.js"></script>
	<script>
	</script>
</body>

</html>