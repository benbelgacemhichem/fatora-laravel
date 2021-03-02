<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://fatora.io/wp-content/themes/fatora/assets/images/cta/Hero4.png" width="400"></a></p>

## Fatora Laravel Package

## Installation & Usage

### Installation and Configuration

1- Install the current version of the `groupedesign/fatora` package via composer:
```
composer require groupedesign/fatora
``` 
or require in *composer.json*:
```json
{
    "require": {
        "groupedesign/fatora": "dev-master"
    }
}
```
then run `composer update` in your terminal to pull it in.

The package's service provider will automatically register its service provider.

2- Publish the configuration file:
```
php artisan vendor:publish --provider="Groupedesign\Fatora\FatoraServiceProvider"
```

3- After you publish the configuration file as suggested above, you need add your api key to your application's `.env` file:
  
```ini
FATORA_API_KEY=your_key_here
```

4- Add check transaction middleware in `kernal.php`
```
'checkTransactionStatus' => \Groupedesign\Fatora\Http\Middleware\CheckTransactionStatus::class
```

### Usage Example

1- Create new Controller
```ini
php artisan make:controller PaymentController
```
copy this code inside your controller

```php
<?php

namespace App\Http\Controllers;

use Groupedesign\Fatora\Checkout;
use Illuminate\Http\Request;
use stdClass;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index() {
        return view("payment.checkout");
    }

    public function checkout(Request $request)
    {
        $order = new stdClass();

        $order->orderNo              =  Str::random(15);
        $order->amount               =  $request->amount;
        $order->currencyCode         =  $request->currencyCode;
        $order->customerEmail        =  $request->customerEmail;
        $order->customerName         =  $request->customerName;
        $order->customerPhone        =  $request->customerPhone;
        $order->customerCountry      =  $request->customerCountry;
        $order->lang                 =  $request->lang;
        $order->note                 =  $request->note;
        return Checkout::checkout($order);
    }

    public function getSuccessPage($orderId = 0, $chkStatus = 0)
    {
        return view("payment.success", compact('orderId', 'chkStatus'));
    }

    public function getErrorPage($error_msg)
    {
        return view("payment.error", compact('error_msg'));
    }
}
```

2- create new blade file `checkout.blade.php` inside `recources/views/payment` and copy this code inside

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fatora Payment Gateway</title>
</head>
<body>
    
    <form action="{{ route('payment.checkout') }}" method="POST">
        @csrf
        <input type="hidden"  name="amount" value="0">
        <input type="hidden"  name="currencyCode" value="QAR"> 
        <input type="hidden"  name="customerEmail" value="testPament@testPayment.com">
        <input type="hidden"  name="customerName" value="gust">
        <input type="hidden"  name="customerPhone" value="+9639449871">
        <input type="hidden"  name="customerCountry" value="QATAR">
        <input type="hidden"  name="lang" value="en">
        <input type="hidden"  name="status" value="pending">
        <input type="hidden"  name="note" value="Demo of Payment">
        <button class="btn btn-pay" name="submit" type="submit"><i class="fa fa-money"></i> Checkout </button>
    </form>
    
</body>
</html>
```

3- in `routes/web.php` copy this code 

```php
Route::get('/', [PaymentController::class,'index']);

Route::post('/checkout', [PaymentController::class,'checkout'])->name('payment.checkout');

Route::group(['middleware' => ['checkTransactionStatus']], function()
{
    Route::get('/payment/success/{orderId?}/{chkStatus?}', [PaymentController::class,'getSuccessPage'])->name('payment.success');
    
});

Route::get('/payment/error/{error_msg}', [PaymentController::class,'getErrorPage'])->name('payment.error');
```

4- Setup Success URL & Failure URL

Login to your fatora account [login](https://app.fatora.io/login)
choose `Integration` select `Settings`

Success URL `http://localhost:8000/payment/success`

Failure URL `http://localhost:8000/payment/error`

For production mode change `http://localhost:8000` with your `domain`

### Enjoy