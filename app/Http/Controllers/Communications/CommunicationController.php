<?php

namespace App\Http\Controllers\Communications;

use App\Actions\Commands\UpdateVars;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommunicationRequest;
use App\Http\Requests\UpdateCommunicationRequest;
use App\Mail\PreviewMail;
use App\Models\Communication;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommunicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $communications = Communication::query()
            ->get()
            ->groupBy(function ($communication) {
                if($communication->type == 'Email' || $communication->type == 'AdminEmail') {
                    return 'Email';
                }
                if($communication->type == 'SMS' || $communication->type == 'AdminSMS') {
                    return 'SMS';
                }
            });

        return view('communications.index', compact('communications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create($type)
    {
        if(!in_array($type, \App\Enums\Communication::toArray())) {
            return to_route('communications.index')
                ->with('error', __('communications.error-not-allowed'));
        }

    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommunicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(StoreCommunicationRequest $request)
    {
        //
    }*/

    public function edit(Request $request, Communication $communication)
    {
        if($communication->type !== $request->type) {
            return to_route('communications.index')
                ->with('error', __('communications.error-not-allowed'));
        }

        return match ($request->type) {
            'Email', 'AdminEmail' => $this->editEmail($communication, $request->type),
            'AdminSMS', 'SMS' => $this->editSms($communication, $request->type),
            'PRC' => $this->prc($communication, $request->type),
            default => to_route('communications.index')
                            ->with('error', __('communications.error-not-allowed')),
        };
    }

    public function update(Request $request, Communication $communication, UpdateVars $updateVars): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string'],
            'subject' => ['required', 'string'],
            'body' => ['required'],
        ]);

        $communication->update($data);

        if($request->type == 'Email' || $request->type = 'AdminEmail') {
            $updateVars($communication->fresh());
        }

        return to_route('communications.index')
            ->with('success', __('custom-messages.model-updated', ['model' => 'email']));
    }

    public function create(Request $request)
    {
        if(!in_array($request->type, \App\Enums\Communication::toArrayValues())) {
            return to_route('master-communications.index')
                ->with('error', __('communications.error-not-allowed'));
        }

        return match ($request->type) {
            'Email' => $this->createEmail(),
            'AdminEmail' => $this->createEmail('AdminEmail'),
            'SMS' => $this->createSms(),
            'AdminSMS' => $this->createSms('AdminSMS'),
            'PRC' => $this->prc(),
            default => to_route('communications.index')
                            ->with('error', __('communications.error-not-allowed')),
        };
    }

    public function store(Request $request, UpdateVars $updateVars): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string'],
            'method' => ['required'],
            'subject' => ['required', 'string'],
            'body' => ['required'],
        ]);

        $data['type'] = $request->type;
        $data['slug'] = str($data['title'])->append('-email')->slug()->__toString();

        $communication = Communication::create($data);

        $updateVars($communication);

        return to_route('communications.index')
            ->with('success', __('custom-messages.model-created', ['model' => 'email']));
    }


    public function preview(Communication $communication)
    {
        return new PreviewMail($communication);
    }

    public function editEmail($communication, $type)
    {
        return view('communications.edit-email', [
            'communication' => $communication,
            'type' => $type,
        ]);
    }

    public function editSms($communication, $type)
    {
        return view('communications.edit-sms', [
            'communication' => $communication,
            'type' => $type,
        ]);
    }

    public function createEmail($type = 'Email')
    {
        return view('communications.create-email', ['type' => $type]);
    }

    public function createSms($type = 'SMS')
    {
        return view('communications.create-sms', ['type' => $type]);
    }
}
