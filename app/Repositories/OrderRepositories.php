<?php


namespace App\Repositories;


use App\BaseModel;
use App\Models\order;


use http\Env\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderRepositories implements OrderInterface
{
    public function sendResponse($result, $message)
    {
        $response = [
            'code' => 200,
            'success' => true,
            'data' => $result,
            'message' => $message
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'code' => 404,
            'success' => false,
            'message' => $error
        ];
        if (!empty($errorMessages)) {

            $response['date'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    /**
     *Rules insert the product
     */
    private function rules($id = null)
    {
        return [
            'product_id' => 'required|integer',
            'state_id' => 'required|integer',
        ];
    }

    /**
     * @param Request $request
     */
    public function insertOrder(Request $request)
    {
        $validation = validator::make($request->all(), $this->rules());
        if ($validation->fails()) {
            return $validation->errors();
        }
        $Order = new order();
        $Order->product_id = $request->get('product_id');
        $Order->state_id = $request->get('state_id');
        $Order->user_id = Auth::user()->id;
        $Order->save();
        return $this->sendResponse($Order, 'Save Order Success ');
    }

    /**
     * @return mixed
     */

    public function getOrder()
    {
        $Order = DB::table('order')
            ->select('product_id', 'user_id', 'state_id')
            ->get();
        return $this->sendResponse($Order, 'Found  All  Order successfully ');
    }

    /**
     * @param $id
     */

    public function DeleteOrder($id)
    {
        $order = order::find($id);
        $order->delete();
        return $order;
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function updateStatusOrder(Request $request, $id)
    {
        $validation = validator::make($request->all(), $this->rules());
        if ($validation->fails()) {
            return $validation->errors();
        }

        try {
            $Order = order::select('id', 'product_id', 'user_id', 'state_id')->findOrFail($id);
            $Order->update([
                'state_id' => $request->get('state_id'),
                'product_id' => $request->get('product_id'),
            ]);
            return $this->sendResponse($Order, ' Update Order Successfully');

        } catch (ModelNotFoundException $modelNotFoundException) {
            return $this->sendError('Not Found Order Id');
        }
    }

}
