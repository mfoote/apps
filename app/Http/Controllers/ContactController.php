<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('app.contacts.index');
    }

    public function lookup(Request $request)
    {
        $query = Contact::query();
        $query->with('phone_numbers');
        $query->with('primary_phone_number');
        $query->with('email_addresses');
        if (strlen($request->input('date_of_birth')) === 10) {
            $query->where('date_of_birth', date('Y-m-d', strtotime($request->input('date_of_birth'))));
        }
        if ($request->input('type') == 'phone' && strlen($request->input('phone')) === 14) {
            $query->whereHas('phone_numbers', function ($q) use ($request) {
                $q->where('phone_number', preg_replace('/[^0-9]/', '', $request->input('phone')));
            });
        }
        if ($request->input('type') == 'name' && stristr($request->input('name'), ',')) {
            $pieces = explode(',', trim($request->input('name')));
            $query->where('last_name', 'LIKE', $pieces[0] . '%')->where('first_name', 'LIKE', $pieces[1] . '%');
        }
        $contacts = $query->get();
        return view('app.contacts.lookup.index', compact('contacts'));
    }
}
