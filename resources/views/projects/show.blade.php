<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Showing project "{{ $project->name }}"
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-8">
                <x-primary-button-link :href="route('tasks.create', $project)">New Task</x-primary-button-link>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full">
                    <thead>
                    <tr>
                        <th class="px-6 py-4 bg-slate-50 border-b border-slate-200 rounded-t text-left">Task</th>
                        <th class="px-6 py-4 bg-slate-50 border-b border-slate-200 rounded-t text-left">Views</th>
                        <th class="px-6 py-4 bg-slate-50 border-b border-slate-200 rounded-t text-left">Completed</th>
                        <th class="px-6 py-4 bg-slate-50 border-b border-slate-200 rounded-t text-right"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($project->tasks as $task)
                        <tr>
                            <td class="px-6 py-4 {{ $task->completed_at !== null ? 'line-through opacity-75' : '' }}">{{ $task->getTruncatedDescription() }}</td>
                            <td class="px-6 py-4">{{ $task->views }}</td>
                            <td class="px-6 py-4">{{ $task->completed_at !== null ? $task->completed_at->diffForHumans() : '' }}</td>
                            <td class="px-6 py-4 text-right">
                                <x-primary-button-link :href="route('tasks.show', [$project, $task])">Details</x-primary-button-link>
                                <x-primary-button-link :href="route('tasks.edit', [$project, $task])">Edit Task</x-primary-button-link>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="42" class="px-6 py-4 text-gray-400 text-center">No tasks</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
