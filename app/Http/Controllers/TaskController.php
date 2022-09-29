<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index() {
        $tasks = auth()->user()->tasks()->with('project')->get();

        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create(Project $project) {
        Gate::authorize('access-project', $project);

        return view('tasks.edit', ['project' => $project, 'task' => new Task()]);
    }

    public function store(Project $project) {
        Gate::authorize('access-project', $project);

        $input = request()->validate([
            'description' => 'required|min:3',
        ]);

        $task = new Task();
        $task->fill($input);
        $task->user_id = auth()->id();
        $task->project_id = $project->id;
        $task->save();

        return redirect()->route('projects.show', ['project' => $project]);
    }

    public function show(Project $project, Task $task) {
        Gate::authorize('access-project', $project);
        Gate::authorize('access-task', $task);

        $task->increment('views');

        return view('tasks.show', ['project' => $project, 'task' => $task]);
    }

    public function edit(Project $project, Task $task) {
        Gate::authorize('access-project', $project);
        Gate::authorize('access-task', $task);

        return view('tasks.edit', ['project' => $project, 'task' => $task]);
    }

    public function update(Project $project, Task $task) {
        Gate::authorize('access-project', $project);
        Gate::authorize('access-task', $task);

        $input = request()->validate([
            'description' => 'required|min:3',
        ]);

        $task->fill($input);
        $task->save();

        return redirect()->route('projects.show', ['project' => $project]);
    }

    public function complete(Task $task) {
        Gate::authorize('access-task', $task);

        $task->completed_at = now();
        $task->save();

        return redirect()->route('projects.show', ['project' => $task->project_id]);
    }

    public function destroy(Project $project, Task $task) {
        Gate::authorize('access-project', $project);
        Gate::authorize('access-task', $task);

        $task->delete();

        return redirect()->route('projects.show', ['project' => $project]);
    }
}
