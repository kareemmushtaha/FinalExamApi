<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface ProductInterface
{
    /**
     * @return mixed
     */
    public function getProduct();

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getProductById($id);


    /**
     * @param $id
     * @return mixed
     */
    public function RemoveProduct($id);


    /**
     * @return mixed
     */
    public function getDeletedProduct();

    /**
     * @param $id
     */

    public function ForceRemoveProduct($id);



        /**
         * @param Request $request
         */
    public function insertProduct(Request $request);

    /**
     * @param Request $request
     * @param $id
     */
    public function updateProduct(Request $request, $id);

}
