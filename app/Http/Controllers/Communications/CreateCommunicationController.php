<?php

namespace App\Http\Controllers\Communications;

use App\Http\Controllers\Controller;
use App\Models\Communication;
use Illuminate\Http\Request;
use function Pest\Laravel\delete;

class CreateCommunicationController extends Controller
{
    public function create(Request $request, $type)
    {
        if(!in_array($type, \App\Enums\Communication::toArrayValues())) {
            return to_route('master-communications.index')
                ->with('error', __('communications.error-not-allowed'));
        }

        return match ($type) {
            'Email' => $this->email(),
            'AdminEmail' => $this->email('AdminEmail'),
            'SMS' => $this->sms(),
            'AdminSMS' => $this->sms('AdminSMS'),
            'PRC' => $this->prc(),
            default => to_route('communications.index')
                            ->with('error', __('communications.error-not-allowed')),
        };
    }

    public function email($type = 'Email')
    {
        return view('master-communications.create-email', ['type' => $type]);
    }

    public function sms($type = 'SMS')
    {
        return view('master-communications.create-sms', ['type' => $type]);
    }

    public function prc()
    {
        return view('master-communications.create-prc', ['type' => 'PRC']);
    }
}
