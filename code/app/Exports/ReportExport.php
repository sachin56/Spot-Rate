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
                    ->join('users','users.id','=','a_e_request_forms.assign_ae')
                    ->select('a_e_request_forms.icpc_no','a_e_request_forms.mount_code','a_e_request_forms.company_name','a_e_request_forms.weight','a_e_request_forms.destination',
                    'a_e_request_forms.service','a_e_request_forms.ae_rate','a_e_request_forms.ae_status','users.name as username','a_e_request_forms.rate_offer','a_e_request_forms.created_at')
                    ->get();

                for($i=0;$i<count($result);$i++){
                    if($result[$i]->ae_status == '0'){
                        $result[$i]->ae_status = 'Close Won';
                    }else if($result[$i]->ae_status == '1'){
                        $result[$i]->ae_status = 'close Lost';
                    }else{
                        $result[$i]->ae_status = 'Pending';
                    }
                }
                
                for($i=0;$i<count($result);$i++){
                    if($result[$i]->service == '1'){
                        $result[$i]->service = 'Inbound / IP';
                    }elseif($result[$i]->service == '2'){
                        $result[$i]->service = 'Inbound / IPF';
                    }elseif($result[$i]->service == '3'){
                        $result[$i]->service = 'Outbound / IP';
                    }else{
                        $result[$i]->service = 'Outbound / IPF';
                    }
                }
                dd($result);
        return $result;
    }
    public function headings(): array
    {
        return [
            'ICPC NO',
            'Mount Code',
            'Company Name',
            'Weight',
            'Country',
            'Service',
            'Request Rate',
            'AE Status',
            'AE',
            'Pricing Offered Rate',
            'Created At'
        ];
    }
}
