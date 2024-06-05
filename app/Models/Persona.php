<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = ['razon_social', 'direccion', 'tipo_persona', 'estado', 'documento_id', 'numero_documento'];

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
