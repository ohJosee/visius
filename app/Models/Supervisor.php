<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;
    protected $table = 'supervisores';
    protected $primaryKey = 'supCodigo'; //Llave primario de la tabla
    protected $fillable = ['supUser']; // campos para asignacion masiva
}
