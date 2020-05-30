<?php

namespace App\Http\Controllers;

use App\Repositories\OrderInterface;
use Illuminate\Http\Request;
use  App\Order;

class OrderController extends Controller
{

    protected $Order;

    public function __construct(OrderInterface $Order)
    {
        $this->Order = $Order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Order = $this->Order->getOrder();
        return $Order;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Order = $this->Order->insertOrder($request);
        return $Order;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateOrder = $this->Order->updateStatusOrder($request,$id);
        return $updateOrder;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $Order = $this->Order->DeleteOrder($id);
        return $this->sendResponse($Order,'success delete order');
    }

}
