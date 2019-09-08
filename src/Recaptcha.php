<?php

namespace Dakyaco\Recaptcha;

use Illuminate\Http\Request;

class Recaptcha {

	protected $secretKey;
	protected $url;

	public function __construct() {
		$this->secretKey = config('services.recaptcha.secret');
		$this->url = 'https://captcha.dakyaco.com/api/v1/validate';
	}


	public function verify(Request $request) {
		$input = $request->get('p-captcha-input');
		$session = $request->get('p-captcha-session');
		if(! is_null($input)) {
			$data = [
				'p-captcha-input' => $input,
				'p-captcha-session' => $session,
				'sitekey' => $this->secretKey
			];

			$result = $this->call('POST', $this->url, $data);
			$result = json_decode($result, true);
			return $result;
		}
	}

	public function call($method, $url, $data = false) {
		$curl = curl_init();

		switch ($method)
		{
			case "POST":
				curl_setopt($curl, CURLOPT_POST, 1);

				if ($data)
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				break;
			case "PUT":
				curl_setopt($curl, CURLOPT_PUT, 1);
				break;
			default:
				if ($data)
					$url = sprintf("%s?%s", $url, http_build_query($data));
		}

		// Optional Authentication:
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_USERPWD, "username:password");

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($curl);

		curl_close($curl);

		return $result;
	}
}