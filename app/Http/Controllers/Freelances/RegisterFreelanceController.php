<?php

namespace App\Http\Controllers\Freelances;

use App\Http\Controllers\Controller;
use App\Models\Freelances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class RegisterFreelanceController extends Controller
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
            $freelancer = new Freelances();
            $freelancer->name = $request->name;
            $freelancer->email = $request->email;
            $freelancer->no_telp = $request->telephone;
            $freelancer->password = bcrypt($request->password);

            $freelancer->save();
            DB::commit();

            return response_api_success($freelancer);
        }catch(\Exception $e){
            DB::rollBack(); //apabila terjadi error maka proeses yang sebelumnya sudah terinput di db akan dihapus.
            return response_api_server_error($e->getMessage());
        }
    }

    protected function rules()
    {
        $rules = [
            'name' => 'required|max:100|min:3',
            'email' => 'required|email|min:5|unique:freelances,email',
            'telephone' => 'required|min:3|unique:freelances,no_telp',
            'password' => 'required|min:5|max:100',
        ];

        return $rules;
    }
}
