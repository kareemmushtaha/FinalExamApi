<?php

namespace App\Http\Controllers;

use App\Repositories\UserInterface;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $users;

    public function __construct(UserInterface $users)
    {
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  $this->users->getUsers();
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
    public function store()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->users->getUserById($id);
    }

    public function ProductByUser($id)
    {
        return $this->users->getProductByUserId($id);
    }


    public function getDetailsUser()
    {
        return $this->users->getDetailsUser();
    }
    public function getDetailsAdmins()
    {
        return $this->users->getDetailsAdmins();
    }


    public function getProductUser()
    {
        return $this->users->getProductUser();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->users->RemoveUsers($id);
    }
}
