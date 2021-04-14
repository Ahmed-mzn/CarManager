<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'type',
        'description',
        'montant'
    ];


    public function car(){
        return $this->belongsTo(Car::class);
    }
}
