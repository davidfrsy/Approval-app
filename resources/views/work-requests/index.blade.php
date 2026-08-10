<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Work Request</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Daftar Work Request</h1>
            <a href="{{ route('work-requests.create') }}" class="px-4 py-2 bg-blue-600 text-white font-medium text-sm rounded-md hover:bg-blue-700">
                + Buat Request Baru
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b bg-gray-50 text-gray-600 text-sm">
                        <th class="py-3 px-4">#</th>
                        <th class="py-3 px-4">Title</th>
                        <th class="py-3 px-4">Requester</th>
                        <th class="py-3 px-4">Priority</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @forelse($workRequests as $request)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 font-semibold text-gray-500">#{{ $request->id }}</td>
                            <td class="py-3 px-4 font-medium text-gray-900">{{ $request->title }}</td>
                            <td class="py-3 px-4 text-gray-600">{{ $request->requester->name ?? '-' }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full 
                                    @if($request->priority === 'high') bg-red-100 text-red-800
                                    @elseif($request->priority === 'medium') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($request->priority ?? 'low') }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                            </td>
                            <td class="py-3 px-4">
                                <a href="{{ route('work-requests.show', $request) }}" class="text-blue-600 hover:underline">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-gray-500">Belum ada work request.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
