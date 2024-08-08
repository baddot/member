@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Balance</th>
                <th>Referral Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->balance }}</td>
                    <td>{{ $user->referral_code }}</td>
                    <td>
                        <a href="{{ route('admin.users.transactions', $user->id) }}" class="btn btn-primary">View Transactions</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
