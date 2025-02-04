<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // modcon
    public $timestamps = true;

    protected $table = 'posts';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $guarded = ['id'];

    function getRouteKeyName()
    {
        return 'uuid';
    }

    // Relhasm
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    // Relbelo
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
