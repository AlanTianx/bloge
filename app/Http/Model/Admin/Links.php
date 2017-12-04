<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    protected $table = 'links';
    protected $primaryKey = 'link_id';
    public $timestamps = false;
    protected $guarded = [];
}
