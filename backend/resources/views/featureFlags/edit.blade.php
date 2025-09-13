@extends('layout')

@section('content')
    <h1 class="text-xl font-bold mb-4">Edit Feature Flag</h1>

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

    <form method="POST" action="{{ route('featureFlags.update', $flag) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block">Key</label>
            <input type="text" 
                   name="key" 
                   value="{{ old('key', $flag->key) }}" 
                   class="border p-2 w-full" required>
        </div>

        <div>
            <label class="block">Name</label>
            <input type="text" 
                   name="name" 
                   value="{{ old('name', $flag->name) }}" 
                   class="border p-2 w-full" required>
        </div>

        <div>
            <label class="block">Description</label>
            <textarea name="description" class="border p-2 w-full">{{ old('description', $flag->description) }}</textarea>
        </div>

        <div>
            <label class="block">Rules (JSON)</label>
            <textarea name="rules" class="border p-2 w-full">{{ old('rules', json_encode($flag->rules, JSON_PRETTY_PRINT)) }}</textarea>
        </div>

        <div>
            <label class="block">Enabled</label>
            <input type="checkbox" name="enabled" value="1" {{ old('enabled', $flag->enabled) ? 'checked' : '' }}>
        </div>

        <div>
            <label class="block">Starts At</label>
            <input type="datetime-local" 
                   name="starts_at" 
                   value="{{ old('starts_at', optional($flag->starts_at)->format('Y-m-d\TH:i')) }}" 
                   class="border p-2 w-full">
        </div>

        <div>
            <label class="block">Ends At</label>
            <input type="datetime-local" 
                   name="ends_at" 
                   value="{{ old('ends_at', optional($flag->ends_at)->format('Y-m-d\TH:i')) }}" 
                   class="border p-2 w-full">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
@endsection