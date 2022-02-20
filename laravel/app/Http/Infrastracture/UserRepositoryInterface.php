<?php

namespace App\Http\Infrastracture;

interface UserRepositoryInterface
{
	/**
	 * 新規ユーザー登録
	 *
	 * @param string $name
	 * @param string $email
	 * @param string $password
	 * @return void
	 */
	public function regist(string $name, string $email, string $password);
}
