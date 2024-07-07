<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Leaf;
use App\Models\Medicine;
use App\Models\Supplier;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class MedicineController extends Controller
{
    public function index()
    {
        $dataList = Medicine::with('supplier')->paginate(100);
        return view('backend.medicine.index', compact('dataList'));
    }

    public function create()
    {
        $suppliers = Supplier::get();
        $categories = Category::get();
        $vendors = Vendor::get();
        $leaves = Leaf::get();
        return view('backend.medicine.create', compact('suppliers','categories','vendors','leaves'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'leafId' => 'required',
            'categoryId' => 'required',
            'vendorId' => 'required',
            'supplierId' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/images/medicine');
            $image->move($imagePath,$imageName);
            $logoManager = new ImageManager(new Driver());
            $file = $logoManager->read($imagePath.'/'.$imageName);
            $file->resize(1000,1000);
            $file->save();
        }else{
            $imageName='default.png';
        }

        Medicine::create([
            'qrcode' => $request->qrcode,
            'hnscode' => $request->hnscode,
            'name' => $request->name,
            'strength' => $request->strength,
            'genericname' => $request->genericname,
            'shelf' => $request->shelf,
            'desc' => $request->desc,
            'igta' => $request->igta,
            'status' => $request->status,
            'leafId' => $request->leafId,
            'categoryId' => $request->categoryId,
            'vendorId' => $request->vendorId,
            'supplierId' => $request->supplierId,
            'image' => $imageName,
        ]);

        return redirect()->back()->with('success', 'Medicine created successfully.');
    }

    public function edit($id)
    {
        $dataInfo = Medicine::findOrFail($id);
        $suppliers = Supplier::get();
        $categories = Category::get();
        $vendors = Vendor::get();
        $leaves = Leaf::get();
        
        return view('backend.medicine.edit', compact('dataInfo','suppliers','categories','vendors','leaves'));
    }

    public function update(Request $request)
    {
        $dataId=  $request->dataId;
        $medicine = Medicine::find($dataId);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'leafId' => 'required',
            'categoryId' => 'required',
            'vendorId' => 'required',
            'supplierId' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {

            if ($medicine->image && file_exists(public_path('uploads/images/medicine/' . $medicine->image))) {
                unlink(public_path('uploads/images/medicine/' . $medicine->image));
            }

            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/images/medicine');
            $image->move($imagePath,$imageName);
            $logoManager = new ImageManager(new Driver());
            $file = $logoManager->read($imagePath.'/'.$imageName);
            $file->resize(1000,1000);
            $file->save();
        }else{
            $imageName=$medicine->image;
        }

        $medicine->update([
            'qrcode' => $request->qrcode,
            'hnscode' => $request->hnscode,
            'name' => $request->name,
            'strength' => $request->strength,
            'genericname' => $request->genericname,
            'shelf' => $request->shelf,
            'desc' => $request->desc,
            'igta' => $request->igta,
            'status' => $request->status,
            'leafId' => $request->leafId,
            'categoryId' => $request->categoryId,
            'vendorId' => $request->vendorId,
            'supplierId' => $request->supplierId,
            'image' => $imageName,
        ]);
        return redirect()->back()->with('success', 'Medicine updated successfully.');
    }

    public function destroy($id)
    {
        Medicine::destroy($id);
        return redirect()->route('medicine.index')->with('success', 'Medicine deleted successfully.');
    }
}
