@extends('layout')

@section('content')
    <h1 class="text-xl font-bold mb-4">Car Damage Reports</h1>

    <a href="{{ route('carReports.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">New Report</a>

    <table class="w-full mt-4 border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Reporter</th>
                <th class="p-2 border">Car</th>
                <th class="p-2 border">Damage Level</th>
                <th class="p-2 border">Resolved</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                <tr>
                    <td class="p-2 border">{{ $report->reporter_name }}</td>
                    <td class="p-2 border">{{ $report->car_model }}</td>
                    <td class="p-2 border">{{ ucfirst($report->damage_level) }}</td>
                    <td class="p-2 border">{{ $report->is_resolved ? 'Yes' : 'No' }}</td>
                    <td class="p-2 border">
                        <a href="{{ route('carReports.show', $report) }}" class="text-blue-500">View</a> |
                        <a href="{{ route('carReports.edit', $report) }}" class="text-yellow-500">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $reports->links() }}
@endsection