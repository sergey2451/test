<?php include ROOT . '/views/layouts/header.php'; ?>

<body>
	<div class="container">
		<p>Hello <?php echo $user['name']; ?></p>
		<a href="/user/logout/" class="btn">Log out</a>
	</div>
</body>

</html>