<?php

namespace App\Http\Controllers;

use App\Actions\Commands\UpdateVars;
use App\Actions\Processors\Banking\RbcBankGenerateFile;
use App\Actions\Processors\Banking\UploadRbcBankFiles;
use App\Actions\Processors\PaymentProcessor;
use App\Enums\TransactionEnum;
use App\Events\TransactionsProcessed;
use App\Models\Communication;
use App\Models\Transaction;
use App\Notifications\ActivateUserNotification;
use App\Services\NotificationsVariables;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Log;
use Str;

class CronController extends Controller
{
    public function __invoke(Request $request, $command)
    {
        if(method_exists($this, $method = Str::camel($command))) {
            return $this->{$method}();
        }
    }

    public function index()
    {
        return view('crons.index');
    }

    public function testEmail()
    {
/*        $notification = Communication::query()
            ->whereSlug('welcome-email')
            ->get();

        $first_name = 'Ihab';*/

        $lead = Lead::find(1);

        $lead->notify(new ActivateUserNotification);
    }

    public function updateVars()
    {
        $action = (new UpdateVars)();

        return back()->with('success', __('custom-messages.model-completed', ['model' => "cron: 'update-vars'"]));
    }

    public function updateBalances()
    {
        $transactions = Transaction::all();

        event(new TransactionsProcessed($transactions));
    }
}
