<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('user_id', auth()->id());

        // Check for status parameter
        //if ($request->has('status')) {
        if (isset($request->status)) {
            $query->where('status', $request->input('status'));
        }

        // Check for sort_by parameter
        //if ($request->has('sort_by')) {
        if (isset($request->sort_by)) {
            $sortField = $request->input('sort_by');

            // Determine the order (asc or desc)
            $sortOrder = 'asc';
            if (Str::endsWith($sortField, '_desc')) {
                $sortOrder = 'desc';
                $sortField = rtrim($sortField, '_desc');
            }

            // Check if the $sortField is not empty
            if (!empty($sortField)) {
                $query->orderBy($sortField, $sortOrder);
            }
        }

        // Handle clearing
        //if ($request->has('clear')) {
        if (isset($request->clear)) {
            // Reset all filters
            return redirect()->route('tasks.index');
        }

        // Check for dynamic search
        //if ($request->has('search')) {
        if (isset($request->search)) {
            $searchTerm = $request->input('search');

            $query->where('title', 'like', '%' . $searchTerm . '%')
                ->orWhere('description', 'like', '%' . $searchTerm . '%')
                ->get();

//            $query->where(function ($q) use ($searchTerm) {
//                $q->where('title', 'like', '%' . $searchTerm . '%')
//                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
//            });
        }

        $tasks = $query->paginate(20);

        return view('dashboard', compact('tasks'));
    }

    public function dynamicSearch(Request $request)
    {
        $query = Task::where('user_id', auth()->id());

        // Check for dynamic search
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $tasks = $query->where('title', 'like', '%' . $searchTerm . '%')
                ->orWhere('description', 'like', '%' . $searchTerm . '%')
                ->get();

            return response()->json($tasks);
        }
    }

    public function create()
    {
        return view('task.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard');
    }

    public function edit(Task $task)
    {
        return view('task.create', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('dashboard');
    }
}
