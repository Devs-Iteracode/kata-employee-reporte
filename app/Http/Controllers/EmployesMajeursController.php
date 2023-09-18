<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployesMajeursController extends Controller
{
    public function liste() {
        return view('employes-majeurs', [
            'employes' => [
                'Agent Smith',
                'Neo'
            ]
        ]);
    }
}
