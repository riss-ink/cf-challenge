<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{
    use HasFactory;
    protected $fillable = [
        'option'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'poll_results')->as('results')->using(PollResult::class);
    }

    public function poll(){
        return $this->belongsTo(Poll::class);
    }
}
