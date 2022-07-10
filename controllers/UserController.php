<?php

class UserController
{

	public static function responseJson($params = [])
	{
		if ($_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
			exit;
		} else {
			header('Content-type: application/json');
			echo json_encode($params);
			exit;
		}
	}

	public function actionRegister()
	{

		$login = $password = $confirm_password = $email = $name = '';

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$login = $_POST['login'];
			$salt = uniqid(mt_rand(), true);
			$password = $_POST['password'];
			$confirm_password = $_POST['confirm_password'];
			$email = $_POST['email'];
			$name = trim(htmlspecialchars($_POST['name']));
			$db = new Json();

			$errors = false;

			if (!User::checkLogin($login)) {
				$errors[] = 'Логин не должен быть короче 6 символов';
			} else {
				$errors[] = '';
			}

			if (!User::checkPassword($password)) {
				$errors[] = 'Пароль не должен быть короче 6 символов и должен состоять из цифр и букв';
			} else {
				$errors[] = '';
			}

			if (!User::checkConfirmPassword($confirm_password, $password)) {
				$errors[] = 'Пароли не совпадают';
			} else {
				$errors[] = '';
			}

			if (!User::checkEmail($email)) {
				$errors[] = 'Неправильный email';
			} else {
				$errors[] = '';
			}

			if (!User::checkName($name)) {
				$errors[] = 'Имя должно состоять из 2 букв';
			} else {
				$errors[] = '';
			}

			if (User::checkLoginExists($login)) {
				$errors[] = 'Пользователь с таким логином уже существует';
			} else {
				$errors[] = '';
			}

			if (User::checkEmailExists($email)) {
				$errors[] = 'Пользователь с таким email уже существует';
			} else {
				$errors[] = '';
			}

			if ($login && $password && $confirm_password && $email && $name && !$errors[0] && !$errors[1] && !$errors[2] && !$errors[3] && !$errors[4] && !$errors[5] && !$errors[6]) {

				// Запись нового пользователя в БД
				$db->createUser($login, $password, $email, $name);

				self::responseJson([
					'success' => true,
					'errors' => $errors,
					'message' => 'Вы зарегистрированы, теперь можете пройти авторизацию'
				]);
			} else {

				self::responseJson([
					'success' => false,
					'errors' => $errors,
					'message' => 'Пожалуйста, исправьте все ошибки и попробуйте ещё раз',
				]);
			}
		}

		if (isset($_SESSION['user'])) {
			$userId = User::checkLogged();
			$classJson = new Json();
			$user = $classJson->readUser($userId);

			require_once(ROOT . '/views/cabinet/index.php');
		} else {
			require_once(ROOT . '/views/user/register.php');
		}

		return true;
	}

	public function actionLogin()
	{

		$login = $password = '';

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$login = $_POST['login'];
			$password = $_POST['password'];

			$errors = false;

			// Валидация логина
			if (!User::checkLogin($login)) {
				$errors[] = 'Логин не должен быть короче 6 символов';
			} else {
				$errors[] = '';
			}

			// Валидация пароля
			if (!User::checkPassword($password)) {
				$errors[] = 'Пароль не должен быть короче 6 символов и должен состоять из цифр и букв';
			} else {
				$errors[] = '';
			}

			// Проверяем, существует ли пользователь
			$userId = User::checkUserData($login, $password);

			if ($userId === false) {

				// Если данные неправильные, показываем ошибку
				self::responseJson([
					'success' => false,
					'errors' => $errors,
					'message' => 'Неправильные данные для входа на сайт',
				]);
			} else {

				// Если данные правильные, запоминаем пользователя (сессия)
				User::auth($userId);

				// Перенаправляем пользователя на страницу закрытую часть сайта - кабинет
				self::responseJson([
					'success' => true,
					'errors' => $errors,
					'url' => '/cabinet/',
				]);
			}
		}

		if (isset($_SESSION['user'])) {
			$userId = User::checkLogged();
			$classJson = new Json();
			$user = $classJson->readUser($userId);

			require_once(ROOT . '/views/cabinet/index.php');
		} else {
			require_once(ROOT . '/views/user/login.php');
		}

		return true;
	}

	public function actionLogout()
	{
		session_start();

		unset($_SESSION['user']);

		header('Location: /user/login');
	}
}
