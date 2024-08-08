<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booster;
use Illuminate\Support\Facades\Auth;

class BoosterController extends Controller
{
    public function index()
    {
        $boosters = Booster::all();
        return view('boosters.index', compact('boosters'));
    }

    public function purchase(Request $request)
    {
        $user = Auth::user();
        $booster = Booster::find($request->booster_id);

        if ($user->balance >= $booster->price) {
            $user->balance -= $booster->price;
            $user->boosters()->attach($booster->id);
            $user->save();
            return redirect()->route('boosters.index')->with('success', 'Booster purchased successfully.');
        }

        return redirect()->route('boosters.index')->with('error', 'Insufficient balance.');
    }

    public function verify(Request $request)
    {
        $user = Auth::user();
        $booster = $user->boosters()->where('boosters.id', $request->booster_id)->first();

        if ($booster) {
            return response()->json(['status' => 'verified', 'booster' => $booster]);
        }

        return response()->json(['status' => 'not verified']);
    }
}