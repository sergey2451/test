<?php

class Json
{
	private $jsonFile = 'db/data.json';

	// Запись нового пользователя в файл
	public function createUser($login, $password, $email, $name)
	{
		if (file_exists($this->jsonFile)) {
			$jsonData = file_get_contents($this->jsonFile);
			$data = json_decode($jsonData, true);
		}

		if ($login && $password && $email && $name) {

			// Функция, которая генерирует соль
			function generateSalt()
			{
				$salt = '';
				$saltLength = 8; // длина соли

				for ($i = 0; $i < $saltLength; $i++) {
					$salt .= chr(mt_rand(33, 126)); // символ из ASCII-table
				}

				return $salt;
			}

			$salt = generateSalt(); // соль
			$password = md5($salt . $password); // соленый пароль

			$data[] = [
				'login' => $login,
				'salt' => $salt,
				'password' => $password,
				'email' => $email,
				'name' => $name,
			];

			file_put_contents($this->jsonFile, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT));
		}
	}

	// Чтение пользователя по ключу
	public function readUser($key)
	{
		if (file_exists($this->jsonFile)) {
			$jsonData = file_get_contents($this->jsonFile);
			$data = json_decode($jsonData, true);
		}

		return $data[$key];
	}

	// Модификация пользователя по ключу
	public function updateUser($key, $login, $password, $email, $name)
	{
		if (file_exists($this->jsonFile)) {
			$jsonData = file_get_contents($this->jsonFile);
			$data = json_decode($jsonData, true);
		}

		$data[$key] = [
			'login' => $login,
			'password' => $password,
			'email' => $email,
			'name' => $name,
		];

		file_put_contents($this->jsonFile, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT));
	}

	// Удаление пользователя по ключу
	public function deleteUser($key)
	{
		if (file_exists($this->jsonFile)) {
			$jsonData = file_get_contents($this->jsonFile);
			$data = json_decode($jsonData, true);
		}

		unset($data[$key]);

		file_put_contents($this->jsonFile, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT));
	}
}
