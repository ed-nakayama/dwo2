<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MComment extends Model
{

     protected $table = 'M_COMMENT';

	protected $guarded = [
        'comment_cd',
    ];

	protected $primaryKey = ['comment_type', 'comment_cd'];
	public $incrementing = false;
    public $timestamps = false;

}
