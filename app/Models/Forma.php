<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forma extends Model
{
    use HasFactory;

    public static function rules($id = null)
    {
        return [
            'nombre' => 'required|unique:formas,nombre,' . $id
        ];
    }

    protected $table = 'formas';

    protected $fillable = ['nombre'];
}
