<?php

namespace App\Http\Controllers\Freelances;

use App\Http\Controllers\Controller;
use App\Models\Freelances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Facades\JWTAuth;

class LoginFreelanceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try{
            $input = $request->only('email', 'password');
            $validator = Validator::make($input, $this->rules());

            if($validator->fails())
            return response_api_form_error('error', $validator->errors());

            $freelancer = Freelances::where('email', $request->input('email'))->first();
            
            if (!$freelancer) {
                return response_api_error('Email dan Password tidak terdaftar', 'invalid_credentials');
            }

            if (!Hash::check($request->password, $freelancer->password)) {
                return response_api_error('Password yang Anda masukan salah', 'invalid_credentials');
            }

            $dataSuccess = [
                "freelance_id"=> $freelancer->freelance_id,
                "name"=> $freelancer->name,
                "email"=> $freelancer->email,
                "email_verified_at"=> $freelancer->verified_at,
                "no_telp"=> $freelancer->no_telp,
                "position"=> $freelancer->position,
                "education"=> $freelancer->education,
                "address"=> $freelancer->address,
                "created_at"=> $freelancer->created_at,
                "updated_at"=> $freelancer->updated_at,
                'token' => JWTAuth::attempt($input)
            ];

            return response_api_success($dataSuccess);

        }catch(\Exception $e){
            return response_api_server_error($e->getMessage());
        }
    }

    protected function rules()
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        return $rules;
    }
}
