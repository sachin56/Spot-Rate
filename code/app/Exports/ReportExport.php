<?php

namespace App\Exports;

use App\Models\AERequestForm;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        $result = DB::table('a_e_request_forms')
                    ->select('a_e_request_forms.ae_status','a_e_request_forms.icpc_no','a_e_request_forms.mount_code','a_e_request_forms.weight','a_e_request_forms.destination','a_e_request_forms.service','a_e_request_forms.ae_rate','a_e_request_forms.ae_status')
                    ->get();
                for($i=0;$i<count($result);$i++){
                    if($result[$i]->ae_status == 0){
                        $result[$i]->ae_status = 'Close Won';
                    }elseif($result[$i]->ae_status == 1){
                        $result[$i]->ae_status = 'close Lost';
                    }else{
                        $result[$i]->ae_status = 'Pending';
                    }
                }
                for($i=0;$i<count($result);$i++){
                    if($result[$i]->service == 1){
                        $result[$i]->service = 'Inbound / IP';
                    }elseif($result[$i]->service == 2){
                        $result[$i]->service = 'Inbound / IPF';
                    }elseif($result[$i]->service == 3){
                        $result[$i]->service = 'Outbound / IP';
                    }else{
                        $result[$i]->service = 'Outbound / IPF';
                    }
                }
       
        return $result;
    }
    public function headings(): array
    {
        return [
            'AE Status',
            'ICPC NO',
            'Mount Code',
            'Weight',
            'Country',
            'Service',
            'Request Rate',
        ];
    }
}
