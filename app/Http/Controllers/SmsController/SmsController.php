<?php

namespace App\Http\Controllers\SmsController;

use App\Http\Controllers\Controller;
use App\Jobs\SmsJob;
use App\Models\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SmsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function createSMS(Request $request)
    {
        $rules = [
            'message' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        //queue
        $daily_sms = Sms::whereDate('created_at', date('Y-m-d'))->get();
        if (count($daily_sms) > 500) {
            dispatch(new SmsJob($request->message));
        } else {
            $sms = new Sms();
            $sms->user_id = auth()->user()->id;
            $sms->message = $request->message;
            if (!$sms->save()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Something went wrong. Please try again.'
                ], Response::HTTP_BAD_REQUEST);
            }
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Message sent successfully.'
        ], Response::HTTP_CREATED);
    }

    public function getSMS(Request $request)
    {
        $filter = "ASC";
        if ($request->query('date') == 'DESC') {
            $filter = "DESC";
        }
        $sms = Sms::where('user_id', auth()->user()->id)->orderBy('created_at', $filter)->get();
        return response()->json([
            'status' => 'success',
            'data' => count($sms) == 0 ? 'Data not found' : $sms
        ], Response::HTTP_OK);
    }

    public function getSMSId($id)
    {
        $sms = Sms::where([
            'id' => $id,
            'user_id' => auth()->user()->id
        ])->first();
        if ($sms) {
            return response()->json([
                'status' => 'success',
                'data' => $sms
            ], Response::HTTP_OK);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'The data not found'
        ], Response::HTTP_NOT_FOUND);
    }
}
