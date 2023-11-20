<?php

namespace App\Exports;

use App\Models\AERequestForm;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AERequestForm::all();

        $result = DB::table('a_e_request_forms')
                    ->join('users','users.id','=','a_e_request_forms.assign_ae')
                    ->whereRaw("
                        IF(a_e_request_forms.ae_status == 0)

                        ")
                    ->select('a_e_request_forms.*','user.name as username')
                    ->get();

                    return $result;
    }
}
