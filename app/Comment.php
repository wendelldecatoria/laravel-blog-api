<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The connections this model will use
     *
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['post_id','parent_id', 'name', 'description'];

    public function replies() {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
