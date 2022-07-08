<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcisesReport extends Model
{
    protected $fillable = [
        'operation_id',
        'finishedPrice',
        'operationTypeId',
        'fiscalDt',
        'docNumber',
        'fnNumber',
        'regNumber',
        'excise',
        'date'
    ];
}
