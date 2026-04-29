<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Employee;

class AboutController extends Controller
{
    public function index()
    {
        $employees = Employee::active()
            ->latest()
            ->get();

        return view('frontend.pages.about', compact('employees'));
    }
}
