<?php

namespace App\Services;

use Carbon\Carbon;
use Firebase\JWT\JWT as JWTBase;

class JWT
{
	protected $key;

	private $token;

	private $tokenData;

	private $tokenInfo;

	public function __construct()
	{
		$this->key = config('jwt.secret');
	}

	public function encode($data)
	{
		return JWTBase::encode((array) $data, $this->key);
	}

	public function decode($token)
	{
		try {
			return JWTBASE::decode($token, $this->key, ['HS256']);
		} catch (\Exception $e) {
			return false;
		}
	}

	public function generate($data)
	{
		if (is_array($data)) {
			$data = (object) $data;
		}

		$now = Carbon::now()->timestamp;
		$rfa = Carbon::now()->addDay(1000)->timestamp;
		$exp = Carbon::now()->addDay(1000)->timestamp;
		$data = clone $data;
		$data->iat = $now;
		$data->exp = $exp;
		$data->rfa = $rfa;

		return (object) [
			'token' => 'Bearer '.$this->encode((array) $data),
			'expired_at' => $exp,
			'refresh_at' => $rfa,
		];
	}

	public function refresh()
	{
		return $this->generate($this->tokenData);
	}

	public function isNeedToRefresh()
	{
		$now = Carbon::now()->timestamp;
		$rfa = $this->tokenInfo->rfa;

		return $rfa < $now;
	}

	public function parse($token)
	{
		$this->token = substr($token, 7);
		$this->tokenInfo = $this->decode($this->token);
		if (!$this->tokenInfo) return null;

		$tokenData = clone $this->tokenInfo;
		unset($tokenData->iat);
		unset($tokenData->exp);
		unset($tokenData->rfa);
		$this->tokenData = $tokenData;

		return $this->tokenData;
	}

	public function token()
	{
		return $this->token;
	}

	public function tokenData()
	{
		return $this->tokenData;
	}
}
