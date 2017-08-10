<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['nickname', 'type', 'p_id', 'content', 'article_id' ,'commend' ,'reply' ,'user_id', 'parentContent' ,'parentId'];
}
