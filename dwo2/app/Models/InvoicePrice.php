<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoicePrice extends Model
{

     protected $table = 'DWO_Invoice_price';

	protected $guarded = [];

	protected $primaryKey = 'price_seq';
	public $incrementing = false;
	const CREATED_AT = 'price_update';
	const UPDATED_AT = 'price_update';

}
