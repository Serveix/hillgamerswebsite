<?php

namespace App\Http\Controllers;

use App\Http\Helpers\PayPal\PayPalClient;
use App\User;
use App\VipUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Cashier\Exceptions\PaymentActionRequired;
use Laravel\Cashier\Exceptions\PaymentFailure;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use PhpParser\Builder\Property;

class UserController extends Controller
{
    public function index()
    {
        return view('profile')->with('user', Auth::user());
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        return $user->isVip() ? redirect('/') : view('vip')->with('intent', $user->createSetupIntent());
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paymentMethodId' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un problema, intenta recargar la página'
            ], 422);
        }

        /** @var User $user */
        $user = Auth::user();

        $paymentMethodId = $request->paymentMethodId;


        try {
            $user->newSubscription(env('STRIPE_MAIN_SUB'), env('STRIPE_MAIN_SUB_PLAN_ID'))
                ->create($paymentMethodId, [
                    'name' => $user->realname,
                    'email' => $user->email
                ]);

            //todo change in database current rank
            
        } catch (PaymentActionRequired $e) {
            //todo: implement correctly
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        } catch (PaymentFailure $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }


        return [
            'success' => true,
            'message' => 'Se ha realizado la suscripción con éxito. ¡Bienvenido a VIP!'
        ];
    }


    /**
     * Update the specified resource in storage.
     *
     * @deprecated Changed to Stripe payments
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateWithPaypal(Request $request)
    {
        Log::info('User sent paypal check request');
        $client = PayPalClient::client();
        $response = $client->execute(new OrdersGetRequest($request->input('orderId')));
        if ($response->statusCode === 200 && $response->result->status == "COMPLETED")
        {

            $paidUntil = Carbon::now()->addMonth();
            $user = Auth::user();
            $pexInher = $user->pexInheritance();
            $pexInher->parent = User::VIP_RANK;
            $pexInher->save();

            $vipUser = VipUser::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'permissions_inheritance_id' => $pexInher->id,
                ],
                [
                'is_vip' => true,
                'expiration_date' => $paidUntil]);

            Log::info("User $user->realname (ID: $user->id, Pex name: $pexInher->child) bought VIP");

            return response()->json([
                'success' => true,
                'message' => $response->result->status,
            ], 200);
        }
        return response()->json([
            'success' => false,
            'status' => $response->result->status,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
