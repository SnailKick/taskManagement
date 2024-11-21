<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $pendingTasks = Task::where('assignee_id', Auth::id())
            ->whereIn('status', ['pending', 'accepted'])
            ->orderBy('due_datetime')
            ->get();

        $completedTasks = Task::where('assignee_id', Auth::id())
            ->where('status', 'completed')
            ->orderBy('due_datetime')
            ->get();

        $rejectedTasks = Task::where('assignee_id', Auth::id())
            ->where('status', 'rejected')
            ->orderBy('due_datetime')
            ->get();

        $assignedTasks = Task::where('user_id', Auth::id())
            ->orderBy('due_datetime')
            ->get();

        return view('tasks.index', compact('pendingTasks', 'completedTasks', 'rejectedTasks', 'assignedTasks'));
    }

    public function create()
    {
        $users = User::all();
        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'due_datetime' => 'required|date',
            'assignee_id' => 'required|exists:users,id',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        Task::create($validated);

        return redirect()->route('tasks.index');
    }
    
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'due_datetime' => 'required|date',
            'assignee_id' => 'required|exists:users,id',
        ]);
    
        $task->update($validated);
    
        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        $users = User::all();
        return view('tasks.edit', compact('task', 'users'));
    }


    public function history()
    {
        $assignedTasks = Task::where('user_id', Auth::id())
            ->orderBy('due_datetime')
            ->get();

        $myTasks = Task::where('assignee_id', Auth::id())
            ->orderBy('due_datetime')
            ->get();

        return view('tasks.history', compact('assignedTasks', 'myTasks'));
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function accept(Task $task)
    {
        if ($task->assignee_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Вы не можете принять эту задачу.');
        }

        $task->status = 'accepted';
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Задача принята.');
    }

    public function complete(Task $task)
    {
        if ($task->assignee_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Вы не можете завершить эту задачу.');
        }

        $task->status = 'completed';
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Задача завершена.');
    }

    public function reject(Task $task)
    {
        if ($task->assignee_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Вы не можете отказаться от этой задачи.');
        }

        $task->status = 'rejected';
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Задача отклонена.');
    }
}