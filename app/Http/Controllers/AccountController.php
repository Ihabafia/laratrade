<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = Account::all();

        return view('accounts.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountRequest $request)
    {
        $account = Account::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
            'cash' => [
                'CAD' => 0.00,
                'USD' => 0.00,
            ],
        ]);

        $this->updateSession();

        return to_route('accounts.index')
            ->withSuccess(__('custom-messages.model-created', ['model' => 'portfolio']))
            ->withNew($account->id);
    }

    public function get(Request $request)
    {
        $account = Account::find($request->id);

        return response([
            'cash' => $account->cash,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccountRequest  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        $account->update($request->validated());

        $this->updateSession();

        return to_route('accounts.index')
            ->withSuccess(__('custom-messages.model-updated', ['model' => 'portfolio']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }

    private function updateSession()
    {
        $portfolios = auth()->user()->accounts;
        session()->put('portfolio', $portfolios->first()->toArray());
        session()->put('portfolios', $portfolios->pluck('id', 'name'));
    }
}
