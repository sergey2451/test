<?php

class User
{
	// Проверяет login: минимум 6 символов
	public static function checkLogin($login)
	{
		if (strlen(trim($login)) >= 6) {
			return true;
		}
		return false;
	}

	// Проверяет password: минимум 6 символов, обязательно должен состоять из цифр и букв
	public static function checkPassword($password)
	{
		if ((strlen(trim($password)) >= 6) && (preg_match('~[A-zА-я]+~', $password)) && (preg_match('~[0-9]+~', $password)) && (!preg_match('~[!@#$%^&*]+~', $password))) {
			return true;
		}
		return false;
	}

	// Проверяет совпадение паролей
	public static function checkConfirmPassword($confirm_password, $password)
	{
		if (!empty($confirm_password) && ($confirm_password === $password)) {
			return true;
		}
		return false;
	}

	// Проверяет email
	public static function checkEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		return false;
	}

	// Проверяет name: 2 символа, только буквы
	public static function checkName($name)
	{
		if (preg_match('/^([а-яА-ЯЁёa-zA-Z]{2,2})$/u', $name)) {
			return true;
		}
		return false;
	}

	// Проверяет существование вводимого логина в БД
	public static function checkLoginExists($login)
	{
		if (file_exists('db/data.json')) {
			$jsonData = file_get_contents('db/data.json');
			$data = json_decode($jsonData, true);
		}

		if (!empty($data)) {
			foreach ($data as $item) {
				if ($item['login'] === $login) {
					return true;
				}
			}
		}

		return false;
	}

	// Проверяет существование вводимого email в БД
	public static function checkEmailExists($email)
	{
		if (file_exists('db/data.json')) {
			$jsonData = file_get_contents('db/data.json');
			$data = json_decode($jsonData, true);
		}

		if (!empty($data)) {
			foreach ($data as $item) {
				if ($item['email'] === $email) {
					return true;
				}
			}
		}

		return false;
	}

	// Проверяет существование пользователя с заданными логином и паролем в БД
	public static function checkUserData($login, $password)
	{
		if (file_exists('db/data.json')) {
			$jsonData = file_get_contents('db/data.json');
			$data = json_decode($jsonData, true);
		}

		if (!empty($data)) {
			foreach ($data as $key => $item) {

				if ($item['login'] === $login) {
					$salt = $item['salt'];
					$password = md5($salt . $password);

					if ($item['password'] === $password)
						return $key;
				}
			}
		}

		return false;
	}

	// Запоминаем пользователя
	public static function auth($userId)
	{
		$_SESSION['user'] = $userId;
	}

	public static function checkLogged()
	{
		// Если сессия есть, вернём имя пользователя
		if (isset($_SESSION['user'])) {
			return $_SESSION['user'];
		}

		header('Location: /user/login');
	}
}
