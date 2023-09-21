<?php

namespace App\Http\Controllers\Cetak;
use Validator;
use App\Exports\LaporanRekapPengguna;
use App\Exports\LaporanRekapPelamar;
use App\User;
use App\JobApplicant;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class CetakExcel extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function exportPengguna()
    {   
        if(!auth()->user()->hasRole('Admin|Super Admin'))
            return abort(401); 
            
        $data = array();

        $data["header"] = "Data Pengguna Unesa Virtual Career Fair";

        $nama_file = "Rekap Data Pengguna Unesa Virtual Career Fair";
        $format_file = ".xlsx.xlsx";
        //return $new_data;
        return Excel::download(new LaporanRekapPengguna($data), $nama_file. $format_file, \Maatwebsite\Excel\Excel::XLSX);

        //return (new LaporanRekap108Export($data))->download('invoices.xlsx', \Maatwebsite\Excel\Excel::XLSX);s
        //return Excel::download(new LaporanPenerimaanExport($data), $nama_file.'.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function exportPelamar()
    {   
        if(!auth()->user()->hasRole('Admin|Super Admin'))
            return abort(401); 
            
        $data = array();

        $data["header"] = "Rekap Data Pelamar Unesa Virtual Career Fair";

        $nama_file = "Rekap Data Pelamar Unesa Virtual Career Fair";
        $format_file = ".xlsx.xlsx";

        return Excel::download(new LaporanRekapPelamar($data), $nama_file. $format_file, \Maatwebsite\Excel\Excel::XLSX);

        //return Excel::download(new LaporanPenerimaanExport($data), $nama_file.'.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

}
