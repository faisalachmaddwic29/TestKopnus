<?php

namespace App\Http\Controllers\JobVacancy;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class JobVacanyController extends Controller
{
    public function index()
    {
        try{
            $jobVacancy = JobVacancy::select('job_id', 'title', 'jenis_pekerjaan', 'description', 'address', 'payment', 'company_id', 'created_at')
                ->where('status', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(5);
            return response_api_success($jobVacancy);
        }catch(\Exception $e){
            return response_api_server_error($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $rules = [
            // 'file' => 'required|mimes:pdf,xlx,csv|max:2048',
            'title' => 'required',
            'jenis_pekerjaan' => 'required',
            'description' => 'required',
            'address' => 'required|min:3',
            'payment' => 'required|',
            'status' => 'required|boolean',
            'company_id' => 'required|exists:companies,company_id',
        ];

        try {
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) return response_api_form_error('error', $validator->errors());


            DB::beginTransaction();

            $jobVacancy = new JobVacancy();
            $jobVacancy->title = $request->title;
            $jobVacancy->jenis_pekerjaan = $request->jenis_pekerjaan;
            $jobVacancy->description = $request->description;
            $jobVacancy->address = $request->address;
            $jobVacancy->payment = $request->payment;
            $jobVacancy->status = $request->status;
            $jobVacancy->company_id = $request->company_id;
            $jobVacancy->save();

            DB::commit();

            return response_api_success('Anda telah berhasil menambahkan lowongan pekerjaan baru');
        } catch (\Exception $e) {
            DB::rollBack();
            return response_api_server_error($e->getMessage());
        }
    }
}
