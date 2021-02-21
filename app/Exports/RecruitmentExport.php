<?php

namespace App\Exports;

use App\Models\Recruitment;
use App\Models\Apply;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Auth;
use Carbon\Carbon;
class RecruitmentExport implements FromCollection, WithHeadings
{
	// public function __construct(Recruitment $mrecruitment)
	// {
 //        $this->mrecruitment = $mrecruitment;
	// }
	public function heading():array
	{
		return[
			"Danh sach",
		];
 	}
	public function headings():array
	{
		return[
			"STT",
			"ID",
			"Title",
			"Number of recruitment",
			"Posting Date",
			"Expired Date",
			"Application Count",
			"Status",
		];
 	}
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Recruitment::all();
        $recruitments = Recruitment::getRecruitmentsUser_Export(Auth::user()->id_user);
        $arResutls = [];

        $dt  = Carbon::now('Asia/Ho_Chi_Minh');
        $now = $dt->toDateString();
        $stt = 0;
        foreach ($recruitments as $recruitment) {
            $id_recruitment = $recruitment->id_recruitment;
            $rname          = $recruitment->rname;
            $amount         = $recruitment->amount;
            $expired_time   = $recruitment->expired_time;
            $status         = $recruitment->status;
            $created_at     = $recruitment->created_at;
            if ( (strtotime($expired_time)-strtotime($now)) > 0 ) {
                if ($status == 0) {
                $name_status = 'Hidden';
                }elseif ($status == 1) {
                    $name_status = 'Approved';
                }else{
                    $name_status = 'Approving';
                }
            }else{
                $name_status = 'Expired';
            }
            $application_number = Apply::getCountApplication($id_recruitment);
            if ($application_number != 1) {
            	$application_number = "0";
            }
            $stt++;
            $arNew = array(
                'stt'                => $stt,
                'id_recruitment'     => $id_recruitment,
                'rname'              => $rname,
                'amount'             => $amount,
                'created_at'         => $created_at,
                'expired_time'       => $expired_time,
                'application_number' => $application_number,
                'name_status'        => $name_status,
            );
            $arResutls['New-'.$id_recruitment] = $arNew;
        }
        return collect($arResutls);
    }
}
