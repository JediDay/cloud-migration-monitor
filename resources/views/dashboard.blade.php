<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud Migration Monitor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white font-sans">
    <div class="container mx-auto px-4 py-8">
        <header class="mb-8 border-b border-gray-700 pb-4">
            <h1 class="text-3xl font-bold text-blue-400">Cloud Migration Monitor</h1>
            <p class="text-gray-400">Real-time AWS VM Migration Tracking</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($migrations as $task)
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 shadow-xl">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-xl font-semibold">{{ $task['MigrationTaskName'] ?? 'Unknown Task' }}</h3>
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ ($task['Status'] ?? '') == 'COMPLETED' ? 'bg-green-600' : 'bg-yellow-600' }}">
                        {{ $task['Status'] ?? 'IN_PROGRESS' }}
                    </span>
                </div>
                
                <div class="mb-4">
                    <div class="flex justify-between text-sm text-gray-400 mb-1">
                        <span>Migration Progress</span>
                        <span>{{ $task['ProgressPercent'] ?? 0 }}%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $task['ProgressPercent'] ?? 0 }}%"></div>
                    </div>
                </div>

                <div class="text-xs text-gray-500 italic">
                    Last Updated: {{ now()->toDateTimeString() }}
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12 bg-gray-800 rounded-lg">
                <p class="text-gray-500 text-lg">No active migrations found in this region.</p>
            </div>
            @endforelse
        </div>
    </div>
</body>
</html>
