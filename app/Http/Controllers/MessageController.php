<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Message::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'mail' => 'required|string|email',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return $validator->errors();
        } else {
            $message = Message::create($request->all());

            return response()->json($message->id, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Message::find($id);
    }

    public function list()
    {
        $messages = Message::orderByDesc('created_at')->paginate(10);
        return view('list', compact('messages'));
    }

    public function store(MessageRequest $request)
    {
        $data = $request->validated();
        Message::firstOrCreate($data);
        return redirect()->route('main.list');
    }


}
