<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forwarder;
use App\Models\Car;
use App\Models\Successfull;
use App\DataTables\ExportDataTable;
class dataController extends Controller
{
    public function forwarder()
    {
        $forwarders = Forwarder::get();

        return view('data.forwarder',compact('forwarders'));
    }

    public function successfull()
    {
        $successfulls = Successfull::get();
        return view('data.successfull',compact('successfulls'));
    }

    function datefilter(Request $request)
    {
     if(request()->ajax())
     {
      if(!empty($request->from_date))
      {
       $data = Forwarder::whereBetween('created_at', array($request->from_date, $request->to_date))->get();
      }
      else
      {
       $data = Forwarder::get();
      }
      return datatables()->of($data)->make(true);
     }
     return view('data.forwarder');
    }



    function datefilter2(Request $request)
    {
     if(request()->ajax())
     {
      if(!empty($request->from_date))
      {
       $data = Successfull::whereBetween('created_at', array($request->from_date, $request->to_date))->get();
      }
      else
      {
       $data = Successfull::get();
      }
      return datatables()->of($data)->make(true);
     }
     return view('data.successfull');
    }

    function successUpdate(Request $request){
        $request->validate([
            'id' => 'required',
            'orderId' => 'required',
        ]);


        $success =  Successfull::findOrFail($request->id);

        $success->shopify_order_id = $request->orderId;
        $success->status = $request->status;
        $success->save();

        return redirect()->back()->with('success', 'Shopify Order Id Updated');
    }

}
