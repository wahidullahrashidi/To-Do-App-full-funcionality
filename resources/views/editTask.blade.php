@extends('layouts.master') 
{{-- this is the layout file --}}
@section('content')

    <div class="bg-white p-6 rounded shadow">

        <h1 class="text-2xl font-bold mb-5">To Do List</h1>

        <!-- 📝 Edit Form -->
        <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">

            <h2 class="text-xl font-bold mb-4">{{ __('messages.edit_task') }}</h2>

            <!-- Errors -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="text" name="title" value="{{ old('title', $task->title) }}"
                    class="border p-2 w-full mb-4 rounded">

                <div class="flex justify-between">

                    <a href="{{ route('tasks.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">
                        {{ __('messages.back') }}
                    </a>

                    <input type="hidden" name="edit" value="1">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded">
                        {{ __('messages.update') }}
                    </button>

                </div>
            </form>

        </div>


    </div>

@endsection
