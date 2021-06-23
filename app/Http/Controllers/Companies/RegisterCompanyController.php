<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class RegisterCompanyController extends Controller
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
            $validator = Validator::make($request->all(), $this->rules());
            if($validator->fails()) return response_api_form_error('error', $validator->errors());

            DB::beginTransaction();
            $company = new Companies();
            $company->name = $request->name;
            $company->email = $request->email;
            $company->no_telp = $request->telephone;
            $company->password = bcrypt($request->password);

            $company->save();
            DB::commit();

            return response_api_success($company);
        }catch(\Exception $e){
            DB::rollBack(); //apabila terjadi error maka proeses yang sebelumnya sudah terinput di db akan dihapus.
            return response_api_server_error($e->getMessage());
        }
    }

    protected function rules()
    {
        $rules = [
            'name' => 'required|max:100|min:3',
            'email' => 'required|email|min:5|unique:companies,email',
            'telephone' => 'required|min:3|unique:companies,no_telp',
            'password' => 'required|min:5|max:100',
        ];

        return $rules;
    }
}
