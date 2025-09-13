@extends('layout')

@section('content')
    <h1 class="text-xl font-bold mb-4">Create Feature Flag</h1>

    {{-- Show validation errors --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('featureFlags.store') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block">Key</label>
            <input type="text" name="key" value="{{ old('key') }}" class="border p-2 w-full" required>
        </div>

        <div>
            <label class="block">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="border p-2 w-full" required>
        </div>

        <div>
            <label class="block">Description</label>
            <textarea name="description" class="border p-2 w-full">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block">Rules (JSON)</label>
            <textarea name="rules" class="border p-2 w-full">{{ old('rules') }}</textarea>
        </div>

        <div>
            <label class="block">Enabled</label>
            <input type="checkbox" name="enabled" value="1" {{ old('enabled') ? 'checked' : '' }}>
        </div>

        <div>
            <label class="block">Starts At</label>
            <input type="datetime-local" name="starts_at" value="{{ old('starts_at') }}" class="border p-2 w-full">
        </div>

        <div>
            <label class="block">Ends At</label>
            <input type="datetime-local" name="ends_at" value="{{ old('ends_at') }}" class="border p-2 w-full">
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
    </form>
@endsection