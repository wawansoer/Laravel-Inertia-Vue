<?php

namespace App\Http\Controllers;

use App\Models\MCategoryTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Get the user's tasks
        $tasks = Task::with('category')
                        ->where('user_id', $user->id)
                        ->paginate(10);

//        dd($tasks);
        return Inertia::render(
            'Tasks/Index',
            [
                'tasks' => $tasks,
                'flash' => function () {
                    return [
                        'message' => session('flash.message'),
                    ];
                },
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = MCategoryTask::all();
        return Inertia::render(
            'Tasks/Create',
            [
                'categories' => $category
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'detail' => 'nullable|string',
            'category' => 'required|uuid'
        ]);

        // Create a new task for the authenticated user
        $user = Auth::user();
        $task = new Task([
            'name' => $request->input('name'),
            'detail' => $request->input('detail'),
            'user_id' => $user->id,
            'm_category_id' => $request->input('category'),
        ]);
        $task->save();
        sleep(1);

        return redirect()->route('task.index')->with('flash.message', 'Task created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $category = MCategoryTask::all();
        return Inertia::render(
            'Tasks/Edit',
            [
                'task' => $task,
                'categories' => $category
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|string',
            'detail' => 'nullable|string',
            'category' => 'required|uuid'
        ]);

        $task->name = $request->input('name');
        $task->detail = $request->input('detail');
        $task->m_category_id = $request->input('category');
        $task->save();
        sleep(1);

        return redirect()->route('task.index')->with('flash.message', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('task.index')->with('flash.message', 'Task deleted successfully.');
    }
}
