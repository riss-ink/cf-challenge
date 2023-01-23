<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollOption;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PollController extends Controller
{

    public function index()
    {
        $polls = Poll::all();

        return Inertia::render('Polls/Index', ['polls' => $polls]);
    }


    public function create()
    {
        return Inertia::render('Polls/Create');

    }


    public function store(Request $request)
    {
        $pollData = $request->input('poll')['_value'];
        $optionsData = $request->input('options')['_value'];
        $start_timestamp = strtotime($pollData['start_date']);
        $end_timestamp = strtotime($pollData['end_date']);
        $pollData['start_date'] = date("Y-m-d H:i:s", $start_timestamp);
        $pollData['end_date'] = date("Y-m-d H:i:s", $end_timestamp);
        $poll = Poll::create($pollData);
        $poll->poll_options()->createMany($optionsData);
        $polls = Poll::all();

        return Inertia::render('Polls/Index', ['polls' => $polls]);
    }


    public function show($id)
    {
        //
    }


    public function edit(Poll $poll)
    {
        $poll_options = $poll->poll_options()->select(['id', 'option'])->get();
        return Inertia::render('Polls/Edit', ['poll' => $poll, 'poll_options' => $poll_options]);
    }


    public function update(Request $request, Poll $poll)
    {
        $pollData = $request->input('poll')['_value'];
        $optionsData = $request->input('options')['_value'];

        $poll->update([
            'name' => $pollData['name'],
            'description' => $pollData['description'],
            'start_date' => $pollData['start_date'],
            'end_date' => $pollData['end_date']
        ]);
        foreach ($optionsData as $option){
            if(!empty($option['id'])){
                PollOption::find($option['id'])->update(['option' => $option['option']]);
            } else {
                $poll->poll_options()->create(['option' => $option['option']]);
            }
        }
        $polls = Poll::all();

        return Inertia::render('Polls/Index', ['polls' => $polls]);
    }


    public function destroy($id)
    {
        //
    }


}
