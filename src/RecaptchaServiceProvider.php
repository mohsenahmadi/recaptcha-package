<?php
namespace Dakyaco\Recaptcha;

use Illuminate\Support\ServiceProvider;

class RecaptchaServiceProvider extends ServiceProvider {

	public function register() {
		$this->app->singleton('Recaptcha', function () {
			$recaptcha = new Recaptcha();

			return $recaptcha;
		});
	}

	public function boot() {
		//
	}
}