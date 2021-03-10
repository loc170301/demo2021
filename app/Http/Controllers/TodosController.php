<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todos;

class TodosController extends Controller
{
    public function index(){
        $todos = Todos::paginate(3);
        return response()->json($todos);
    }
    public function store(Request $request)
    {
        $todos = new Todos();
        $todos->notes = $request->notes;
        $todos->status = 0;
        $todos->save();

        return response()->json($todos, 201);
    }

    public function show($id){
        $todo = Todos::find($id);
        return response()->json($todos);
    }

    public function update($id,Request $request){
        $todo = Todos::find($id);

        $todo->notes = $request->post('notes');

        if ($request->has('status')) {
            $todo->status = $request->post('status');
        }
        $todo->save();

        return response()->json($todo);
    }

    public function delete($id){
        Todos::where('id',$id)->delete();
        return response(null, 204);
    }



}
