<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginCompanyController extends Controller
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

            $company = Companies::where('email', $request->input('email'))->first();
            
            if (!$company) {
                return response_api_error('Email dan Password tidak terdaftar', 'invalid_credentials');
            }

            if (!Hash::check($request->password, $company->password)) {
                return response_api_error('Password yang Anda masukan salah', 'invalid_credentials');
            }

            $dataSuccess = [
                "company_id"=> $company->company_id,
                "name"=> $company->name,
                "email"=> $company->email,
                "email_verified_at"=> $company->email_verified_at,
                "no_telp"=> $company->no_telp,
                "address"=> $company->address,
                "created_at"=> $company->created_at,
                "updated_at"=> $company->updated_at,
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
