<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class incidents extends Model
{
    use HasFactory;
    use HasFactory;
    protected $primaryKey = 'incident_id';
    protected $table = 'incidents';
    protected $fillable = [
        'reference',
        'objet',
        'type',
        'commentaire',
        'date_debut',
        'date_fin',
        'heure_fin',
        'heure_debut',
        'date_incident',
        'idclient',
        'statut',
        'iduser',
    ];
}
