<?php

namespace App\Http\Controllers;

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
