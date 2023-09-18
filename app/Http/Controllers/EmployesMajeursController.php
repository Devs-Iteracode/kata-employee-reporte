<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;

class EmployesMajeursController extends Controller
{
    public function liste() {
        return view('employes-majeurs', [
            'employes' => Employe::all()
        ]);
    }
}
