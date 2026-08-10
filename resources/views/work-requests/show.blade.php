<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Work Request #{{ $workRequest->id }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-start border-b pb-4 mb-4">
            <div>
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Work Request #{{ $workRequest->id }}</span>
                <h1 class="text-2xl font-bold text-gray-900 mt-1">{{ $workRequest->title }}</h1>
            </div>
            <div class="flex gap-2">
                <!-- Priority Badge -->
                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                    @if($workRequest->priority === 'high') bg-red-100 text-red-800
                    @elseif($workRequest->priority === 'medium') bg-yellow-100 text-yellow-800
                    @else bg-gray-100 text-gray-800 @endif">
                    Priority: {{ ucfirst($workRequest->priority ?? 'low') }}
                </span>

                <!-- Status Badge -->
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                    Status: {{ ucfirst($workRequest->status ?? 'pending') }}
                </span>
            </div>
        </div>

        <div class="space-y-4">
            <!-- Description -->
            <div>
                <h2 class="text-sm font-medium text-gray-500">Description</h2>
                <p class="text-gray-800 mt-1 whitespace-pre-line">{{ $workRequest->description }}</p>
            </div>

            <!-- Metadata -->
            <div class="grid grid-cols-2 gap-4 pt-4 border-t text-sm">
                <div>
                    <span class="text-gray-500 block">Requester:</span>
                    <span class="font-medium text-gray-800">{{ $workRequest->requester->name ?? 'N/A' }}</span>
                </div>
                <div>
                    <span class="text-gray-500 block">Submitted At:</span>
                    <span class="font-medium text-gray-800">
                        {{ $workRequest->submitted_at ? $workRequest->submitted_at->format('d M Y H:i') : '-' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Navigation Links -->
        <div class="mt-6 pt-4 border-t flex justify-between items-center">
            <a href="{{ route('work-requests.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                &larr; Kembali ke Daftar
            </a>
            <a href="" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                Submit
            </a>
        </div>
    </div>
</body>
</html>
