<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Traits\FileTrait;
class CompanyController extends Controller
{
    use FileTrait;
    public function show($domain_id)
    {
        try {
            $company = DB::table('companies')->where('domain_id', $domain_id)->first();
           
            return response()->json(['status' => true, 'data' => $company]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()]);
        }
    }
    public function store(Request $request)
    {
        try {
            $folderName = 'companies/'.$request->domain_id;
            $isValid=$this->checkIsValidImage($request->logo);
            $toInsert = [
                'name' => $request->nombreInstitucion,
                
            ];
            if($isValid){
                $toInsert['logo_url']=$this->uploadFile($request->logo,$folderName);
            }
            //if exist id in request, update
            DB::table('companies')->where('domain_id', $request->domain_id)->update($toInsert);
            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()]);
        }
    }
}
