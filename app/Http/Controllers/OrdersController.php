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

    public function view($id)
    {
        if ( $id == -1 ) {
            $order = request('orderNumber');
            try {
                $order = Order::where('orderNumber', $order)->where('user', auth()->user()->id)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                return view('order.oops');
            }
        } else {
            $order = Order::find($id);
        }

        $order = array('order'=>$order);
        return view('orders.view')->with($order);
    }

    public function list()
    {
        $orders = Order::userOrders();
        $orders = array('orders'=>$orders);
        return view('orders.list')->with($orders);
    }

    public function create()
    {
        $nextOrderNumber = Order::nextOrderNumber();
        $glasses = Glass::userGlasses();
        $foamcores = Foamcore::userFoamcores();
        $data = array('foamcores'=>$foamcores, 'glasses'=>$glasses, 'nextOrderNumber'=>$nextOrderNumber);
        return view('orders.create')->with($data);
    }

    public function edit($id)
    {
        if ( $id == -1 ) {
            $orderNumber = request('orderNumber');
            try {
                $order = Order::where('orderNumber', $orderNumber)->where('user', auth()->user()->id)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                return view('orders.oops');
            }
        } else {
            $order = Order::find($id);
        }

        $glasses = Glass::userGlasses();
        $foamcores = Foamcore::userFoamcores();
        $data = array('foamcores'=>$foamcores, 'glasses'=>$glasses, 'order'=>$order);
        return view('orders.edit')->with($data);
    }

    public function update($id)
    {
        $validationArray = Order::validationArray(request()->isReported, request()->isFrame, request()->secondMatNumberIsVisible, request()->thirdMatNumberIsVisible, request()->firstMatPresent);
        $validationCommentsArray = Order::validationCommentsArray(request()->isReported, request()->isFrame, request()->secondMatNumberIsVisible, request()->thirdMatNumberIsVisible, request()->firstMatPresent);
        request()->validate($validationArray, $validationCommentsArray);

        $order = Order::find($id);

        $order->customerFirst = request('customerFirst');
        $order->customerLast = request('customerLast');
        $order->customerEmail = request('customerEmail');
        $order->customerPhoneArea = request('customerPhoneArea');
        $order->customerPhone3 = request('customerPhone3');
        $order->customerPhone4 = request('customerPhone4');
        $order->orderNotes = request('orderNotes');

        if (!$order->isReported) {
            $order->orderFoamcoreType = request('orderFoamcoreType');
            $order->orderType = request('orderType');
            $order->orderWidth = request('orderWidth');
            $order->orderHeight = request('orderHeight');
            if (request()->isFrame) {
                if (request('firstMatNumber') != null) {
                    $order->orderFirstMatNumber = request('firstMatNumber');
                } else {
                    $order->orderFirstMatNumber = -1;
                }
                $order->orderMouldingNumber = request('orderMouldingNumber');
                $order->orderGlassType = request('orderGlassType');
                if (request()->secondMatNumberIsVisible) {
                    $order->orderSecondMatNumber = request('secondMatNumber');
                    if (request()->thirdMatNumberIsVisible) {
                        $order->orderThirdMatNumber = request('thirdMatNumber');
                    } else {
                        $order->orderThirdMatNumber = -1;
                    }
                } else {
                    $order->orderSecondMatNumber = -1;
                    $order->orderThirdMatNumber = -1;
                }
            } else {
                $order->orderFirstMatNumber = -1;
                $order->orderSecondMatNumber = -1;
                $order->orderThirdMatNumber = -1;
                $order->orderMouldingNumber = -1;
                $order->orderGlassType = -1;
            }
        }
        $order->save();
        return redirect('/orders');
    }

    public function store()
    {
        $processFirstMat = request('firstMatNumber') != null;
        $validationArray = Order::validationArray(0, request()->isFrame, request()->secondMatNumberIsVisible, request()->thirdMatNumberIsVisible, $processFirstMat, request()->firstMatPresent);
        $validationCommentsArray = Order::validationCommentsArray(0, request()->isFrame, request()->secondMatNumberIsVisible, request()->thirdMatNumberIsVisible, $processFirstMat, request()->firstMatPresent);
        request()->validate($validationArray, $validationCommentsArray);

        $order = new Order();
        $order->isReported = 0;
        $order->reportNumber = -1;
        $order->user = auth()->user()->id;
        $order->orderNumber = request('orderNumber');
        $order->customerFirst = request('customerFirst');
        $order->customerLast = request('customerLast');
        $order->customerEmail = request('customerEmail');
        $order->customerPhoneArea = request('customerPhoneArea');
        $order->customerPhone3 = request('customerPhone3');
        $order->customerPhone4 = request('customerPhone4');
        $order->orderNotes = request('orderNotes');
        $order->orderFoamcoreType = request('orderFoamcoreType');
        $order->orderType = request('orderType');
        $order->orderWidth = request('orderWidth');
        $order->orderHeight = request('orderHeight');
        if (request()->isFrame) {
            if (request('firstMatNumber') != null) {
                $order->orderFirstMatNumber = request('firstMatNumber');
            } else {
                $order->orderFirstMatNumber = -1;
            }
            $order->orderMouldingNumber = request('orderMouldingNumber');
            $order->orderGlassType = request('orderGlassType');
            if (request()->secondMatNumberIsVisible) {
                $order->orderSecondMatNumber = request('secondMatNumber');
                if (request()->thirdMatNumberIsVisible) {
                    $order->orderThirdMatNumber = request('thirdMatNumber');
                } else {
                    $order->orderThirdMatNumber = -1;
                }
            } else {
                $order->orderSecondMatNumber = -1;
                $order->orderThirdMatNumber = -1;
            }
        } else {
            $order->orderFirstMatNumber = -1;
            $order->orderSecondMatNumber = -1;
            $order->orderThirdMatNumber = -1;
            $order->orderMouldingNumber = -1;
            $order->orderGlassType = -1;
        }
        $order->save();
        return view('orders.index');
    }

    public function destroy($id)
    {
        Order::find($id)->delete();
        return redirect('/orders');
    }

}
