<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staff = User::byRank('admin');

        return view('staff')->with('staff', $staff);
    }
}
