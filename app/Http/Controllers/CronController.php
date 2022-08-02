<?php

namespace App\Http\Controllers;

use App\Actions\Commands\UpdateVars;
use App\Actions\Processors\Banking\RbcBankGenerateFile;
use App\Actions\Processors\Banking\UploadRbcBankFiles;
use App\Actions\Processors\PaymentProcessor;
use App\Enums\TransactionEnum;
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

    public function processPayments($try, Transaction $transaction = null, PaymentProcessor $paymentProcessor)
    {
        Log::info('=======================================');
        Log::info('|| '.Str::title($try).' try of payments');
        Log::info('=======================================');

        if($transaction) {
            $transactions = collect($transaction);
        }

        if($transactions->count() == 0) {
            $transactions = Transaction::getUnprocessedTransactions()->get();
        }

        $processed = $paymentProcessor($transactions, $try);

        if ($processed) {
            return back()->with('success', __('custom-messages.model-completed', ['model' => "cron: 'process-payments'"]));
        } else {
            return back()->with('success', __('custom-messages.model-unsuccessful', ['model' => "cron: 'process-payments"]));
        }
    }

    public function generateRbcFiles(RbcBankGenerateFile $bankFile, $type = null)
    {
        if (in_array($type, ['Debit', 'Credit'])) {
            $bankFile->generate($type);

            return back()->with('success', __('custom-messages.model-completed', ['model' => "cron: 'generate-rbc-files'"]));
        }

        return back()->with('error', __('custom-messages.model-unsuccessful', ['model' => "cron: 'generate-rbc-files'"]));

        echo $bankFile->generate('Debit');
        echo '<br>';
        echo $bankFile->generate('Credit');
    }

    public function uploadRbcFiles(UploadRbcBankFiles $process, TransactionEnum $type)
    {
        $result = $process->upload($type);

        Log::info('Upload Bank File Result', $result);

        return back()->with($result['success'], "The {$result['type']} file upload was {$result['result']}");
    }

    public function rbcTestUpload(UploadRbcBankFiles $process)
    {
        $result = $process->uploadTestFile();

        Log::info('Upload Test Bank File Result', $result);

        return back()->with($result['success'], "The {$result['type']} file upload was {$result['result']}");
    }

}
