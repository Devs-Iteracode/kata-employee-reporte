<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployesMajeursController extends Controller
{
    public function liste(): View {
        return view('employes-majeurs', [
            'employes' => Employe::all()
        ]);
    }
}
