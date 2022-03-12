<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $to_do_list=ToDoList::where('status',0)->paginate(10);
        return view('home',['to_do_list' => $to_do_list]);
    }

    public function completedWorks()
    {
        $to_do_list=ToDoList::where('status',1)->paginate(10);
        return view('/completedWorks',['to_do_list' => $to_do_list]);
    }

    public function insertData(Request $request)
    {
        $new_task = new ToDoList();
        $new_task->name = $request->new_task;
        $new_task->save();

        return response()->json(['success' => 'Status Changed Successfully']);
    }

    public function changeStatus(Request $request)
    {
        ToDoList::where('id', $request->id)->update([
            'status' => $request->status
        ]);
        return response()->json(['success' => 'Status Changed Successfully']);
    }

    public function delete($id) {
        try {
            return ToDoList::destroy($id);
        } catch (Exception $e) {
            return response(['message' => $e->getMessage()], 404);
        }
    }
}
