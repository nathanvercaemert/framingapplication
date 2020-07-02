<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use App\Moulding;
use App\Vendor;
use Illuminate\Validation\Rule;

class MouldingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('mouldings.index');
    }

    public function view($id)
    {
        if ( $id == -1 ) {
            $mouldingNumber = request('mouldingNumber');
            try {
                $moulding = Moulding::where('mouldingNumber', $mouldingNumber)->where('user', auth()->user()->id)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                return view('mouldings.oops');
            }
        } else {
            $moulding = Moulding::find($id);
        }

        $moulding = array('moulding'=>$moulding);
        return view('mouldings.view')->with($moulding);
    }

    public function list()
    {
        $mouldings = Moulding::userMouldings();
        $mouldings = array('mouldings'=>$mouldings);
        return view('mouldings.list')->with($mouldings);
    }

    public function create()
    {
        $vendors = Vendor::userVendors();
        $vendors = array('vendors'=>$vendors);
        return view('mouldings.create')->with($vendors);
    }

    public function edit($id)
    {
        if ( $id == -1 ) {
            $mouldingNumber = request('mouldingNumber');
            try {
                $moulding = Moulding::where('mouldingNumber', $mouldingNumber)->where('user', auth()->user()->id)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                return view('mouldings.oops');
            }
        } else {
            $moulding = Moulding::find($id);
        }

        $vendors = Vendor::userVendors();
        $data = array('vendors'=>$vendors, 'moulding'=>$moulding);
        return view('mouldings.edit')->with($data);
    }

    public function update($id)
    {
        request()->validate([
            'mouldingVendor' => ['required'],
            'mouldingPrice' => ['required', 'numeric']
        ]);

        $moulding = Moulding::find($id);

        $moulding->mouldingVendor = request('mouldingVendor');
        $moulding->mouldingPrice = request('mouldingPrice');
        $moulding->save();

        return redirect('/mouldings');
    }

    public function store()
    {
        $mouldingNumbers = Moulding::mouldingNumbers();
        request()->validate([
            'mouldingNumber' => ['required', Rule::notIn($mouldingNumbers)],
            'mouldingVendor' => ['required'],
            'mouldingPrice' => ['required', 'numeric']
        ],
        [
            'mouldingNumber.not_in' => 'There already exists a moulding with that number. The moulding number must be unique.',
        ]);

        $moulding = new Moulding();
        $moulding->mouldingNumber = request('mouldingNumber');
        $moulding->mouldingVendor = request('mouldingVendor');
        $moulding->mouldingPrice = request('mouldingPrice');
        $moulding->user = auth()->user()->id;
        $moulding->save();
        return view('mouldings.index');
    }

    public function destroy($id)
    {
        Moulding::find($id)->delete();
        return redirect('/mouldings');
    }
}
