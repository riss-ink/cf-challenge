<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\UserInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserInterfaceController extends Controller
{

    public function index()
    {
       $interface = UserInterface::with('poll.poll_options')->orderBy('order')->get();
       $pollSelection = [];
        foreach ($interface as $item) {
            $pollSelection[$item['poll']['id']] = '';
       }
       return Inertia::render('UserInterface/Index', ['interface' => $interface, 'poll_selection' => $pollSelection]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit()
    {
        $polls = (new \App\Models\Poll)->getAllActivePolls();
        $interface = UserInterface::orderBy('order')->get();
        if($interface->isEmpty()){
            $interface = [['id'=> 1, 'poll_id'=>'']];
        }
        return Inertia::render('UserInterface/Edit', ['pollsData' => $polls, 'userInterfaceData' => $interface]);
    }


    public function update(Request $request)
    {
        //dd($request->input()['_value']);
        UserInterface::truncate();
        foreach ($request->input()['_value'] as $interface) {
            UserInterface::create($interface);

        }
        $polls = Poll::all();

        return Inertia::render('Polls/Index', ['polls' => $polls]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
