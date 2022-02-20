<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mlog extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'log_at', 'count'];
    public function user()
    {
        $this->belongsTo(User::class);
    }
}
