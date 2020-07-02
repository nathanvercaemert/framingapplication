<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\Glass;
use Illuminate\Validation\Rule;

class GlassesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $glasses = Glass::userGlasses();
        $glasses = array('glasses'=>$glasses);
        return view('glasses.index')->with($glasses);
    }

    public function view($id)
    {
        if ( $id == -1 ) {
            $glassType = request('glassType');
            $glass = Glass::where('glassType', $glassType)->where('user', auth()->user()->id)->firstOrFail();
        } else {
            $glass = Glass::find($id);
        }

        $glass = array('glass'=>$glass);
        return view('glasses.view')->with($glass);
    }

    public function list()
    {
        $glasses = Glass::userGlasses();
        $glasses = array('glasses'=>$glasses);
        return view('glasses.list')->with($glasses);
    }

    public function create()
    {
        $vendors = Vendor::userVendors();
        $vendors = array('vendors'=>$vendors);
        return view('glasses.create')->with($vendors);
    }

    public function edit($id)
    {

        if ( $id == -1 ) {
            $glassType = request('glassType');
            $glass = Glass::where('glassType', $glassType)->where('user', auth()->user()->id)->firstOrFail();
        } else {
            $glass = Glass::find($id);
        }

        $vendors = Vendor::userVendors();
        $data = array('vendors'=>$vendors, 'glass'=>$glass);
        return view('glasses.edit')->with($data);
    }

    public function update($id)
    {
        request()->validate([
            'glassVendor' => ['required'],
            'glassPrice' => ['required', 'numeric']
        ]);

        $glass = Glass::find($id);

        $glass->glassVendor = request('glassVendor');
        $glass->glassPrice = request('glassPrice');
        $glass->save();

        return redirect('/glasses');
    }

    public function store()
    {
        $glassTypes = Glass::glassTypes();
        request()->validate([
            'glassType' => ['required', Rule::notIn($glassTypes)],
            'glassVendor' => ['required'],
            'glassPrice' => ['required', 'numeric']
        ],
        [
            'glassType.not_in' => 'There already exists a glass with that type. The glass type must be unique.',
        ]);

        $glass = new Glass();
        $glass->glassType = request('glassType');
        $glass->glassVendor = request('glassVendor');
        $glass->glassPrice = request('glassPrice');
        $glass->user = auth()->user()->id;
        $glass->save();

        $glasses = Glass::userGlasses();
        $glasses = array('glasses'=>$glasses);
        return view('glasses.index')->with($glasses);
    }

    public function destroy($id)
    {
        Glass::find($id)->delete();
        return redirect('/glasses');
    }
}
