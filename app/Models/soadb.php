<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class soadb extends Model
{
    //
    protected $fillable = [
        'customer_name' , 'date' , 'typeps' , 'totalamount' , 'data' , 'invoicenumber'
    ];
    protected $casts = [
        'data' => 'array', // Automatically handles JSON <-> Array conversion
    ];
}
