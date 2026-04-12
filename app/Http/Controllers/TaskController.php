<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->filter;
        $search = $request->search;

        $tasks = Task::query()
            ->where('user_id', auth()->id())
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'LIKE', '%' . $search . '%');
            })->when($filter === 'completed', function ($query) {
                $query->where('completed', 1);
            })->when($filter === 'pending', function ($query) {
                $query->where('completed', 0);
            })->latest()->get();


        return view('todos', ['tasks' => $tasks]);

        // this is also correct:
        // if ($filter === 'completed') $tasks = Task::where('completed', 1)->latest()->get();
        // elseif ($filter === 'pending') $tasks = Task::where('completed', 0)->latest()->get();
        // else $tasks = Task::latest()->get();

        // return view('todos', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        Task::create([
            'title' => $request->title,
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('tasks.index')
            ->with('success', __('messages.added') . ' ' . '!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== auth()->id()) {
            abort(403);
        }
        return view('editTask', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== auth()->id()) {
            abort(403);
        }
        if ($request->has('toggle')) {
            $task->completed = !$task->completed;
            $task->update();
        } elseif ($request->has('edit')) {
            $task->title = $request->title;
            $task->update();
        }
        return redirect()->route('tasks.index')->with('success', __('messages.updated') . ' ' . '!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->delete();
        return redirect()->back()->with('success', __('messages.deleted') . ' ' . '!');
    }
}
