<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">
                            Edit Message
                        </h2>
                    </div>

                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <ul class="text-sm text-red-800">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('messages.update', $message->id) }}" enctype="multipart/form-data" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <input type="text" readonly name="category" id="category" value="{{ old('category', $message->category) }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50 text-gray-500">
                        </div>

                        @if($message->category == 'OPEN_HOURS')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="from" class="block text-sm font-medium text-gray-700 mb-2">From time:</label>
                                    <input type="time" name="from" id="from" value="{{ explode('-', $message->description)[0] }}" required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="to" class="block text-sm font-medium text-gray-700 mb-2">To time:</label>
                                    <input type="time" name="to" id="to" value="{{ explode('-', $message->description)[1] }}" required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        @elseif($message->category == 'CURRENT_MESSAGE')
                            <?php $category = App\Models\Message::whereIn('category',['HOURS_CLOSE_STORE_MESSAGE','VACTION_CLOSE_STORE_MESSAGE','LARGE_ORDER_MESSAGE'])->get(); ?>
                            <div class="space-y-3">
                                @foreach($category as $cat)
                                    <label class="flex items-center">
                                        <input type="radio" name="description" id="{{ $cat->category }}"
                                               @if($message->description == $cat->category) checked @endif
                                               value="{{ $cat->category }}" required
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                        <span class="ml-3 text-sm text-gray-700">{{ $cat->description }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @elseif($message->category == 'LOGO')
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Logo File</label>
                                <input type="file" name="description" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        @else
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea name="description" id="description" rows="4" required
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('description', $message->description) }}</textarea>
                            </div>
                        @endif

                        <div class="flex items-center justify-between">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Update
                            </button>
                            <a href="{{ route('messages.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Back to Messages
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
