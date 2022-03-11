<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListDelteRequest;
use App\Http\Requests\TodoListPostRequest;
use App\Http\Requests\TodoListUpdateRequest;
use App\Models\TodoList;

class TodoListController extends Controller {
    public function index() {
        return view('todo.home', ['lists' => TodoList::all()]);
    }

    public function save(TodoListPostRequest $request) {

        $todoModel = new TodoList();
        $todoModel->title = $request->input('title');
        $todoModel->description = $request->input('description');
        if ($todoModel->save()) {
            return response()->json(['status' => 'ok']);
        }
        return response()->json(['status' => 'fail']);
    }

    public function getData($id) {
        $todoModel = TodoList::find($id);
        if (!empty($todoModel)) {
            return response()->json(['status' => 'ok', 'data' => $todoModel]);
        }

        return response()->json(['status' => 'fail']);
    }

    public function update(TodoListUpdateRequest $request) {

        $todoModel = TodoList::find($request->input('id'));
        $todoModel->title = $request->input('title');
        $todoModel->description = $request->input('description');
        if ($todoModel->save()) {
            return response()->json(['status' => 'ok']);
        }
        return response()->json(['status' => 'fail']);
    }

    public function delete(TodoListDelteRequest $request) {

        $todoModel = TodoList::find($request->input('id'))->delete();
        if ($todoModel) {
            return response()->json(['status' => 'ok']);
        }
        return response()->json(['status' => 'fail']);
    }
}
