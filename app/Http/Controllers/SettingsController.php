<?php

namespace App\Http\Controllers;

use App\Models\EmailSetting;
use App\Models\GeneralSetting;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SettingsController extends Controller
{

    //--------------------General Setting Start----------------------
    public function gsettingindex(){
        $dataInfo = GeneralSetting::first();
        $timeZones=Helper::TimeZones();
        return view('backend.settings.generalSettings',compact('dataInfo','timeZones'));
    }

    public function gsettingupdate(Request $request){

        $validator = Validator::make($request->all(), [
            'appname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required',
            'logo' => 'required',
            'favicon' => 'required',
            'address' => 'required',
            'timezone' => 'required',
            'currency' => 'required',
            'expiryalert' => 'required',
            'lowstockalert' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
            'favicon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max

        ]);

        $dataInfo = GeneralSetting::findOrFail($request->dataId);
        $dataInfo->appname = $request->appname;
        $dataInfo->email = $request->email;
        $dataInfo->phone = $request->phone;
        $dataInfo->address = $request->address;
        $dataInfo->timezone = $request->timezone;
        $dataInfo->currency = $request->currency;
        $dataInfo->expiryalert = $request->expiryalert;
        $dataInfo->lowstockalert = $request->lowstockalert;

        if ($request->hasFile('logo')) {

            if ($dataInfo->logo && file_exists(public_path('uploads/images/settings/' . $dataInfo->logo))) {
                unlink(public_path('uploads/images/settings/' . $dataInfo->logo));
            }

            $logo = $request->file('logo');
            $logoName = uniqid() . '.' . $logo->getClientOriginalExtension();
            $logoPath = public_path('uploads/images/settings');
            $logo->move($logoPath,$logoName);
            $logoManager = new ImageManager(new Driver());
            $file = $logoManager->read($logoPath.'/'.$logoName);
            $file->resize(328,276);
            $file->save();
            $dataInfo->logo = ($logoName);
        }

        if ($request->hasFile('favicon')) {

            if ($dataInfo->favicon && file_exists(public_path('uploads/images/settings/' . $dataInfo->favicon))) {
                unlink(public_path('uploads/images/settings/' . $dataInfo->favicon));
            }

            $favicon = $request->file('favicon');
            $favName = uniqid() . '.' . $favicon->getClientOriginalExtension();
            $path = public_path('uploads/images/settings');
            $favicon->move($path,$favName);
            $favManager = new ImageManager(new Driver());
            $image = $favManager->read($path.'/'.$favName);
            $image->resize(60,60);
            $image->save();
            $dataInfo->favicon = ($favName);
        }
        $dataInfo->update();
        return redirect()->back()->with('success', 'Setting updated successfully.');
    }

    //--------------------Email Setting Start----------------------

    public function emailsettingindex(){
        $dataInfo = EmailSetting::first();
        return view('backend.settings.emailSettings',compact('dataInfo'));
    }

    public function emailsettingupdate(Request $request){

        $validator = Validator::make($request->all(), [
            'mail_driver' => 'required|string|max:255',
            'mail_host' => 'required|string|email|max:255',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_password' => 'required',
            'mail_encryption' => 'required',
            'mail_from_address' => 'required',
            'mail_from_name' => 'required',

        ]);
        $dataInfo = EmailSetting::findOrFail($request->dataId);
        $dataInfo->mail_driver = $request->mail_driver;
        $dataInfo->mail_host = $request->mail_host;
        $dataInfo->mail_port = $request->mail_port;
        $dataInfo->mail_username = $request->mail_username;
        $dataInfo->mail_password = $request->mail_password;
        $dataInfo->mail_encryption = $request->mail_encryption;
        $dataInfo->mail_from_address = $request->mail_from_address;
        $dataInfo->mail_from_name = $request->mail_from_name;
        $dataInfo->update();
        return redirect()->back()->with('success', 'Setting updated successfully.');
    }

}
