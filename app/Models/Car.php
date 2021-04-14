<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'numserie',
        'user_id',
        'marque',
        'type',
        'annee',
        'description',
        'statut',
        'dedouaner',
        'prixDedouanement',
        'ht',
        'tva',
        'ttc'
    ];

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function achats(){
        return $this->hasMany(Achat::class);
    }
    public function operations(){
        return $this->hasMany(Operation::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
