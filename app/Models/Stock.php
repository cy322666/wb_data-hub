<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'lastChangeDate',
        'supplierArticle',
        'techSize',
        'barcode',
        'quantity',
        'isSupply',
        'isRealization',
        'quantityFull',
        'quantityNotInOrders',
        'warehouse',
        'warehouseName',
        'inWayToClient',
        'inWayFromClient',
        'nmId',
        'subject',
        'category',
        'daysOnSite',
        'brand',
        'SCCode',
        'Price',
        'Discount'
    ];
}
