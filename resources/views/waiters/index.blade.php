<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Waiters Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Waiters & PIN Codes</h3>
                        <a href="{{ route('waiters.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add New Waiter
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        PIN Code
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Created
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($waiters as $waiter)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $waiter->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $waiter->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span class="bg-gray-100 px-2 py-1 rounded font-mono">{{ $waiter->pin_code }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $waiter->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('waiters.edit', $waiter) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                                Edit
                                            </a>
                                            <form action="{{ route('waiters.destroy', $waiter) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this waiter?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            No waiters found. <a href="{{ route('waiters.create') }}" class="text-indigo-600 hover:text-indigo-900">Add the first waiter</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($waiters->hasPages())
                        <div class="mt-4">
                            {{ $waiters->links() }}
                        </div>
                    @endif

                    <!-- POS System Info -->
                    <div class="mt-8 p-4 bg-blue-50 rounded-lg">
                        <h4 class="text-lg font-medium text-blue-900 mb-2">POS System Authentication</h4>
                        <p class="text-blue-700 text-sm mb-3">
                            Waiters can log into the POS system using their 4-digit PIN codes. 
                            Make sure each waiter has a unique PIN code.
                        </p>
                        <div class="text-sm text-blue-600">
                            <strong>Sample PIN codes for testing:</strong>
                            <ul class="list-disc list-inside mt-1">
                                <li>Granit: 1234</li>
                                <li>Demo Waiter: 5678</li>
                                <li>John Smith: 1111</li>
                                <li>Sarah Johnson: 2222</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 