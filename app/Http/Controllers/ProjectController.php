<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    public function index() {
        $user = auth()->user();
        $projects = $user->projects()
            ->withCount(['tasks', 'tasks as pending_tasks_count' => function($query) {
                $query->whereNull('completed_at');
            }])
            ->get();

        return view('projects.index', ['projects' => $projects]);
    }

    public function create() {
        return view('projects.edit', ['project' => new Project()]);
    }

    public function store() {
        $input = request()->validate([
            'name' => 'required|min:3|max:191',
        ]);

        $project = new Project();
        $project->fill($input);

        auth()->user()->projects()->save($project);

        return redirect()->route('projects.index');
    }

    public function show(Project $project) {
        Gate::authorize('access-project', $project);

        $project->load('tasks');
        return view('projects.show', ['project' => $project]);
    }

    public function edit(Project $project) {
        Gate::authorize('access-project', $project);

        return view('projects.edit', ['project' => $project]);
    }

    public function update(Project $project) {
        Gate::authorize('access-project', $project);

        $input = request()->validate([
            'name' => 'required|min:3|max:191',
        ]);

        $project->fill($input);

        auth()->user()->projects()->save($project);

        return redirect()->route('projects.index');
    }

    public function destroy(Project $project) {
        Gate::authorize('access-project', $project);

        $project->delete();

        return redirect()->route('projects.index');
    }
}
