<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Showing task for project "{{ $project->name }}"
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-6 py-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{ $task->description }}
            </div>

            <div class="flex justify-end mt-8">
                <x-primary-button-link href="{{ route('projects.show', $project) }}">Back</x-primary-button-link>

                @if(!$task->completed_at)
                    <form class="ml-2" method="post" action="{{ route('tasks-actions.complete', [$task]) }}">
                        @csrf

                        <x-primary-button>Mark as Complete</x-primary-button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
