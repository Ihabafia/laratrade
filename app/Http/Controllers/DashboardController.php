<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Asset;
use App\Models\Client;
use App\Models\Customer;
use App\Models\Transaction;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $portfolio = Portfolio::where('id', session('portfolio')['id'])->first();
        $assetsCount = Asset::count();

        /*$customersCount = Customer::count();
        $amountsDeposited = (float) Transaction::amountsDeposited() / 100;
        $amountsCollected = (float) Transaction::amountsCollected() / 100;
        $transactionsCount = Transaction::uptoDateCount();
        $latestTransactions = Transaction::latestTransactions();*/

        return view('dashboard.index', compact('portfolio', 'assetsCount'));
    }

    public function redirect(Request $request, $id)
    {
        $user = auth()->user();
        $portfolio = Portfolio::findOrFail($id);

        session()->put('portfolio', $portfolio->toArray());

        $log = activity($user->id)
            ->causedBy($user)
            ->performedOn($user)
            ->event('switch-portfolio')
            ->log(__('custom-messages.audit-action__model__event__', ['model' => 'portfolio', 'event' => 'been switched']));

        return to_route($request->redirect ?? 'dashboard.index');
    }
}
