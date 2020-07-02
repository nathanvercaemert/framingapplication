<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use Illuminate\Validation\Rule;

class VendorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vendors = Vendor::userVendors();
        $vendors = array('vendors'=>$vendors);
        return view('vendors.index')->with($vendors);
    }

    public function view($id)
    {
        if ( $id == -1 ) {
            $vendor = request('vendor');
            $vendor = Vendor::where('vendor', $vendor)->where('user', auth()->user()->id)->firstOrFail();
        } else {
            $vendor = Vendor::find($id);
        }

        $vendor = array('vendor'=>$vendor);
        return view('vendors.view')->with($vendor);
    }

    public function list()
    {
        $vendors = Vendor::userVendors();
        $vendors = array('vendors'=>$vendors);
        return view('vendors.list')->with($vendors);
    }

    public function create()
    {
        return view('vendors.create');
    }

    public function store()
    {
        $vendorNames = Vendor::vendorNames();
        request()->validate([
            'vendor' => ['required', Rule::notIn($vendorNames)],
        ],
        [
            'vendor.not_in' => 'There already exists a vendor with that name. The vendor name must be unique.',
        ]);

        $vendor = new Vendor();
        $vendor->vendor = request('vendor');
        if ( request('vendorNotes') != null ) {
            $vendor->vendorNotes = request('vendorNotes');
        } else {
            $vendor->vendorNotes = "";
        }
        $vendor->user = auth()->user()->id;
        $vendor->save();

        $vendors = Vendor::userVendors();
        $vendors = array('vendors'=>$vendors);
        return view('vendors.index')->with($vendors);
    }

    public function edit($id)
    {
        if ( $id == -1 ) {
            $vendor = request('vendor');
            $vendor = Vendor::where('vendor', $vendor)->where('user', auth()->user()->id)->firstOrFail();
        } else {
            $vendor = Vendor::find($id);
        }

        $vendor = array('vendor'=>$vendor);
        return view('vendors.edit')->with($vendor);
    }

    public function update($id)
    {
        $vendor = Vendor::find($id);

        if ( request('vendorNotes') != null ) {
            $vendor->vendorNotes = request('vendorNotes');
        } else {
            $vendor->vendorNotes = "";
        }
        $vendor->save();

        $vendors = Vendor::userVendors();
        $vendors = array('vendors'=>$vendors);
        return view('vendors.index')->with($vendors);
    }

    public function destroy($id)
    {
        Vendor::find($id)->delete();

        $vendors = Vendor::userVendors();
        $vendors = array('vendors'=>$vendors);
        return view('vendors.index')->with($vendors);
    }
}
