<?php
namespace Dakyaco\Recaptcha;

use Illuminate\Support\ServiceProvider;

class RecaptchaServiceProvider extends ServiceProvider {

	public function register() {
		$this->app->instance('Recaptcha', new Recaptcha());
	}

	public function boot() {
		//
	}
}