<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Asset;
use App\Models\Client;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $account = Account::where('id', session('portfolio')['id'])->first();
        $assetsCount = Asset::count();
        /*$customersCount = Customer::count();
        $amountsDeposited = (float) Transaction::amountsDeposited() / 100;
        $amountsCollected = (float) Transaction::amountsCollected() / 100;
        $transactionsCount = Transaction::uptoDateCount();
        $latestTransactions = Transaction::latestTransactions();*/

        return view('dashboard.index', compact('account', 'assetsCount'));
    }

    public function redirect($id)
    {
        $user = auth()->user();
        $portfolio = Account::findOrFail($id);

        $portfolios = $user->accounts;
        session()->put('portfolio', $portfolio->toArray());
        session()->put('portfolios', $portfolios->pluck('id', 'name'));

        $log = activity($user->id)
            ->causedBy($user)
            ->performedOn($user)
            ->event('switch-portfolio')
            ->log(__('custom-messages.audit-action__model__event__', ['model' => 'portfolio', 'event' => 'been switched']));

        return to_route('dashboard.index');
    }
}
