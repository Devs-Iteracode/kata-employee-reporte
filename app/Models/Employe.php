<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Employe extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'date_de_naissance'
    ];

    public function scopeAtLeast18(Builder $query): void
    {
        $today = Carbon::today();
        $wanted = $today->subYears(18);

        $query->where('date_de_naissance', '<=', $wanted);
    }

    public static function getEmployesMajeursParOrdreAlphabetiqueDesc()
    {
        return Employe::atLeast18()->orderByDesc('nom')->get();
    }

    public function getAge(): int
    {
        $today = Carbon::today();

        return $today->diffInYears($this->date_de_naissance);
    }
}
