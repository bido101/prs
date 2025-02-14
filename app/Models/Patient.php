<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = "patient_information";

    protected $fillable = [
        'hospitalNumber',
        'firstname',
        'middlename',
        'lastname',
        'suffix',
        'bday',
        'address',
        'isDeleted',
        'deleted_at'
    ];
}
