<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PollResult extends Pivot
{
    use HasFactory;
    protected $table = 'poll_results';
    public $incrementing = true;
}
