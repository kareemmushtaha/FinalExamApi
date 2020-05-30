<?php


namespace App\Repositories;


use App\Models\Product;
use App\User;
use http\Env\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class UserRepositories implements UserInterface
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
     * @return \Illuminate\Support\Collection
     */
    public function getUsers()
    {
        $GetUser = DB::table('users')
            ->select('id', 'name', 'email', 'age', 'password')
            ->get();
        return $GetUser;
    }

    /**
     * @return \Illuminate\Support\Collection
     */

    public function getDetailsUser()
    {
        $Login = auth('api')->user()->id;
        $userInformation = DB::table('users')
            ->where('id', $Login)
            ->select('name', 'email', 'age')
            ->get();

        return $this->sendResponse($userInformation, 'information user success');
    }

    /**
     * @return \Illuminate\Support\Collection
     */

    public function getDetailsAdmins()
    {
        $Login = auth('admin')->user()->id;
        $userInformation = DB::table('admins')
            ->where('id', $Login)
            ->select('name', 'email', 'password')
            ->get();

        return $this->sendResponse($userInformation, 'information admin success');

    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function getProductUser()
    {
        $Login = auth('api')->user()->id;

        $userInformation = DB::table('order')
            ->join('product', 'order.product_id', '=', 'product.id')
            ->where('user_id', $Login)
            ->select('product_id', 'state_id', 'product.name', 'product.salary')
            ->get();

        return $this->sendResponse($userInformation, 'You Are Have This Product Just ');

    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUserById($id)
    {
        try {
            $User = User::select('id','name','email','age')->findOrFail($id);
            return $this->sendResponse($User, 'Found User Success ');
        }catch (ModelNotFoundException $modelNotFoundException){
            return $this->sendError('Error Not Found User');
        }
    }

    /**
     * @param null $userId
     * @return \Illuminate\Http\JsonResponse
     */

    public function getProductByUserId($userId = null)
    {
        $Product = [];
        $Product = DB::table('users as u')
            ->join('product as p', 'p.user_id', '=', 'u.id')
            ->where('u.id', $userId)
            ->select('p.description as productDescription', 'p.name as productName',
                'u.email as UserEmail', 'u.name as UserName')
            ->get();
        return response()->json($Product);
    }


    /**
     * @param $id
     */

    // Delete Users By Product Id
    public function RemoveUsers($id)
    {
        $users = DB::table('users')
            ->where('id', $id)
            ->select('p.description as productDescription', 'p.name as productName')
            ->delete();
        dd($users);
    }

}
