<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactNote;
use App\Models\ContactStatus;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        return view('app.contacts.index');
    }

    public function update(Request $request, $id)
    {
        $request->merge(['updated_user_id' => Auth::user()->id]);
        $contact = Contact::find($id)->update($request->except('_token'));
        return redirect()->back();
    }

    public function lookup(Request $request)
    {
        $nameError = false;
        $contacts = [];
        $query = Contact::query();
        $query->with('phone_numbers');
        $query->with('primary_phone_number');
        $query->with('primary_email_address');
        $query->with('email_addresses');
        if (strlen($request->input('date_of_birth')) === 10) {
            $query->where('date_of_birth', date('Y-m-d', strtotime($request->input('date_of_birth'))));
        }
        if ($request->input('type') == 'phone' && strlen($request->input('phone')) === 14) {
            $query->whereHas('phone_numbers', function ($q) use ($request) {
                $q->where('phone_number', preg_replace('/[^0-9]/', '', $request->input('phone')));
            });
        }
        if ($request->input('type') == 'chart') {
            $query->where('chart_number', $request->input('chart'));
        }
        if ($request->input('type') == 'name' && stristr($request->input('name'), ',')) {
            $pieces = explode(',', trim($request->input('name')));
            if (count($pieces) === 2) {
                $query->where('last_name', 'LIKE', trim($pieces[0]) . '%')->where('first_name', 'LIKE', trim($pieces[1]) . '%');
            }
        } elseif ($request->input('type') == 'name' && !stristr($request->input('name'), ',')) {
            $nameError = true;
            return view('app.contacts.lookup.index', compact('contacts', 'nameError'));
        }
        $contacts = $query->get();
        return view('app.contacts.lookup.index', compact('contacts', 'nameError'));
    }

    public function listIndex(Request $request)
    {
        $query = Contact::query();
        $query->selectRaw('Distinct substring(last_name,1,1) as letter');
        $query->orderByRaw('substring(last_name, 1, 1) ASC');
        $letters = $query->get();
        return view('app.contacts.list.index', compact('letters'));
    }

    public function listResult($letter)
    {
        $query = Contact::query();
        $query->with(['primary_phone_number', 'primary_email_address', 'phone_numbers', 'email_addresses']);
        $query->whereRaw('substring(last_name,1,1) = ?', [$letter]);
        $query->orderBy('last_name', 'ASC')->orderBy('first_name', 'ASC');
        $contacts = $query->get();
        return view('app.contacts.list.result.index', compact('contacts'));
    }

    public function edit($id)
    {
        $options = Option::where('table', 'contacts')->orderBy('sort')->get();
        $uStatuses = [];
        $statuses = [];
        foreach ($options as $option) {
            $statuses[$option->id] = $option->value;
            if ($option->is_unique) {
                $uStatuses[] = $option->id;
            }
        }
        $query = Contact::query();
        $query->with(['primary_phone_number', 'primary_email_address', 'primary_address', 'phone_numbers', 'email_addresses', 'addresses',
            'notes' => function ($q) {
                $q->with(['user', 'update_user'])->orderBy('created_at', 'DESC');
            },
            'current_status' => function ($q) {
                $q->with(['status', 'user']);
            },
            'statuses' => function ($q) {
                $q->with(['status', 'from_status', 'user']);
            }
        ]);
        $contact = $query->find($id);
        foreach ($contact->statuses as $status) {
            if (in_array($status->status_id, $uStatuses)) {
                unset($statuses[$status->status_id]);
            }
        }
        return view('app.contacts.edit.index', compact('contact', 'statuses'));
    }

    public function storeStatus(Request $request)
    {
        $error = false;
        $current = ContactStatus::where('contact_id', $request->input('contact_id'))->orderBy('created_at', 'DESC')->first();
        if ($current && $current->status_id !== (int)$request->input('from_status_id')) {
            return redirect()->back()->withErrors(['msg' => 'Status was updated since it you loaded it, please check status and proceed accordingly.']);
        }

        $array = [
            'contact_id' => $request->input('contact_id'),
            'status_id' => $request->input('status_id'),
            'from_status_id' => ($current) ? $current->status_id : null,
            'user_id' => Auth::user()->id
        ];

        $newStatus = ContactStatus::create($array);
        $noteArray = $request->input('notes');
        if ($newStatus && strlen($noteArray['note']) > 3) {
            $array = [
                'contact_id' => $noteArray['contact_id'],
                'user_id' => Auth::user()->id,
                'updated_user_id' => Auth::user()->id,
                'category' => 'Status Change',
                'note' => trim($noteArray['note']),
                'follow_up_on' => (strlen($noteArray['follow_up_on']) === 10) ? date('Y-m-d', strtotime($noteArray['follow_up_on'])) : null,
            ];
            ContactNote::create($array);
        }
        return redirect()->back();
    }

    public function closeFollowUp($id)
    {
        $arr = [
            'follow_up_done' => true,
            'updated_user_id' => Auth::user()->id
        ];
        $note = ContactNote::find($id);
        if ($note && !$note->follow_up_done) {
            $note->update($arr);
        }
        return redirect()->back();
    }

    public function storeNote(Request $request)
    {
        $arr = [
            'contact_id' => $request->input('contact_id'),
            'note' => $request->input('contact_id'),
            'user_id' => Auth::user()->id,
            'updated_user_id' => Auth::user()->id,
            'category' => 'Status Change',
            'note' => trim($request->input('note')),
            'follow_up_on' => (strlen($request->input('follow_up_on')) === 10) ? date('Y-m-d', strtotime($request->input('follow_up_on'))) : null
        ];
        ContactNote::create($arr);
        return redirect()->back();
    }

    public function linkEmr(Request $request, $id)
    {
        try {
            $idIsLinked = Contact::where('emr_id', $request->input('emr_id'))->first();
            if ($idIsLinked) {
                throw new \Exception('Selected patient is already linked to account ' . $idIsLinked->id . ' - ' . $idIsLinked->last_name . ', ' . $idIsLinked->first_name);
            }
            $arr = [
                'emr_id' => $request->input('emr_id'),
                'emr_name' => $request->input('emr_name'),
                'chart_number' => $request->input('chart_number')
            ];
            $contact = Contact::find($id);
            $contact->update($arr);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
        return redirect()->back();
    }

    public function breakEmrLink($id)
    {
        $arr = [
            'emr_id' => null,
            'emr_name' => null,
            'chart_number' => null
        ];
        $contact = Contact::find($id);
        $contact->update($arr);
        return redirect()->back();
    }
}
