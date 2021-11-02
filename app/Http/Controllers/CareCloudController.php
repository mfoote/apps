<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CareCloudController extends Controller
{
    protected $requestHeader;
    protected $tokenInfo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function lookupForm($id)
    {
        $contact = Contact::find($id);
        return view('app.emr.lookup.form.index', compact('contact'));
    }

    public function lookupResult(Request $request, $id)
    {
        if (strlen($request->input('last_name'))) {
            $fields['fields']['last_name'] = $request->input('last_name');
        }
        if (strlen($request->input('first_name'))) {
            $fields['fields']['first_name'] = $request->input('first_name');
        }
        if (strlen($request->input('dob')) === 10) {
            $fields['fields']['dob'] = $request->input('dob');
        }
        try {
            $record = Contact::find($id);
            if (null !== $record) {
                $arr = [
                    'link_attempt_at' => date('Y-m-d H:i:s'),
                    'updated_user_id' => Auth::user()->id
                ];
                $record->update($arr);
            }
            $tokenResponse = $this->checkLocalToken();
            if (!$tokenResponse['error']) {
                $this->setRequestHeaders($this->tokenInfo['access_token']);
                $client = new Client();
                $request = $client->post(env('CARECLOUD_API_URL') . '/patients/search', [
                    'headers' => $this->requestHeader,
                    'body' => json_encode($fields),
                ]);
                $patients = json_decode($request->getBody(), true);
                $data = ['error' => false, 'data' => $patients];
            } else {
                $data = ['error' => true, 'message' => 'Token Check Failed', 'data' => []];;
            }
        } catch (BadResponseException $e) {
            $data = ['error' => true, 'message' => 'Ins A: ' . $e->getMessage(), 'data' => []];
        } catch (\Exception $e) {
            $data = ['error' => true, 'message' => 'Ins B: ' . $e->getMessage(), 'data' => []];
        }
        return view('app.emr.lookup.result.index', compact('data', 'id'));
    }

    function is_json($string)
    {
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }

    protected function setRequestHeaders($alterAuth = false, $cTypeJson = true)
    {
        $this->requestHeader = [];
        $this->requestHeader['Authorization'] = base64_encode(env('CARECLOUD_AUTH'));
        if ($cTypeJson) {
            $this->requestHeader['Content-Type'] = 'application/json';
        }
        if ($alterAuth) {
            $this->requestHeader['Authorization'] = $alterAuth;
        }
    }

    protected function checkLocalToken()
    {
        $this->setRequestHeaders(false, false);
        $now = time();
        $json = Storage::disk('api')->get('key.json');
        if ($this->is_json($json)) {
            $arr = json_decode($json, true);
            if (array_key_exists('expires_at', $arr) && array_key_exists('access_token', $arr) && array_key_exists('refresh_token', $arr)) {
                if ((int)$arr['expires_at'] > $now) {
                    $this->tokenInfo = $arr;
                    return ['error' => false, 'msg' => 'ok'];
                } else {
                    $refresh = $this->refreshLocalToken($arr, $now);
                    if ($refresh['error'] && stristr($refresh['message'], 'expired')) {
                        return $this->createLocalToken($now);
                    }
                    return $refresh;
                }
            } else {
                return $this->createLocalToken($now);
            }
        } else {
            return $this->createLocalToken($now);
        }
    }

    protected function refreshLocalToken($arr, $now)
    {
        try {
            $client = new Client();
            $request = $client->post(env('CARECLOUD_OAUTH_URL'), [
                'headers' => $this->requestHeader,
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $arr['refresh_token']
                ]
            ]);
            $refreshedArr = json_decode($request->getBody(), true);
            $newArr = [
                'access_token' => $refreshedArr['access_token'],
                'refresh_token' => $arr['refresh_token'],
                'expires_in' => $refreshedArr['expires_in']
            ];
            return $this->setTokenInfo($newArr, $now);
        } catch (BadResponseException $e) {
            return ['error' => true, 'message' => 'refreshing token: ' . $e->getMessage()];
        } catch (\Exception $e) {
            return ['error' => true, 'message' => 'refreshing token: ' . $e->getMessage()];
        }
    }

    protected function createLocalToken($now)
    {
        try {
            $client = new Client();
            $request = $client->post(env('CARECLOUD_OAUTH_URL'), [
                'headers' => $this->requestHeader,
                'form_params' => [
                    'practice_id' => env('CARECLOUD_PRACTICE_ID'),
                    'grant_type' => 'password',
                    'user_name' => env('CARECLOUD_USER_NAME'),
                    'password' => env('CARECLOUD_PASSWORD')
                ]
            ]);
            $arr = json_decode($request->getBody(), true);
            return $this->setTokenInfo($arr, $now);
        } catch (BadResponseException $e) {
            return ['error' => true, 'message' => 'creating token: ' . $e->getMessage()];
        } catch (\Exception $e) {
            return ['error' => true, 'message' => 'creating token: ' . $e->getMessage()];
        }
    }

    protected function setTokenInfo($arr, $now)
    {
        try {
            $newArr = [
                'access_token' => $arr['access_token'],
                'refresh_token' => $arr['refresh_token'],
                'expires_at' => ($now + (int)$arr['expires_in'])
            ];
            Storage::disk('api')->put('key.json', json_encode($newArr));
            $this->tokenInfo = $newArr;
            return ['error' => false, 'message' => 'ok'];
        } catch (\Exception $e) {
            return ['error' => true, 'message' => 'setting token: ' . $e->getMessage()];
        }
    }
}
