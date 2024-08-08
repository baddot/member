<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function userTransactions(User $user)
    {
        $transactions = $user->transactions;
        return view('admin.users.transactions', compact('user', 'transactions'));
    }
}
