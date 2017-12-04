<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $primaryKey = 'article_id';
    public $timestamps = false;
    protected $guarded = [];
}
