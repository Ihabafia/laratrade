<?php

namespace App\Http\Controllers\Audits;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AuditTrailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return View
     */
    public function __invoke()
    {
        $audits = Activity::query()
            ->with('causer:id,first_name,last_name')
            ->where('log_name' , session('client_id'))
            ->orderByDesc('created_at')
            ->get();

        return view('audits.index', compact('audits'));
    }
}
