<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskRepository
{
    public function create(array $data): Task
    {
        $data['created_by'] = Auth::id();
        return Task::create($data);
    }

    public function update(Task $task, array $data): Task
    {
        $task->update($data);
        return $task;
    }

    public function find(int $id): ?Task
    {
        return Task::with('assignee')->find($id);
    }

    public function all()
    {
        return Task::with('assignee')->latest()->get();
    }

    public function forUser(int $userId)
    {
        return Task::where('assigned_to', $userId)->get();
    }
}
