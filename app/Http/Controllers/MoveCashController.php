<?php

namespace App\Http\Controllers;

use App\Actions\ConvertCurrency;
use App\Enums\Enums;
use App\Events\TransactionProcessed;
use App\Events\TransactionsProcessed;
use App\Models\Portfolio;
use App\Models\Asset;
use App\Models\Transaction;
use Illuminate\Http\Request;

class MoveCashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = Portfolio::selectArray();

        return view('move-cash.create', compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = match ($request->action) {
            'Deposit', 'Withdraw' => $this->action($request->all()),
            'CAD2USD' => $this->convert($request->all(), 'CAD2USD'),
            'USD2CAD' => $this->convert($request->all(), 'USD2CAD'),

            default => back()
                ->with('error', __('messages.deposit-convert-error')),
        };

        if($request) {
            return to_route('transactions.index')
                ->withSuccess(__('custom-messages.model-completed', ['model' => 'moving cash']));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    private function action(array $all)
    {
        $portfolio = Portfolio::find($all['portfolio_id']);
        $cashAsset = $portfolio->cash()->where('currency', 'CAD')->first();

        $transaction = $portfolio->transactions()->create([
            'user_id' => auth()->id(),
            'asset_id' => $cashAsset->id,
            'ticker' => 'CASH',
            'currency' => 'CAD',
            'quantity' => 1,
            'price' => $all['action'] == 'Deposit' ? $all['amount'] : -$all['amount'],
            'action' => $all['action'],
            'date' => $all['date'] ?? now(),
        ]);

        event(new TransactionProcessed($transaction));

        updateSession();

        return true;
    }

    private function convert(array $all, string $action)
    {
        $service = new ConvertCurrency($all, $action);
        $data = $service->converted();
        $portfolio = Portfolio::find($all['portfolio_id']);

        $transactions = $portfolio->transactions()->createMany($data);

        event(new TransactionsProcessed($transactions));

        updateSession();

        return true;
    }
}
