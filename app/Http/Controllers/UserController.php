<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('vip');
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
        $client = PayPalClient::client();
        $response = $client->execute(new OrdersGetRequest($request->input('orderId')));
        if ($response->statusCode === 200 && $response->result->status == "COMPLETED")
        {
            $paidUntil = null;
            switch($response->result->purchase_units[0]->amount->value)
            {
                case env('MONTHLY_PRICE'):
                    $paidUntil = Carbon::now()->addMonth();
                    break;
                case env('LIFETIME_PRICE'):
                default:
            }
            $user = User::create([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'paypal_order_id' => $request->input('orderId'),
                'paid_until' => $paidUntil,
            ]);
            Auth::loginUsingId($user->id, true);
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
