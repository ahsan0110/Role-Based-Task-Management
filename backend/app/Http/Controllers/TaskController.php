<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected TaskRepository $tasks;

    public function __construct(TaskRepository $tasks)
    {
        $this->tasks = $tasks;
    }

    public function index()
    {
        return response()->json($this->tasks->all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $task = $this->tasks->create($data);
        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $task = $this->tasks->find($id);
        if (!$task) return response()->json(['message' => 'Task not found'], 404);

        $data = $request->only(['title', 'description', 'status', 'assigned_to']);
        $this->tasks->update($task, $data);

        return response()->json($task);
    }
}
