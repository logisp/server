<?php

namespace App\Services;

use Carbon\Carbon;
use Firebase\JWT\JWT as JWTBase;

class JWT
{
	protected $key;

	protected $alg = 'HS256';

	protected $payload;

	public function __construct()
	{
		$this->key = config('jwt.secret');
	}

	public function encode(string $sub, string $aud)
	{
		return 'Bearer ' . JWTBase::encode([
			'sub' => $sub,
			'aud' => $aud,
			'iat' => Carbon::now()->timestamp,
			'exp' => Carbon::now()->addDay(365)->timestamp,
			'rfa' => Carbon::now()->addDay(365)->timestamp
		], $this->key);
	}

	public function decode($token)
	{
		try {
			$payload = JWTBASE::decode(substr($token, 7), $this->key, [$this->alg]);
			$this->payload = $payload;

			return $payload;
		} catch (\Exception $e) {
			return null;
		}
	}

	public function payload()
	{
		return $this->payload;
	}

	public function sub()
	{
		return $this->payload->sub;		
	}

	public function aud()
	{
		return $this->payload->aud;
	}

	public function isNeedToRefresh()
	{
		$now = Carbon::now()->timestamp;
		$exp = $this->payload->exp;

		return $exp < $now;
	}

	public function refresh()
	{
		return $this->encode($this->sub(), $this->aud());
	}
}
