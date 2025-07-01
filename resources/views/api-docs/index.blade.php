<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Mart API Documentation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Mini Mart API Documentation</h1>
            
            <div class="mb-4 p-4 bg-blue-50 rounded-lg">
                <h2 class="text-lg font-semibold text-blue-800">Base URL</h2>
                <code class="text-blue-600">{{ url('/') }}</code>
            </div>

            <div class="mb-4 p-4 bg-green-50 rounded-lg">
                <h2 class="text-lg font-semibold text-green-800">Authentication</h2>
                <p class="text-green-700">Add to headers: <code>Authorization: Bearer YOUR_TOKEN</code></p>
            </div>

            @foreach($apiRoutes as $section => $endpoints)
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-4 capitalize border-b pb-2">
                        {{ str_replace('_', ' ', $section) }}
                    </h2>
                    
                    <div class="space-y-3">
                        @foreach($endpoints as $name => $endpoint)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="px-2 py-1 text-xs font-bold rounded 
                                        {{ $endpoint['method'] === 'GET' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $endpoint['method'] === 'POST' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $endpoint['method'] === 'PUT' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $endpoint['method'] === 'DELETE' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ $endpoint['method'] }}
                                    </span>
                                    <code class="text-gray-700 font-mono">{{ $endpoint['url'] }}</code>
                                    @if(isset($endpoint['auth']))
                                        <span class="px-2 py-1 text-xs bg-orange-100 text-orange-800 rounded">
                                            {{ $endpoint['auth'] === 'required' ? 'Auth Required' : $endpoint['auth'] }}
                                        </span>
                                    @endif
                                </div>
                                
                                <p class="text-gray-600 mb-2">{{ $endpoint['description'] }}</p>
                                
                                @if(isset($endpoint['body']))
                                    <div class="mb-2">
                                        <span class="text-sm font-semibold text-gray-700">Body: </span>
                                        <code class="text-sm text-gray-600">
                                            {{ is_array($endpoint['body']) ? implode(', ', $endpoint['body']) : $endpoint['body'] }}
                                        </code>
                                    </div>
                                @endif
                                
                                @if(isset($endpoint['params']))
                                    <div class="mb-2">
                                        <span class="text-sm font-semibold text-gray-700">Params: </span>
                                        <code class="text-sm text-gray-600">
                                            {{ is_array($endpoint['params']) ? implode(', ', $endpoint['params']) : $endpoint['params'] }}
                                        </code>
                                    </div>
                                @endif

                                @if(isset($endpoint['example']))
                                    <details class="mt-2">
                                        <summary class="text-sm font-semibold text-gray-700 cursor-pointer">Example</summary>
                                        <pre class="mt-1 p-2 bg-gray-100 rounded text-sm"><code>{{ json_encode($endpoint['example'], JSON_PRETTY_PRINT) }}</code></pre>
                                    </details>
                                @endif
                            </div>
                        @endforeach
                    </div>  
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>