<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::latest()->paginate(10);
        return view('account.index', compact('accounts'));
    }

    public function create()
    {
        return view('account.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:accounts,name',
            'type' => 'required|in:sarrafi,cash',
            'balance' => 'required|numeric|min:0',
        ]);

        Account::create($request->all());

        return redirect()->route('account.index')->with('success', 'Account created successfully.');
    }

    public function edit(Account $account)
    {
        return view('account.edit', compact('account'));
    }

    public function update(Request $request, Account $account)
    {
        $request->validate([
            'name' => 'required|unique:accounts,name,' . $account->id,
            'type' => 'required|in:sarrafi,cash',
            'balance' => 'required|numeric|min:0',
        ]);

        $account->update($request->all());

        return redirect()->route('account.index')->with('success', 'Account updated successfully.');
    }

    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('account.index')->with('success', 'Account deleted successfully.');
    }
}
