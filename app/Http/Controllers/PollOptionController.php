<?php

namespace App\Http\Controllers;

use App\Models\PollOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PollOptionController extends Controller
{
    public function vote(PollOption $pollOption)
    {
        $pollOption->users()->attach(Auth::id());
        $poll = $pollOption->poll()->with('poll_options.users')->first();
        $chatData = ['options' => [], 'results' => [], 'name' => $poll->name];
        foreach ($poll->poll_options as $option){
            $chatData['options'][] = Str::limit($option['option'],10 );
            $chatData['results'][] = $option->users->count();
        }
        return $chatData;
    }
}
