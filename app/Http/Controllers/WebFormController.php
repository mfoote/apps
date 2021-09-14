<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\WpGfEntry;
use App\Models\WpGfForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebFormController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $query = WpGfForm::query();
        $query->where('is_active', 1);
        $query->with('form_entries', function ($query) {
            $query->whereNull('is_fulfilled')->whereNotIn('status', ['trash'])->with('form_entry_meta');
        });
        $query->with('form_meta', function ($query) {
            $query->select('form_id', 'display_meta');
        });
        $forms = $query->get();
        $metaMap = [];
        foreach ($forms as $key => $form) {
            foreach ($form['form_meta']['display_meta']['fields'] as $key => $val) {

                if (strtolower($val['label']) !== 'captcha') {
                    if (null !== $val['inputs']) {
                        foreach ($val['inputs'] as $input) {
                            if (!array_key_exists('isHidden', $input)) {
                                $metaMap[$form['form_meta']['form_id']]['field'][$input['id']] = [
                                    'column' => $this->columnNaming($input['label'])
                                ];
                            }
                        }
                        $metaMap[$form['form_meta']['form_id']]['field'][$val['id']] = [
                            'column' => $this->columnNaming($val['label'])
                        ];
                    } else {

                        $metaMap[$form['form_meta']['form_id']]['field'][$val['id']] = [
                            'column' => $this->columnNaming($val['label'])
                        ];
                    }
                }
            }
        }
        $entries = [];
        $eKey = 0;
        foreach ($forms as $key => $form) {
            foreach ($form->form_entries as $k2 => $entry) {
                $entries[$eKey] = [
                    'id' => $entry->id,
                    'status' => $entry->status,
                    'site' => 'spinecenteratlanta.com',
                    'form_id' => $forms[$key]['id'],
                    'form_name' => $forms[$key]['title']
                ];
                foreach ($entry['form_entry_meta'] as $k => $meta) {
                    $entries[$eKey][$metaMap[$forms[$key]['id']]['field'][$meta['meta_key']]['column']] = $this->cleanValues($metaMap[$forms[$key]['id']]['field'][$meta['meta_key']]['column'], $meta['meta_value']);
                }
                $entries[$eKey]['created_at'] = $entry['date_created'];
                $entries[$eKey]['updated_at'] = $entry['date_updated'];
                $eKey++;
            }
        }
        return view('app.web_forms.index', compact('entries'));
    }

    public function trash(Request $request)
    {
        $arr = ['is_fulfilled' => '2', 'status' => 'trash', 'transaction_id' => Auth::user()->id];
        $entry = WpGfEntry::find($request->input('id'));
        if (null !== $entry && $entry->is_fulfilled !== 'trash') {
            $entry->update($arr);
        }
        return redirect()->back();
    }

    public function convert(Request $request)
    {
        $entry = json_decode($request->input('entry'), true);
        $creatArr = [
            'created_user_id' => Auth::user()->id,
            'updated_user_id' => Auth::user()->id,
            'status' => 'Web Conversion',
            'first_name' => (array_key_exists('first_name', $entry) && strlen(trim($entry['first_name']))) ? trim($entry['first_name']) : null,
            'last_name' => (array_key_exists('last_name', $entry) && strlen(trim($entry['last_name']))) ? trim($entry['last_name']) : null,
            'form_id' => (array_key_exists('form_id', $entry) && strlen(trim($entry['form_id']))) ? trim($entry['form_id']) : null,
            'form_name' => (array_key_exists('form_name', $entry) && strlen(trim($entry['form_name']))) ? trim($entry['form_name']) : null,
            'website' => (array_key_exists('site', $entry) && strlen(trim($entry['site']))) ? trim($entry['site']) : null,
            'external_id' => $request->input('id'),
            'external_id_type' => 'Web Form',
            'conversion_type' => 'Web Form',
            'initial_comment' => (array_key_exists('comments', $entry) && strlen(trim($entry['comments']))) ? trim($entry['comments']) : null,
            'web_postal_code' => (array_key_exists('postal_code', $entry) && strlen(trim($entry['postal_code'])) == 5) ? trim($entry['postal_code']) : null,
            'created_at' => date('Y-m-d H:i:s', strtotime($entry['created_at'])),
        ];

        if (array_key_exists('phone_number', $entry) && strlen(preg_replace('/[^0-9]/', '', $entry['phone_number'])) === 10) {
            $creatArr['contact_phone_numbers'] = ['phone_number' => preg_replace('/[^0-9]/', '', $entry['phone_number']), 'is_primary' => true];
        }

        if (array_key_exists('email_address', $entry) && filter_var($entry['email_address'], FILTER_VALIDATE_EMAIL)) {
            $creatArr['contact_email_addresses'] = ['email_address' => trim($entry['email_address']), 'is_primary' => true];
        }

        try {
            $eType = 'Error';
            $eClass = 'alert-danger';
            if (null === Contact::where('form_id', $creatArr['form_id'])->where('website', $creatArr['website'])->where('external_id', $creatArr['external_id'])->first()) {
                $contact = Contact::create($creatArr);
                if (array_key_exists('contact_phone_numbers', $creatArr)) {
                    $contact->phone_numbers()->create($creatArr['contact_phone_numbers']);
                }
                if (array_key_exists('contact_email_addresses', $creatArr)) {
                    $contact->email_addresses()->create($creatArr['contact_email_addresses']);
                }
                if($creatArr['website'] === 'spinecenteratlanta.com'){
                    $arr = ['is_fulfilled' => '1', 'status' => 'converted', 'transaction_id' => Auth::user()->id];
                    $entry = WpGfEntry::find($request->input('id'));
                    if (null !== $entry && $entry->is_fulfilled !== 'trash') {
                        $entry->update($arr);
                    }
                }
            } else {
                $eType = 'Notice';
                $eClass = 'alert-info';
                throw new \Exception('Another user already converted this form, screen has been reloaded.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage(), 'class' => $eClass, 'type' => $eType]);
        }
        return redirect()->back();
    }

    protected function columnNaming($val)
    {
        if (stristr($val, 'first')) {
            return 'first_name';
        } elseif (stristr($val, 'last')) {
            return 'last_name';
        } elseif (stristr($val, 'reason')) {
            return 'contact_reason';
        } elseif (stristr($val, 'zip')) {
            return 'postal_code';
        } elseif (stristr($val, 'email')) {
            return 'email_address';
        } elseif (stristr($val, 'phone')) {
            return 'phone_number';
        } else {
            return strtolower(str_replace(' ', '_', str_replace('  ', ' ', $val)));
        }
    }

    protected function cleanValues($field, $val)
    {
        $val = trim($val);
        switch ($field) {
            case 'first_name':
                return ucwords(strtolower($val));
            case 'last_name':
                return ucwords(strtolower($val));
            //case 'phone_number':
            //return preg_replace('/[^0-9]/', '', $val);
            case 'email_address':
                return (filter_var($val, FILTER_VALIDATE_EMAIL)) ? strtolower($val) : null;
            case 'last_name':
                return ucwords(strtolower($val));
            default:
                return $val;
        }
    }
}
