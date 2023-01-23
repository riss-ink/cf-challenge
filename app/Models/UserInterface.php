<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInterface extends Model
{
    use HasFactory;
    protected $fillable = ['order', 'poll_id'];
    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
}
