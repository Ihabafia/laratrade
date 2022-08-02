<?php

namespace App\Http\Controllers\Communications;

use Illuminate\Http\Request;
use App\Models\MasterCommunication;
use App\Http\Controllers\Controller;

class MasterCommunicationController extends Controller
{
    public function index()
    {
        $communications = MasterCommunication::query()
            ->get()
            ->groupBy(function ($communication) {
                if($communication->type == 'Email' || $communication->type == 'AdminEmail') {
                    return 'Email';
                }
                if($communication->type == 'SMS' || $communication->type == 'AdminSMS') {
                    return 'SMS';
                }
                if($communication->type == 'PRC') {
                    return 'PRC';
                }
            });

        return view('master-communications.index', compact('communications'));
    }
}
