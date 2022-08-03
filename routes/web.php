<?php

use App\Enums\RoleEnum;
use App\Http\Controllers\CronController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\Audits\AuditTrailController;
use App\Http\Controllers\Communications\CommunicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MoveCashController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth', 'first.time.login'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('cron/{command}', CronController::class);
});

Route::middleware(['auth', 'first.time.login', 'role:' . RoleEnum::Admin->value])->group(function () {
    Route::resource('users', UserController::class)->only(['index', 'create', 'edit']);
    Route::get('communications/{communication}/preview', [CommunicationController::class, 'preview'])->name('communication.preview');
    Route::resource('communications', CommunicationController::class)/*->except('show', 'edit', 'update', 'create', 'store')*/;
    Route::get('audits', AuditTrailController::class)->name('audits.index');
});
Route::middleware(['auth', 'first.time.login', 'role:'.RoleEnum::User->value])->group(function () {
    Route::get('/redirect/{id}', [DashboardController::class, 'redirect'])->name('redirect');
    Route::post('portfolio/get', [PortfolioController::class, 'get'])->name('portfolio.get');
    Route::resource('portfolios', PortfolioController::class);
    Route::post('assets/get', [AssetController::class, 'get'])->name('asset.get');
    Route::resource('assets', AssetController::class)->except('show');
    Route::resource('move-cash', MoveCashController::class);
    Route::resource('transactions', TransactionController::class);
});

/*Route::middleware(['auth', 'first.time.login', 'role:' . RoleEnum::Admin->value])->group(function () {
    Route::resource('clients', ClientController::class)->only(['index', 'create', 'edit']);
    Route::get('crons', [CronController::class, 'index'])->name('crons.index');
    Route::get('cron/payments/{try}/{transaction?}', [CronController::class, 'processPayments'])->name('process.payments');
    Route::get('cron/generate_rbc_bank/{type?}', [CronController::class, 'generateRbcFiles'])->name('generate.bank-files');
    Route::get('cron/upload_rbc_files/{type?}', [CronController::class, 'uploadRbcFiles'])->name('cron.upload-rbc-files');
    Route::get('cron/rbc-test-upload', [CronController::class, 'rbcTestUpload'])->name('cron.upload-rbc-test-files');
    Route::get('cron/{command}', CronController::class);
    Route::resource('files', BankFileController::class);
    Route::get('download/{file_name}/{name?}', [BankFileController::class, 'download'])->name('files.download');

    Route::get('master-communications/{type}/create', [CreateCommunicationController::class, 'create'])->name('master-communications.create');
    Route::post('master-communications/Email', CreateMasterCommunicationEmail::class)->name('master-communications.email.store');
    Route::post('master-communications/AdminEmail', CreateMasterCommunicationEmail::class)->name('master-communications.admin-email.store');
    Route::post('master-communications/SMS', CreateMasterCommunicationSms::class)->name('master-communications.sms.store');
    Route::post('master-communications/AdminSMS', CreateMasterCommunicationSms::class)->name('master-communications.admin-sms.store');
    Route::post('master-communications/PRC', CreateMasterCommunicationPrc::class)->name('master-communications.prc.store');

    Route::get('master-communications/{communication}/{type}/edit', [EditMasterCommunicationController::class, 'edit'])->name('master-communications.edit');
    Route::put('master-communications/{communication}/Email', UpdateMasterCommunicationEmail::class)->name('master-communications.email.update');
    Route::put('master-communications/{communication}/AdminEmail', UpdateMasterCommunicationEmail::class)->name('master-communications.admin-email.update');
    Route::put('master-communications/{communication}/SMS', UpdateMasterCommunicationSms::class)->name('master-communications.sms.update');
    Route::put('master-communications/{communication}/PRC', UpdateMasterCommunicationPrc::class)->name('master-communications.prc.update');
    Route::put('master-communications/{communication}/Email', UpdateMasterCommunicationEmail::class)->name('master-communications.email.update');
    Route::put('master-communications/{communication}/AdminEmail', UpdateMasterCommunicationEmail::class)->name('master-communications.admin-email.update');
    Route::put('master-communications/{communication}/SMS', UpdateMasterCommunicationSms::class)->name('master-communications.sms.update');
    Route::put('master-communications/{communication}/PRC', UpdateMasterCommunicationPrc::class)->name('master-communications.prc.update');
    Route::get('master-communications/{communication}/preview', [CommunicationController::class, 'preview'])->name('master-communication.preview');

    Route::resource('master-communications', MasterCommunicationController::class)->except('show', 'edit', 'update', 'create', 'store');
});
Route::middleware(['auth', 'verified', 'role:'.RoleEnum::Admin->value.'|'.RoleEnum::User->value])->group(function () {
    Route::resource('users', UserController::class)->only(['index', 'create', 'edit']);
    Route::get('audits', AuditTrailController::class)->name('audits.index');
});
Route::middleware(['auth', 'verified', 'role:'.RoleEnum::User->value])->group(function () {
    Route::resource('packages', PackageController::class)->except('edit', 'update');
    Route::resource('customers', CustomerController::class);
    Route::get('transactions/{transaction}/transactionDetails', [TransactionController::class, 'transactionDetail'])->name('transaction-detail.index');
    Route::get('packages/{package}/{customer}/edit', [PackageController::class, 'edit'])->name('packages.edit');
    Route::put('packages/{package}/{customer}', [PackageController::class, 'update'])->name('packages.update');
});
Route::middleware(['auth', 'first.time.login', 'role:' . RoleEnum::User->value])->group(function () {
    Route::resource('communications', CommunicationController::class)->except('show', 'edit', 'update', 'create', 'store');
    Route::get('communications/{type}/create', [CreateCommunicationController::class, 'create'])->name('communications.create');
    Route::post('communications/Email', CreateCommunicationEmail::class)->name('communications.email.store');
    Route::post('communications/AdminEmail', CreateCommunicationEmail::class)->name('communications.admin-email.store');
    Route::post('communications/SMS', CreateCommunicationSms::class)->name('communications.sms.store');
    Route::post('communications/AdminSMS', CreateCommunicationSms::class)->name('communications.admin-sms.store');
    Route::post('communications/PRC', CreateCommunicationPrc::class)->name('communications.prc.store');
    Route::get('communications/{communication}/{type}/edit', [EditCommunicationController::class, 'edit'])->name('communications.edit');
    Route::put('communications/{communication}/Email', UpdateCommunicationEmail::class)->name('communications.email.update');
    Route::put('communications/{communication}/AdminEmail', UpdateCommunicationEmail::class)->name('communications.admin-email.update');
    Route::put('communications/{communication}/SMS', UpdateCommunicationSms::class)->name('communications.sms.update');
    Route::put('communications/{communication}/PRC', UpdateCommunicationPrc::class)->name('communications.prc.update');
    Route::get('communications/{communication}/preview', [CommunicationController::class, 'preview'])->name('communication.preview');
    Route::post('packages/{transaction}/hard-nsf', [TransactionController::class, 'hardNsf'])->name('payment.hard-nsf');
    //Route::resource('banking', BankingController::class);
});*/

require __DIR__.'/auth.php';

Route::get('test', function() {
    $package['number_of_payments'] = 5;
    $today = Carbon\Carbon::parse('2022/05/06');
    $freq = "m6";

    for ($i = 1; $i <= $package['number_of_payments']; $i++) {
        $date = $today->isBusinessDay() ? $today : $today->copy()->nextBusinessDay();
        dump($today, $date);
        dump("------------------------------------");

        $month = Str::of($freq)->replace('m', '')->__toString();
        $today->addMonths($month);
    }
});
