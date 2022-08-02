<?php

namespace App\Http\Controllers\Communications;

use App\Http\Controllers\Controller;
use App\Models\Communication;
use Illuminate\Http\Request;
use function Pest\Laravel\delete;

class EditCommunicationController extends Controller
{
    public function edit(Communication $communication, $type)
    {
        if($communication->master->type !== $type) {
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
        return view('communications.edit-email', compact('communication', 'type'));
    }

    public function sms($communication, $type)
    {
        return view('communications.edit-sms', compact('communication', 'type'));
    }

    public function prc($communication, $type)
    {
        return view('communications.edit-prc', compact('communication', 'type'));
    }
}
