<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    //
    protected $table = 'Stocks';
    protected $fillable = [
           'itemcode',
           'name',
           'purchaseqty',
           'salesqty',
           'balanceqty',
           'totalpurchaseamount',
           'avgpurchaseprice',
           'stockvalue' 
    ];
}
