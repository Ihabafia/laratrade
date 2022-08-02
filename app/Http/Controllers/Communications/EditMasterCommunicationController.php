<?php

namespace App\Http\Controllers\Communications;

use App\Http\Controllers\Controller;
use App\Models\Communication;
use App\Models\MasterCommunication;
use Illuminate\Http\Request;
use function Pest\Laravel\delete;

class EditMasterCommunicationController extends Controller
{
    public function edit(MasterCommunication $communication, $type)
    {
        if($communication->type !== $type) {
            return to_route('communications.index')
                ->with('error', __('communications.error-not-allowed'));
        }

        return match ($type) {
            'Email', 'AdminEmail' => $this->email($communication, $type),
            'AdminSMS', 'SMS' => $this->sms($communication, $type),
            'PRC' => $this->prc($communication, $type),
            default => to_route('communications.index')
                            ->with('error', __('communications.error-not-allowed')),
        };
    }

    public function email($communication, $type)
    {
        return view('master-communications.edit-email', compact('communication', 'type'));
    }

    public function sms($communication, $type)
    {
        return view('master-communications.edit-sms', compact('communication', 'type'));
    }

    public function prc($communication, $type)
    {
        return view('master-communications.edit-prc', compact('communication', 'type'));
    }
}
