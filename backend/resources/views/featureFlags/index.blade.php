@extends('layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Feature Flags</h1>

    <a href="{{ route('featureFlags.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ New Flag</a>

    <table class="w-full mt-4 border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Id</th>
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Key</th>
                <th class="p-2 border">Enabled</th>
                <th class="p-2 border">Starts</th>
                <th class="p-2 border">Ends</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($flags as $flag)
                <tr>
                    <td class="border p-2">{{ $flag->id }}</td>
                    <td class="border p-2">{{ $flag->name }}</td>
                    <td class="border p-2">{{ $flag->key }}</td>
                    <td class="border p-2">{{ $flag->enabled ? 'Yes' : 'No' }}</td>
                    <td class="border p-2">{{ $flag->starts_at ?? '-' }}</td>
                    <td class="border p-2">{{ $flag->ends_at ?? '-' }}</td>
                    <td class="border p-2">
                        <a href="{{ route('featureFlags.edit', $flag) }}" class="text-blue-500">Edit</a> |
                        <form action="{{ route('featureFlags.destroy', $flag) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500"
                                onclick="return confirm('Delete this flag?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
