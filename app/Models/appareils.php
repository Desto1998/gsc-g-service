<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appareils extends Model
{
    use HasFactory;
    protected $primaryKey = 'app_id';
    protected $table = 'appareils';
    protected $fillable = [
        'num_serie',
        'probleme',
        'accessoirs',
        'etat',
        'modele',
        'marque',
        'idincident',
        'montant',
        'iduser',
    ];
}
