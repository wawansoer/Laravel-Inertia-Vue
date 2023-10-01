<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Get the user's tasks
        $tasks = Task::with('category')
            ->where('user_id', $user->id)
            ->paginate(10);

        return response()->json(['tasks' => $tasks]);
    }

    public function show(Task $task)
    {
        return response()->json(['task' => $task]);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|string',
            'detail' => 'nullable|string',
            'category' => 'required|uuid',
        ]);

        $task->update([
            'name' => $request->input('name'),
            'detail' => $request->input('detail'),
            'm_category_id' => $request->input('category'),
        ]);

        return response()->json(['message' => 'Task updated successfully']);
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

        return response()->json(['message' => 'Task updated successfully']);

    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }

}
