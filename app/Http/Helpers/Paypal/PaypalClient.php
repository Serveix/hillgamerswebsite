<?php
namespace App\Http\Helpers\PayPal;

use Illuminate\Support\Facades\Log;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
class PayPalClient
{
    /**
     * Returns PayPal HTTP client instance with environment which has access
     * credentials context. This can be used invoke PayPal API's provided the
     * credentials have the access to do so.
     */
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    public static function environment()
    {
        $clientId = env('PAYPAL_CLIENT_ID');
        $clientSecret = env('PAYPAL_CLIENT_SECRET');
        if (env('PAYPAL_SANDBOX_MODE') == "TRUE")
        {
            Log::info("Paypal Server SandBox Environment");
            return new SandboxEnvironment($clientId, $clientSecret);
        }

        Log::info("Paypal Production Environment");
        return new ProductionEnvironment($clientId, $clientSecret);
    }
}