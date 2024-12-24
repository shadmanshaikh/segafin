<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class invoicedb extends Model
{
    //
    protected $fillable = [
        'invoicenumber',
        'doi',
        'contractperiod',
        'customername',
        'address',
        'typeps',
        'data',
        'totalamount'
    ];
    protected $casts = [
        'data' => 'array', // Automatically handles JSON <-> Array conversion
    ];
}
