<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\PaymenMethod;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    public function index(){
        $dataList = Purchase::with('supplier','details.medicine')->paginate(100);
        // dd($dataList);
        return view('backend.purchase.index',compact('dataList'));
    }

    public function create(){
        $suppliers=Supplier::all();
        $month = date('m');
        $day = date('d');
        $year = date('Y');

        $lastData=Purchase::latest()->first();
        if($lastData){
            $number = $lastData->id;
        }else{
            $number = 1;
        }

        $today = $year . '-' . $month . '-' . $day;
        $invoice = 'INVP'.$year . $month.str_pad($number, 4,'0',STR_PAD_LEFT);
        $medicines = Medicine::all();
        $methods = PaymenMethod::all();
        return view('backend.purchase.create',compact('suppliers','today','invoice','medicines','methods'));
    }

    public function search_medicine(Request $request)
    {
        $query = $request->get('query');
        $medicines = Medicine::with('supplier')->where('name', 'like', '%'.$query.'%')
                            ->orWhere('genericname', 'like', '%'.$query.'%')
                            ->get();

        return response()->json($medicines);
    }

    public function addToCart(Request $request)
    {
        $medicine = Medicine::with('supplier')->find($request->medicine_id);

        if (!$medicine) {
            return response()->json(['error' => 'Medicine not found'], 404);
        }

        $cart = session()->get('cart', []);

        $cart[$medicine->id] = [
            'id' => $medicine->id,
            'name' => $medicine->name,
            'genericname' => $medicine->genericname,
            'supplier_name' => $medicine->supplier->name,
            'image' => $medicine->image,
        ];

        session()->put('cart', $cart);
        return response()->json(['success' => 'Medicine added to cart', 'cart' => $cart]);
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[$request->medicine_id]);
        session()->put('cart', $cart);

        return response()->json(['success' => 'Medicine removed from cart', 'cart' => $cart]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'invoice_date' => 'required',
            'invoice_no' => 'required',
            'supplierId' => 'required',
            'expiry_date' => 'required',
            'sell_price' => 'required',
            'buy_price' => 'required',
            'qty' => 'required',
            'subtotal' => 'required',
            'discount' => 'required',
            'total' => 'required',
            'grand_total' => 'required',
            'invoice_discount' => 'required',
            'discount_type' => 'required',
            'payable_total' => 'required',
            'paid_amount' => 'required',
            'due_amount' => 'required',
            'paymentId' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        $purchase=Purchase::create([
            'invoice_date' => $request->invoice_date,
            'invoice_no' => $request->invoice_no,
            'supplierId' => $request->supplierId,
            'grand_total' => $request->grand_total,
            'invoice_discount' => $request->invoice_discount,
            'discount_type' => $request->discount_type,
            'payable_total' => $request->payable_total,
            'paid_amount' => $request->paid_amount,
            'due_amount' => $request->due_amount,
            'paymentId' => $request->paymentId,
        ]);

        if($purchase){
            foreach($request->medicineId as $key=>$med){
                $purchaseDetails = PurchaseDetails::create([
                    'medicineId' => $med,
                    'purchaseId' => $purchase->id,
                    'expiry_date' => $request->expiry_date[$key],
                    'sell_price' => $request->sell_price[$key],
                    'buy_price' => $request->buy_price[$key],
                    'qty' => $request->qty[$key],
                    'subtotal' => $request->subtotal[$key],
                    'discount' => $request->discount[$key],
                    'total' => $request->total[$key],
                ]);

                Stock::create([
                    'medicineId' => $med,
                    'ref_id' => $purchase->id,
                    'date' => $request->invoice_date,
                    'inv_no' => $request->invoice_no,
                    'qty' => $request->qty[$key],
                    'type' => 'purchase',
                    'updated_by' => Auth::user()->id,
                ]);
            }
        }
        DB::commit();
        Session::forget('cart');
        return redirect()->back()->with('success', 'New Purchase Created.');
    }

    public function details($id)
    {
        $details = PurchaseDetails::with('medicine')->where('purchaseId', $id)->get();
        return response()->json($details);
    }
    public function returnItem($id){
        $dataInfo= Purchase::with('details','details.medicine','details.medicine.supplier')->find($id);
        $suppliers=Supplier::all();
        $methods = PaymenMethod::all();
        return view('backend.purchase.return',compact('dataInfo','suppliers','methods'));
    }

    public function storeReturnItem(Request $request){
        $validator = Validator::make($request->all(), [
            'invoice_date' => 'required',
            'invoice_no' => 'required',
            'supplierId' => 'required',
            'expiry_date' => 'required',
            'sell_price' => 'required',
            'buy_price' => 'required',
            'qty' => 'required',
            'subtotal' => 'required',
            'discount' => 'required',
            'total' => 'required',
            'grand_total' => 'required',
            'invoice_discount' => 'required',
            'discount_type' => 'required',
            'payable_total' => 'required',
            'paid_amount' => 'required',
            'due_amount' => 'required',
            'paymentId' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        $purchase= Purchase::find($request->dataId);
        $purchase->update([
            'invoice_date' => $request->invoice_date,
            'invoice_no' => $request->invoice_no,
            'supplierId' => $request->supplierId,
            'grand_total' => $request->grand_total,
            'invoice_discount' => $request->invoice_discount,
            'discount_type' => $request->discount_type,
            'payable_total' => $request->payable_total,
            'paid_amount' => $request->paid_amount,
            'due_amount' => $request->due_amount,
            'paymentId' => $request->paymentId,
        ]);

        if($purchase){

            $deleteFlag = PurchaseDetails::where('purchaseId',$purchase->id)->delete();
            $stockDelete = Stock::where('ref_id',$purchase->id)->where('type','purchase')->delete();

            if($deleteFlag && $stockDelete)
            foreach($request->medicineId as $key=>$med){
                $purchaseDetails = PurchaseDetails::create([
                    'medicineId' => $med,
                    'purchaseId' => $purchase->id,
                    'expiry_date' => $request->expiry_date[$key],
                    'sell_price' => $request->sell_price[$key],
                    'buy_price' => $request->buy_price[$key],
                    'qty' => $request->qty[$key],
                    'subtotal' => $request->subtotal[$key],
                    'discount' => $request->discount[$key],
                    'total' => $request->total[$key],
                ]);
            }
            Stock::create([
                'medicineId' => $med,
                'ref_id' => $purchase->id,
                'date' => $request->invoice_date,
                'inv_no' => $request->invoice_no,
                'qty' => $request->qty[$key],
                'type' => 'purchase',
                'updated_by' => Auth::user()->id,
            ]);
        }
        DB::commit();
        return redirect()->back()->with('success', 'Purchase Modified Successfully!.');
    }

    public function delete($id){

        $detilsdeleteFlag = PurchaseDetails::where('purchaseId',$id)->delete();

        if($detilsdeleteFlag){
            $stockDelete = Stock::where('ref_id',$id)->where('type','purchase')->delete();
        }

        if($stockDelete){
            $deleteFlag = Purchase::where('id',$id)->delete();
        }

        if($deleteFlag){
            return redirect()->back()->with('success', 'Purchase Deleted Successfully!.');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!.');
        }
        
        
        
    }
}
