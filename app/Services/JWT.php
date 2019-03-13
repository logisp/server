<?php

namespace App\Services;

use Carbon\Carbon;
use Firebase\JWT\JWT as JWTBase;

class JWT
{
	protected $key;

	protected $data;

	public function __construct()
	{
		$this->key = config('jwt.secret');
	}

	public function decode($token)
	{
		try {
			$data = JWTBASE::decode(substr($token, 7), $this->key, ['HS256']);
			$this->data = $data;

			return $data;
		} catch (\Exception $e) {
			return null;
		}
	}

	public function encode($data)
	{
		$data = (object) $data;
		$data = clone $data;
		$data->iat = Carbon::now()->timestamp;
		$data->exp = Carbon::now()->addDay(1000)->timestamp;
		$data->rfa = Carbon::now()->addDay(1000)->timestamp;

		return 'Bearer ' . JWTBase::encode((array) $data, $this->key);
	}

	public function isNeedToRefresh()
	{
		$now = Carbon::now()->timestamp;

		return $this->data->exp < $now;
	}

	public function refresh()
	{
		return $this->encode($this->data);
	}

	public function data()
	{
		return $this->data;
	}
}
