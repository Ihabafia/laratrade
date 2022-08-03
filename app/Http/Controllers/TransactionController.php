<?php

namespace App\Http\Controllers;

use App\Events\TransactionProcessed;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Portfolio;
use App\Models\Asset;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::forThisPortfolio()
            ->orderByDesc('date')
            ->get();

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $assets = Asset::selectArrayWithOutCash();

        return view('transactions.create', compact('assets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $portfolio = Portfolio::find(session('portfolio')['id']);
        $asset = Asset::find($request->ticker_id);
        $cashAsset = $portfolio->cash()->where('currency', $asset->currency->value)->first();

        $transaction = $portfolio->transactions()->create([
            'user_id' => auth()->id(),
            'asset_id' => $asset->id,
            'ticker' => $asset->ticker,
            'currency' => $asset->currency->value,
            'quantity' => $request->quantity,
            'price' => $request->action == 'Buy' ? $request->price : -$request->price,
            'action' => $request->action,
            'date' => $request->date ?? now(),
        ]);

        $transaction = $portfolio->transactions()->create([
            'user_id' => auth()->id(),
            'asset_id' => $cashAsset->id,
            'ticker' => $cashAsset->ticker,
            'currency' => $cashAsset->currency->value,
            'quantity' => $request->quantity,
            'price' => $request->action == 'Buy' ? -$request->price : $request->price,
            'action' => $request->action,
            'date' => $request->date ?? now(),
        ]);

        event(new TransactionProcessed($transaction));

        updateSession();

        return to_route('transactions.index')
            ->withSuccess(__('custom-messages.model-completed', ['model' => 'transaction']))
            ->withNew($transaction->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
