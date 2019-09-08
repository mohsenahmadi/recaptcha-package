# recaptcha-package

the Public repo of the reCaptcha project.

## Installation
Require the package:

```sh
$ composer require dakyaco/recaptcha-package
```

Add these lines to ``config/services.php``

```sh
'recaptcha' => [
    'secret' => env('RECAPTCHA_SECRET'),
]
```

Now go to ``.env`` file and set your credentials

```sh
RECAPTCHA_SECRET=your-secret-key
```
## How to use
Go to ``app/Http/Controllers/LoginController.php`` and add following code

(you can handle it whatever you want. It's just an option)

```sh
use Dakyaco\Recaptcha\Facade\Recaptcha;

use AuthenticatesUsers {
    validateLogin as validateCredentials;
}

// ....

protected function validateLogin(Request $request)
{
    $result = Recaptcha::verify($request);
    if($result['valid']) {
        $this->validateCredentials($request);
    } else {
        throw ValidationException::withMessages([
            'recaptcha' => 'کپچا صحیح نمی باشد',
        ]);
    }
}
```