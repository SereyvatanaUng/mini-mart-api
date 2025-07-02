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
                <p class="text-green-600 text-sm mt-1">🆕 Many endpoints now have public access!</p>
            </div>

            <!-- User Roles Section -->
            @if(isset($apiRoutes['user_roles']) && is_array($apiRoutes['user_roles']))
                <div class="mb-8 p-4 bg-purple-50 rounded-lg">
                    <h2 class="text-lg font-semibold text-purple-800 mb-3">User Roles & Permissions</h2>
                    <div class="grid md:grid-cols-3 gap-4">
                        @foreach($apiRoutes['user_roles'] as $role => $info)
                            <div class="bg-white p-3 rounded border">
                                <h3 class="font-semibold text-purple-700 capitalize">{{ str_replace('_', ' ', $role) }}</h3>
                                <p class="text-sm text-gray-600 mb-2">{{ $info['description'] ?? '' }}</p>
                                @if(isset($info['permissions']) && is_array($info['permissions']))
                                    <ul class="text-xs text-gray-500">
                                        @foreach($info['permissions'] as $permission)
                                            <li>• {{ $permission }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Image Handling Section -->
            @if(isset($apiRoutes['image_handling']) && is_array($apiRoutes['image_handling']))
                <div class="mb-8 p-4 bg-amber-50 rounded-lg">
                    <h2 class="text-lg font-semibold text-amber-800 mb-3">🖼️ Product Image System</h2>
                    <div class="bg-white p-3 rounded border">
                        <p class="text-sm text-gray-600 mb-2">
                            {{ $apiRoutes['image_handling']['product_images']['description'] ?? '' }}</p>
                        @if(isset($apiRoutes['image_handling']['product_images']['options']) && is_array($apiRoutes['image_handling']['product_images']['options']))
                            <div class="text-xs text-gray-500">
                                <strong>Options:</strong>
                                @foreach($apiRoutes['image_handling']['product_images']['options'] as $option => $desc)
                                    <span class="block">• {{ $option }}: {{ $desc }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            @if(isset($apiRoutes) && is_array($apiRoutes))
                @foreach($apiRoutes as $section => $endpoints)
                    @if(in_array($section, ['user_roles', 'image_handling', 'examples', 'base_url', 'version', 'title', 'description']))
                        @continue
                    @endif

                    @if(is_array($endpoints))
                        <div class="mb-8">
                            <h2 class="text-2xl font-semibold text-gray-700 mb-4 capitalize border-b pb-2">
                                {{ str_replace('_', ' ', $section) }}
                            </h2>

                            <div class="space-y-3">
                                @foreach($endpoints as $name => $endpoint)
                                    @if(is_array($endpoint))
                                        <div class="border border-gray-200 rounded-lg p-4">
                                            <div class="flex items-center gap-3 mb-2 flex-wrap">
                                                <span
                                                    class="px-2 py-1 text-xs font-bold rounded 
                                                                {{ ($endpoint['method'] ?? '') === 'GET' ? 'bg-blue-100 text-blue-800' : '' }}
                                                                {{ ($endpoint['method'] ?? '') === 'POST' ? 'bg-green-100 text-green-800' : '' }}
                                                                {{ ($endpoint['method'] ?? '') === 'PUT' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                                {{ ($endpoint['method'] ?? '') === 'DELETE' ? 'bg-red-100 text-red-800' : '' }}">
                                                    {{ $endpoint['method'] ?? 'N/A' }}
                                                </span>
                                                <code class="text-gray-700 font-mono text-sm">{{ $endpoint['url'] ?? '' }}</code>
                                                @if(isset($endpoint['auth']))
                                                    @if($endpoint['auth'] === 'public')
                                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded">
                                                            🌍 PUBLIC ACCESS
                                                        </span>
                                                    @else
                                                        <span class="px-2 py-1 text-xs bg-orange-100 text-orange-800 rounded">
                                                            {{ $endpoint['auth'] === 'required' ? 'Auth Required' : $endpoint['auth'] }}
                                                        </span>
                                                    @endif
                                                @endif
                                            </div>

                                            <p class="text-gray-600 mb-2">{{ $endpoint['description'] ?? '' }}</p>

                                            @if(isset($endpoint['note']))
                                                <div class="mb-2 p-2 bg-blue-50 rounded text-sm text-blue-700">
                                                    💡 {{ $endpoint['note'] }}
                                                </div>
                                            @endif

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
                                                    <pre
                                                        class="mt-1 p-2 bg-gray-100 rounded text-sm"><code>{{ json_encode($endpoint['example'], JSON_PRETTY_PRINT) }}</code></pre>
                                                </details>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif

            <!-- Examples Section -->
            @if(isset($apiRoutes['examples']) && is_array($apiRoutes['examples']))
                <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                    <h2 class="text-lg font-semibold text-gray-800 mb-3">📝 API Usage Examples</h2>
                    <div class="space-y-4">
                        @foreach($apiRoutes['examples'] as $name => $example)
                            <details class="bg-white p-3 rounded border">
                                <summary class="font-semibold text-gray-700 cursor-pointer capitalize">
                                    {{ str_replace('_', ' ', $name) }}
                                </summary>
                                <pre
                                    class="mt-2 p-2 bg-gray-100 rounded text-sm"><code>{{ json_encode($example, JSON_PRETTY_PRINT) }}</code></pre>
                            </details>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Debug Section (only shown when APP_DEBUG=true) -->
            @if(config('app.debug'))
                <div class="mt-8 p-4 bg-red-50 rounded-lg">
                    <h2 class="text-lg font-semibold text-red-800 mb-3">🐛 Debug Info (Development Only)</h2>
                    <details class="bg-white p-3 rounded border">
                        <summary class="font-semibold text-red-700 cursor-pointer">Raw API Routes Data</summary>
                        <pre
                            class="mt-2 p-2 bg-gray-100 rounded text-sm overflow-auto"><code>{{ print_r($apiRoutes, true) }}</code></pre>
                    </details>
                </div>
            @endif
        </div>
    </div>
</body>

</html>