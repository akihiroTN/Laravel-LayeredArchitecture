<?php

namespace App\Models\Repository\User;

use App\Http\Infrastracture\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
	/**
	 * 新規ユーザー登録
	 *
	 * @param string $name
	 * @param string $email
	 * @param string $password
	 * @return void
	 */
	public function regist(string $name, string $email, string $password)
	{
		User::create(
			[
				'name' => $name,
				'email' => $email,
				'password' => $password
			]
		);
	}
}
