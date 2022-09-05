<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaires extends Model
{
    use HasFactory;
    protected $primaryKey = 'commentaire_id';
    protected $fillable = [
        'message',
        'date_commentaire',
        'statut_commentaire',
        'idincident',
        'iduser',

    ];
}
