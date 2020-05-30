<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\User;

use App\Repositories\ProductInterface;

use Illuminate\Http\Request;



class ProductController extends Controller
{
    protected $Product;

    public function __construct(ProductInterface $Product)
    {
        $this->Product = $Product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->Product->getProduct();

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductUser()
    {


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

        $Maker = $this->Product->insertProduct($request);
        return $Maker;

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $Maker = $this->Product->getProductById($id);
       return $Maker;


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = $this->Product->updateProduct($request,$id);
        return $update;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $product = $this->Product->RemoveProduct($id);
        return $this->sendResponse($product, "Soft Delete product name : ($product->name) ");

    }

    public function destroyForce($id)
    {
        $product = $this->Product->ForceRemoveProduct($id);
        return $this->sendResponse($product, "force Delete product name : ($product->name)");

    }


    public function getDeletedProduct()
    {

        $product = $this->Product->getDeletedProduct();
        return $this->sendResponse($product, ' This All Product Deleted ');

    }

}
