<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            // Get the currently authenticated user
            $user = Auth::user();

            // Get the user's tasks
            $tasks = Task::with('category')
                ->where('user_id', $user->id)
                ->paginate(10);

            return response()->json(['tasks' => $tasks]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed get task data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Task $task): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();

        $data = Task::with('category')
            ->where('id', $task->id)
            ->where('user_id', $user->id)
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'Get data successfully',
            'Data' => $data]);
    }

    public function update(Request $request, Task $task): \Illuminate\Http\JsonResponse
    {
        try {
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

            return response()->json([
                'success' => false,
                'message' => 'Task updated successfully'],
            200);

        }catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update task',
                'errors' => $errors,
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update task',
                'error' => $e->getMessage(),
            ], 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {

        try {
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

            return response()->json([
                'success' => false,
                'message' => 'Task saved successfully'],
                200);

        }catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json([
                'success' => false,
                'message' => 'Failed to save task',
                'errors' => $errors,
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save task',
                'error' => $e->getMessage(),
            ], 500);
        }


    }

    public function destroy(Task $task): \Illuminate\Http\JsonResponse
    {
        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully'],
            200);
    }

}
