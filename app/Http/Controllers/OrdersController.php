<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use App\Order;
use App\Moulding;
use App\Glass;
use App\Foamcore;
use App\MatModel;
use Illuminate\Validation\Rule;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('orders.index');
    }

    public function create()
    {
        $nextOrderNumber = Order::nextOrderNumber();
        $glasses = Glass::userGlasses();
        $foamcores = Foamcore::userFoamcores();
        $data = array('foamcores'=>$foamcores, 'glasses'=>$glasses, 'nextOrderNumber'=>$nextOrderNumber);
        return view('orders.create')->with($data);
    }

    public function store()
    {
        $validationArray = [
            'customerFirst' => ['required'],
            'customerLast' => ['required'],
            'customerEmail' => ['required', 'email:rfc'],
            'customerPhoneArea' => ['required', 'digits:3'],
            'customerPhone3' => ['required', 'digits:3'],
            'customerPhone4' => ['required', 'digits:4'],
            'orderWidth' => ['required', 'numeric'],
            'orderHeight' => ['required', 'numeric'],
            'orderFoamcoreType' => ['required'],
        ];
        $validationCommentsArray = [
            'customerPhoneArea.required' => 'An area code is required.',
            'customerPhoneArea.digits' => 'The area code must be three digits.',
            'customerPhone3.required' => 'The first three digits of the phone number are required.',
            'customerPhone3.digits' => 'The first three digits of the phone number must be exactly three digits.',
            'customerPhone4.required' => 'The last four digits of the phone number are required.',
            'customerPhone4.digits' => 'The last part of the phone number must be exactly four digits.',
        ];
        if (request()->isFrame) {
            $mouldingNumbers = Moulding::mouldingNumbers();
            $matNumbers = MatModel::matNumbers();
            $validationArray += [
                'orderMouldingNumber' => ['required', 'numeric', Rule::in($mouldingNumbers)],
                'orderGlassType' => ['required'],
                'firstMatNumber' => ['numeric', Rule::in($matNumbers)]
            ];
            $validationCommentsArray += [
                'orderMouldingNumber.in' => 'The moulding number must exist.',
                'firstMatNumber.in' => 'The mat number must exist.',
                'firstMatNumber.numeric' => 'The mat number must be a number.',
            ];
            if (request()->secondMatNumberIsVisible) {
                $validationArray += [
                    'firstMatNumber' => ['required', 'numeric', Rule::in($matNumbers)],
                    'secondMatNumber' => ['required', 'numeric', Rule::in($matNumbers)]
                ];
                $validationCommentsArray += [
                    'firstMatNumber.required' => 'The mat number is required.',
                    'secondMatNumber.required' => 'The mat number is required.',
                    'secondMatNumber.in' => 'The mat number must exist.',
                    'secondMatNumber.numeric' => 'The mat number must be a number.',
                ];
                if (request()->thirdMatNumberIsVisible) {
                    $validationArray += [
                        'thirdMatNumber' => ['required', 'numeric', Rule::in($matNumbers)],
                    ];
                    $validationCommentsArray += [
                        'thirdMatNumber.required' => 'The mat number is required.',
                        'thirdMatNumber.in' => 'The mat number must exist.',
                        'thirdMatNumber.numeric' => 'The mat number must be a number.',
                    ];
                }
            }
        }
        request()->validate($validationArray,$validationCommentsArray);


        dd(request()->all());
        return view('orders.index');
    }

}
