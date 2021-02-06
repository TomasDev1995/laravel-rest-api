<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class EventController extends Controller
{
    //POST /event {"type":"deposit", "destination":"100", "amount":10}
    //201 {"destination": {"id":"100", "balance":10}}

    public function store(Request $request)
    {
        //Event::create(...);
        if ($request->input('type') === 'deposit') {
            return $this->deposit(
                $request->input('destination'),
                $request->input('amount')
            );
        }elseif ($request->input('type') === 'withdraw') {
            return $this->withdraw(
                $request->input('origin'),
                $request->input('amount')
            );
        }
    }

    private function deposit($destination, $amount)
    {
        $account = Account::firstOrCreate([
            'id' => $destination
        ]);

        $account->balance += $amount;
        $account->save();

        return response()->json([
            'destination' => [
                'id' => $account->id,
                'balance' => $account->balance
            ]
        ], 201);
    }

    public function withdraw($origin,$amount)
    {
        $account = Account::firstOrCreate([
            'id' => $origin
        ]);

        $account->balance -= $amount;
        $account->save();

        return response()->json([
            'origin' => [ 
                'id' => $account->id,
                'balance' => $account->balance
            ]
            ], 201);
    }
}
