<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['ticket_id', 'user_id', 'comment', 'created_at', 'updated_at'];

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
