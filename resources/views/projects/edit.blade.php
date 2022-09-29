<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if($project->exists)
                Editing project "{{ $project->name }}"
            @else
                Creating New Project
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($errors->any())
                    <div class="mx-8 my-6 px-8 py-6 bg-red-200 rounded">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($project->exists)
                    <form id="deleteForm" method="post" action="{{ route('projects.destroy', $project) }}">
                        @csrf
                        @method('delete')
                    </form>
                @endif
                <form class="mx-8 my-6" method="post" action="{{ $project->exists ? route('projects.update', $project) : route('projects.store') }}">
                    @csrf
                    @if($project->exists)
                        @method('patch')
                    @endif

                    <div class="my-4">
                        <label class="block" for="name">Name</label>
                        <input class="block w-full rounded border-gray-200 px-4 py-2" id="name" type="text" name="name" value="{{ old('name', $project->name) }}">
                    </div>

                    <div class="flex justify-end">
                        @if($project->exists)
                            <button type="button" class="text-red-500 mr-auto" onclick="confirm('Are you sure?') && document.forms.deleteForm.submit()">
                                Delete
                            </button>
                        @endif

                        <x-primary-button-link class="mx-2" href="{{ route('projects.index') }}">Cancel</x-primary-button-link>
                        <x-primary-button>{{ $project->exists ? 'Save' : 'Create' }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
