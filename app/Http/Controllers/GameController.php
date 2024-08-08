<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function start(Request $request)
    {
        $user = Auth::user();

        if ($user->balance >= 20) {
            $user->balance -= 20;
            $user->save();

            return response()->json(['status' => 'game started']);
        }

        return response()->json(['status' => 'insufficient balance']);
    }

    public function finish(Request $request)
    {
        $user = Auth::user();
        $rank = $request->rank;

        switch ($rank) {
            case 1:
                $user->balance += 10;
                break;
            case 2:
                $user->balance += 6;
                break;
            case 3:
                $user->balance += 4;
                break;
            case 4:
                $user->boosters()->attach(Booster::where('name', '3 sec Armour Invincible')->first()->id);
                break;
            case 5:
                $user->boosters()->attach(Booster::where('name', '3 sec Booster (Nitrogen)')->first()->id);
                break;
            case 6:
                $user->boosters()->attach(Booster::where('name', '2 sec Booster (Nitrogen)')->first()->id);
                break;
            case 7:
                $user->boosters()->attach(Booster::where('name', '1 sec Booster (Nitrogen)')->first()->id);
                break;
            case 8:
                $user->boosters()->attach(Booster::where('name', '20% Horse Power')->first()->id);
                break;
        }

        return response()->json(['status' => 'game finished']);
    }
}
