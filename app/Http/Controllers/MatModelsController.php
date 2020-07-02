<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\MatModel;
use Illuminate\Validation\Rule;

class MatModelsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('mats.index');
    }

    public function view($id)
    {
        if ( $id == -1 ) {
            $matNumber = request('matNumber');
            try {
                $mat = MatModel::where('matNumber', $matNumber)->where('user', auth()->user()->id)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                return view('mats.oops');
            }
        } else {
            $mat = MatModel::find($id);
        }

        $mat = array('mat'=>$mat);
        return view('mats.view')->with($mat);
    }

    public function list()
    {
        $mats = MatModel::userMats();
        $mats = array('mats'=>$mats);
        return view('mats.list')->with($mats);
    }

    public function create()
    {
        $vendors = Vendor::userVendors();
        $vendors = array('vendors'=>$vendors);
        return view('mats.create')->with($vendors);
    }

    public function edit($id)
    {
        if ( $id == -1 ) {
            $matNumber = request('matNumber');
            try {
                $mat = MatModel::where('matNumber', $matNumber)->where('user', auth()->user()->id)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                return view('mats.oops');
            }
        } else {
            $mat = MatModel::find($id);
        }

        $vendors = Vendor::userVendors();
        $data = array('vendors'=>$vendors, 'mat'=>$mat);
        return view('mats.edit')->with($data);
    }

    public function update($id)
    {
        request()->validate([
            'matVendor' => ['required'],
            'matPrice' => ['required', 'numeric']
        ]);

        $mat = MatModel::find($id);

        $mat->matVendor = request('matVendor');
        $mat->matPrice = request('matPrice');
        $mat->save();

        return redirect('/mats');
    }

    public function store()
    {
        $matNumbers = MatModel::matNumbers();
        request()->validate([
            'matNumber' => ['required', Rule::notIn($matNumbers)],
            'matVendor' => ['required'],
            'matPrice' => ['required', 'numeric']
        ],
        [
            'matNumber.not_in' => 'There already exists a mat with that number. The mat number must be unique.',
        ]);

        $mat = new MatModel();
        $mat->matNumber = request('matNumber');
        $mat->matVendor = request('matVendor');
        $mat->matPrice = request('matPrice');
        $mat->user = auth()->user()->id;
        $mat->save();

        return view('mats.index');
    }

    public function destroy($id)
    {
        Mat::find($id)->delete();
        return redirect('/mats');
    }
}
