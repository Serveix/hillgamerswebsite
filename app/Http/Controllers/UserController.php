<?php

namespace App\Http\Controllers;

use App\Http\Helpers\PayPal\PayPalClient;
use App\User;
use App\VipUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;

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
        return Auth::user()->isVip() ? redirect('/') : view('vip');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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
