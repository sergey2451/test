<?php

class CabinetController
{
	public function actionIndex()
	{
		// Получаем идентификатор пользователя из сессии
		$userId = User::checkLogged();

		// Получаем информацию о пользователе из БД
		$classJson = new Json();
		$user = $classJson->readUser($userId);

		require_once(ROOT . '/views/cabinet/index.php');

		return true;
	}
}
