<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\EmailTemplate;

class LoanController extends Controller
{
    public function index() {
    	return view('loan.add');
    }
}
