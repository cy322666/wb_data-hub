<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'incomeId',
        'number',
        'date',
        'lastChangeDate',
        'supplierArticle',
        'techSize',
        'barcode',
        'quantity',
        'totalPrice',
        'dateClose',
        'warehouseName',
        'nmId',
        'status'
    ];
}
