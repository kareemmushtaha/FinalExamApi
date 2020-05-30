<?php

namespace App\Repositories;

interface UserInterface
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function getUsers();

    /**
     * @param $id
     * @return mixed
     */
    public function getUserById($id);

    /**
     * @param null $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductByUserId($userId = null);

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getProductUser();

    /**
     * @param $id
     */
    public function RemoveUsers($id);


    /**
     * @return \Illuminate\Support\Collection
     */
    public function getDetailsUser();



    /**
     * @return \Illuminate\Support\Collection
     */

    public function getDetailsAdmins();
}
