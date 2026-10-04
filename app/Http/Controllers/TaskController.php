<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Notifications\TaskNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display the logged-in user's tasks.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $tasks = $user
            ->tasks()
            ->latest()
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a new task for the logged-in user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $task = $user->tasks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'due_date' => $validated['due_date'] ?? null,
            'status' => 'pending',
        ]);

        $user->notify(
            new TaskNotification('created', $task->title)
        );

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task created successfully!');
    }

    /**
     * Display a task belonging to the logged-in user.
     */
    public function show(Task $task)
    {
        $task = $this->ownedTask($task);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the edit form for a user's task.
     */
    public function edit(Task $task)
    {
        $task = $this->ownedTask($task);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update a user's task.
     */
    public function update(Request $request, Task $task)
    {
        $task = $this->ownedTask($task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,completed',
        ]);

        $oldStatus = $task->status;

        $task->update($validated);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $action = 'updated';

        if (
            $oldStatus !== 'completed' &&
            $task->status === 'completed'
        ) {
            $action = 'completed';
        }

        $user->notify(
            new TaskNotification($action, $task->title)
        );

        return redirect()
            ->route('tasks.show', $task)
            ->with('success', 'Task updated successfully!');
    }

    /**
     * Delete a user's task.
     */
    public function destroy(Task $task)
    {
        $task = $this->ownedTask($task);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $taskTitle = $task->title;

        $task->delete();

        $user->notify(
            new TaskNotification('deleted', $taskTitle)
        );

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }

    /**
     * Make sure the task belongs to the logged-in user.
     */
    private function ownedTask(Task $task): Task
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return $user
            ->tasks()
            ->whereKey($task->id)
            ->firstOrFail();
    }
}

