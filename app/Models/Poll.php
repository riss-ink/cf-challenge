<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Poll extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date'
    ];
    public function poll_options(){
        return $this->hasMany(PollOption::class);
    }

    public function user_interface()
    {
        $this->hasOne(UserInterface::class);
    }

    public function getAllActivePolls()
    {
       return $this::where('start_date', '<', Date::now())->where('end_date', '>', Date::now())->get();
    }
}
