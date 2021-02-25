<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TasksRequest;

use App\Models\User;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderby('id','DESC')->get();
        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('task.store');
        // $users = User::role('Employee')->get();
        return view('admin.tasks.form', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TasksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TasksRequest $request, Task $task)
    {
        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;

        if ($task->save()) {
            return redirect()->route('tasks')->with('success', 'Task has been created');
        }
        return redirect()->back()->with('failure', 'There is an error in saving task');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $action = route('task.update', $task->id);
        return view('admin.tasks.form', compact('action', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TasksRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TasksRequest $request, Task $task)
    {
        
        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;

        if ($task->save()) {
            return redirect()->route('tasks')->with('success', 'Task has been updated');
        }
        return redirect()->back()->with('failure', 'There is an error in updating task');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $deleted = $task->delete();
        if ($deleted) {
            return redirect()->route('tasks')->with('success','Task has been deleted');
        }
        return redirect()->back()->with('failure', 'There is an error in deleting task');
    }

    /**
     * Display the list of users to assign the task.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function assign(Task $task)
    {
        $action = route('task.assigning.to.user', $task->id);
        $users = User::role('Employee')->paginate(10);
        return view('admin.tasks.assign', compact('task','users','action'));
    }


    public function assigning(Request $request, Task $task)
    {
        if (!empty($request->users)) {
            $task_assigned_to_ussers = $task->users()->sync($request->users);
            return redirect()->route('tasks')->with('success', "Task has been assigned to users");
        }

        return redirect()->back()->with('failure', 'There is an error in assigning tasks');
    }


}
