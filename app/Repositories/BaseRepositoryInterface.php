<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

interface BaseRepositoryInterface
{
    public function list();
    public function show($id);
    public function store($input);
    public function update($id ,$input);
    public function delete($id);

    public function getForgotPassword($linkReset,$mailTemplate,$request);
    public function getResetPassword();
    public function postResetPassword($request);
    public function sendMailVerifyAccount($id, $route,$template);
}
