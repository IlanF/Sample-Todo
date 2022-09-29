<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-8">
                <x-primary-button-link :href="route('projects.create')">New Project</x-primary-button-link>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full">
                    <thead>
                    <tr>
                        <th class="px-6 py-4 bg-slate-50 border-b border-slate-200 rounded-t text-left">Project</th>
                        <th class="px-6 py-4 bg-slate-50 border-b border-slate-200 rounded-t text-left">Pending Tasks</th>
                        <th class="px-6 py-4 bg-slate-50 border-b border-slate-200 rounded-t text-left">Total Tasks</th>
                        <th class="px-6 py-4 bg-slate-50 border-b border-slate-200 rounded-t text-right"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($projects as $project)
                        <tr>
                            <td class="px-6 py-4">{{ $project->name }}</td>
                            <td class="px-6 py-4">{{ $project->pending_tasks_count }}</td>
                            <td class="px-6 py-4">{{ $project->tasks_count }}</td>
                            <td class="px-6 py-4 text-right">
                                <x-primary-button-link :href="route('projects.show', $project)">Show Tasks</x-primary-button-link>
                                <x-primary-button-link :href="route('projects.edit', $project)">Edit Project</x-primary-button-link>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="42" class="px-6 py-4 text-gray-400 text-center">No projects</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
