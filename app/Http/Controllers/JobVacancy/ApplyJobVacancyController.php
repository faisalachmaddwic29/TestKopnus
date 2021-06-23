<?php

namespace App\Http\Controllers\JobVacancy;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;


class ApplyJobVacancyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if(!Auth::user()['freelance_id'] != null) return response_api_form_error('Mohon maaf anda tidak bisa daftar, silahkan login menggunakan akun freelancer', 'error');
        $rules = [
            'file' => 'required|mimes:pdf|max:2048',
            'note' => 'required|max:255',
            'company_id' => 'required|exists:companies,company_id',
        ];

        try{
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) return response_api_form_error('error', $validator->errors());

            $originalImage = $request->file;
            $fileName = time() . '-' . Str::slug(Auth::user()['name']) . '.'. $originalImage->getClientOriginalExtension();
            $originalImage->move(storage_path('cv'), $fileName);

            DB::beginTransaction();
            $apply = new Apply();
            $apply->document = $fileName;
            $apply->note = $request->note;
            $apply->job_id = $request->id;
            $apply->freelance_id = Auth::user()['freelance_id'];
            $apply->company_id = $request->company_id;
            $apply->save();

            DB::commit();

            return response_api_success('Anda berhasil mengapply');
        }catch(\Exception $e){
            DB::rollBack();
            return response_api_server_error($e->getMessage());
        }
    }
}
