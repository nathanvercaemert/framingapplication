<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\Foamcore;
use Illuminate\Validation\Rule;

class FoamcoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $foamcores = Foamcore::userFoamcores();
        $foamcores = array('foamcores'=>$foamcores);
        return view('foamcores.index')->with($foamcores);
    }

    public function view($id)
    {
        if ( $id == -1 ) {
            $foamcoreType = request('foamcoreType');
            $foamcore = Foamcore::where('foamcoreType', $foamcoreType)->where('user', auth()->user()->id)->firstOrFail();
        } else {
            $foamcore = Foamcore::find($id);
        }

        $foamcore = array('foamcore'=>$foamcore);
        return view('foamcores.view')->with($foamcore);
    }

    public function list()
    {
        $foamcores = Foamcore::userFoamcores();
        $foamcores = array('foamcores'=>$foamcores);
        return view('foamcores.list')->with($foamcores);
    }

    public function create()
    {
        $vendors = Vendor::userVendors();
        $vendors = array('vendors'=>$vendors);
        return view('foamcores.create')->with($vendors);
    }

    public function edit($id)
    {

        if ( $id == -1 ) {
            $foamcoreType = request('foamcoreType');
            $foamcore = Foamcore::where('foamcoreType', $foamcoreType)->where('user', auth()->user()->id)->firstOrFail();
        } else {
            $foamcore = Foamcore::find($id);
        }

        $vendors = Vendor::userVendors();
        $data = array('vendors'=>$vendors, 'foamcore'=>$foamcore);
        return view('foamcores.edit')->with($data);
    }

    public function update($id)
    {
        request()->validate([
            'foamcoreVendor' => ['required'],
            'foamcorePrice' => ['required', 'numeric']
        ]);

        $foamcore = Foamcore::find($id);

        $foamcore->foamcoreVendor = request('foamcoreVendor');
        $foamcore->foamcorePrice = request('foamcorePrice');
        $foamcore->save();

        return redirect('/foamcores');
    }

    public function store()
    {
        $foamcoreTypes = Foamcore::foamcoreTypes();
        request()->validate([
            'foamcoreType' => ['required', Rule::notIn($foamcoreTypes)],
            'foamcoreVendor' => ['required'],
            'foamcorePrice' => ['required', 'numeric']
        ],
        [
            'foamcoreType.not_in' => 'There already exists a foamcore with that type. The foamcore type must be unique.',
        ]);

        $foamcore = new Foamcore();
        $foamcore->foamcoreType = request('foamcoreType');
        $foamcore->foamcoreVendor = request('foamcoreVendor');
        $foamcore->foamcorePrice = request('foamcorePrice');
        $foamcore->user = auth()->user()->id;
        $foamcore->save();

        $foamcores = Foamcore::userFoamcores();
        $foamcores = array('foamcores'=>$foamcores);
        return view('foamcores.index')->with($foamcores);
    }

    public function destroy($id)
    {
        Foamcore::find($id)->delete();
        return redirect('/foamcores');
    }
}
