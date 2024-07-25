<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sales;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    public function sales_report(Request $request){
        $fromdate = date('Y-m-d'); 
        $todate = date('Y-m-d');

        $customers = Customer::all();
        $query = Sales::with('details');

        if($request->filled('fromDate') && $request->filled('toDate')){
            $fromdate = $request->fromDate;
            $todate=$request->toDate;
            $query->whereBetween('invoice_date', [$fromdate,$todate]);
        }

        if($request->filled('customerId')){
            $query->where('customerId', $request->customerId);
        }

        $dataList=$query->get();

    //     if ($request->input('submit') == "pdf"){
    //         $fileName = 'sales_report';

    //         $pdf = PDF::loadView('backend.reports.sales_report_pdf',
    //         compact('dataList','customers','fromdate','todate',), [], [
    //           'title' => $fileName,
    //         ]);
    //     return $pdf->stream($fileName,'.pdf');
    //    }

        return view('backend.reports.sales_report',compact('dataList','customers','fromdate','todate'));
    }
}
