@extends('layouts.master')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-5">{{ __('messages.to_do_list') }}</h1>
        <div class="flex gap-2 mb-4">
            <a href="{{ route('tasks.index') }}" class="px-3 py-1 bg-gray-300 rounded">{{ __('messages.all') }}</a>
            <a href="{{ route('tasks.index', ['filter' => 'completed', 'search' => request('search')]) }}"
                class="px-3 py-1 bg-green-300 rounded">{{ __('messages.completed') }}</a>
            <a href="{{ route('tasks.index', ['filter' => 'pending', 'search' => request('search')]) }}"
                class="px-3 py-1 bg-yellow-300 rounded">{{ __('messages.pending') }}</a>
        </div>
        <form action="{{ route('tasks.index') }}" method="GET" class="mb-4 gap-2 flex">
            <input type="text" name="search" placeholder="{{ __('messages.search_placeholder') }}"
                value="{{ request('search') }}" class="border p-2 w-full rounded">

            {{-- Keep filter value hidden! --}}
            <input type="hidden" name="filter" value="{{ request('filter') }}">
            <button class="bg-blue-500 text-white px-4 rounded">{{ __('messages.search') }}</button>
        </form>

        <!-- Add Task -->
        <form method="POST" action="{{ route('tasks.store') }}" class="flex gap-2 mb-5">
            @csrf

            <input type="text" name="title" placeholder="{{ __('messages.adding_new_task_placeholder') }}"
                class="border p-2 w-full rounded">

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-3 rounded-lg items-center flex gap-2 {{ app()->getLocale() == 'ps' ? 'flex-row-reverse' : '' }}">
                {{ __('messages.add_task') }}
            </button>
        </form>

        <hr><br>

        <!-- Tasks List -->
        <div>
            @forelse ($tasks as $task)
                <!-- We will loop here later -->
                <div class="flex justify-between items-center border p-4 mb-3 rounded hover:shadow transition">

                    <span class="{{ $task->completed ? 'line-through text-gray-400' : '' }}">
                        {{ $task->title }}
                    </span>

                    {{-- Action Buttons --}}
                    <div class="flex gap-2">
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="toggle" value="1">

                            <button
                                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg flex items-center gap-1 transition duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>

                                {{ __('messages.done') }}
                            </button>
                        </form>
                        <a href="{{ route('tasks.edit', $task->id) }}"
                            class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-2 rounded-lg flex items-center gap-1">

                            <!-- SVG -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5h2M12 7v10m-7 0h14" />
                            </svg>

                            {{ __('messages.edit') }}
                        </a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this task?')">

                            @csrf
                            @method('DELETE')

                            <button
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg flex items-center gap-1 transition duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                {{ __('messages.delete') }}
                            </button>
                        </form>

                    </div>

                </div>
            @empty
                <p class="text-gray-500 text-center">No tasks yet. Start adding 🚀</p>
            @endforelse

        </div>
    </div>
@endsection
