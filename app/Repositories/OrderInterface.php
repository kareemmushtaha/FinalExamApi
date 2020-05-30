<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface OrderInterface
{
    /**
     * @param Request $request
     */
    public function insertOrder(Request $request);


    /**
     * @return mixed
     */
    public function getOrder();

    /**
     * @param $id
     */

    public function DeleteOrder($id);


    /**
     * @param Request $request
     * @param $id
     */
    public function updateStatusOrder(Request $request, $id);
}
