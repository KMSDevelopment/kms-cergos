<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "customer_companies";
    protected $fillable = ['customer_id','vat','company_name','logo','email','invoice_email','phonenr','address','zipcode','city','country'];
}
