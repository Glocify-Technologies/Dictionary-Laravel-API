<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\API\TokenRequest;
use App\Models\Setting;
use Illuminate\Support\Str;

class PassportAuthController extends AppBaseController
{
    
    /**
     * Login
     */

    /**
     * @OA\Post(
     *     path="/oauth/token",
     *     operationId="token",
     *     tags={"Token"},
     *     summary="Token for access Apis",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/TokenRequest")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\JsonContent(ref="#/components/schemas/TokenResponse")
     *     ),
     *    @OA\Response(
     *      response=400,ref="#/components/schemas/BadRequest"
     *    ),
     *    @OA\Response(
     *      response=404,ref="#/components/schemas/Notfound"
     *    ),
     *    @OA\Response(
     *      response=500,ref="#/components/schemas/Forbidden"
     *    )
     * )
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ExampleStoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function oauth_token(TokenRequest $request)
    {


        $client_secret = env('API_ACCESS_CLIENT_SECRET')??'8BSSg7qMYw2NAJaiMhQOCYxGlFSs141SLfPRLU';
        $client_id = env('API_ACCESS_CLIENT_ID') ?? 2;

        if ($request['client_id'] != $client_id)
        {
            return response()->json(['success' => false, 'message' => "Invalid client Id"], 400);
        }

        if ($request['client_secret'] != $client_secret)
        {
            return response()->json(['success' => false, 'message' => "Invalid client secret"], 400);
        }


        $setting = Setting::orderBy('id', 'asc')->first();
        if(!empty($setting)){
            $updated_at = $setting->updated_at ?? '';
            $token = $setting->oauth_token ?? '';
            $currentDate = date('Y-m-d H:i:s');

            if (empty($token))
            {
                $setting->oauth_token = Str::random(70);
                $setting->save();
            }
            return response()->json([
                'success' => true, 'Token' => $setting->oauth_token
    ]);
        }else{
            $newSetting=new Setting;
            $newSetting->oauth_token = Str::random(70);
            $newSetting->save();
            return response()->json([
                'success' => true, 'Token' => $newSetting->oauth_token
    ]);
    }



        // $untillDate = date('Y-m-d h:m:s', strtotime($updated_at . ' + 1 days'));

        // if ($currentDate > $untillDate)
        // {
        //     $setting->oauth_token = Str::random(70);
        //     $setting->save();
        // }


    }

}
