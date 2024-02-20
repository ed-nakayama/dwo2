<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentView extends Model
{

     protected $table = 'AGENT_VIEW';

    protected $hidden = [
        'license_rowid',
        'cust_rowid',
        'class_rowid',
        'comment_rowid',
        'rowid',
    ];


	protected $primaryKey = 'cust_num';
	public $incrementing = false;
    public $timestamps = false;

}
