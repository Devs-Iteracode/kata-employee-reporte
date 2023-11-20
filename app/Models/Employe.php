<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'age'
    ];

    public function scopeAtLeast18(Builder $query): void
    {
        $query->where('age', '>=', 18);
    }

    public static function getEmployesMajeursParOrdreAlphabetique()
    {
        return Employe::atLeast18()->orderBy('nom')->get();
    }
}
