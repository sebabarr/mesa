<?php
namespace course\Http\Controllers;
Class UsersController extends Controller {
    public function getIndex(){
        $user=\DB::table('users')->get();
        return dd($user);
    }
}
