<?php


namespace App\Repositories;


use App\Models\Product;
use http\Env\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use MongoDB\Driver\Exception\AuthenticationException;


class ProductRepositories implements ProductInterface
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
     * @return mixed
     */
    public function getProduct()
    {
        $product = DB::table('product')
            ->whereNull('deleted_at')
            ->select('name', 'salary', 'description')
            ->get();
        return $this->sendResponse($product, 'Found  All  Product successfully ');

    }

    /**
     *Rules insert the product
     */
    private function rules($id = null)
    {
        return [
            'name' => 'required|max:50',
            'description' => 'required',
            'salary' => 'required|integer',
        ];
    }

    /**
     * @param Request $request
     */
    public function insertProduct(Request $request)
    {

        $validation = validator::make($request->all(), $this->rules());
        if ($validation->fails()) {
            return $validation->errors();
        }
        $Product = new Product();
        $Product->name = $request->get('name');
        $Product->salary = $request->get('salary');
        $Product->description = $request->get('description');
        $Product->save();
        return $this->sendResponse($Product, 'Save Product Success ');
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function updateProduct(Request $request, $id)
    {
        $validation = validator::make($request->all(), $this->rules());
        if ($validation->fails()) {
            return $validation->errors();
        }

        try {
            $product = Product::select('id','name','description','salary')->findOrFail($id);
            $product->update([
                'name' =>$request->get('name') ,
                'salary' => $request->get('salary'),
                'description' => $request->get('description'),
            ]);
            return $this->sendResponse($product, 'success update Product');

        }catch (ModelNotFoundException $modelNotFoundException){
            return $this->sendError('Not Found Product Id');
        }
    }


    /**
     * @param $id
     * @return Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getProductById($id)
    {
        try {
            $product = Product::select('id', 'name', 'salary', 'description')->findOrFail($id);
            return $this->sendResponse($product, 'Find Product Success ');
        } catch (ModelNotFoundException $modelNotFoundException) {
            return $this->sendError('Not Found Product Id');
        }

    }

    /**
     * @param $id
     */

    public function RemoveProduct($id)
    {
        $Product = Product::find($id);
        $Product->delete();
        return $Product;
    }

    /**
     * @param $id
     */

    public function ForceRemoveProduct($id)
    {
        $Product = Product::find($id);
        $Product->forceDelete();
        return $Product;
    }

    /**
     * @return mixed
     */
    public function getDeletedProduct()
    {
        return $product = Product::onlyTrashed()->get();
    }

}
