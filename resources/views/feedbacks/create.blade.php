<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">
                            Add Feedback
                        </h2>
                        <a href="{{ route('feedbacks.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Back to Feedbacks
                        </a>
                    </div>

                    <form action="{{ route('feedbacks.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">
                                Rating
                            </label>
                            <input type="number"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                   id="rating"
                                   name="rating"
                                   value="{{ old('rating') }}"
                                   min="1"
                                   max="5"
                                   required>
                            @error('rating')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">
                                Comment
                            </label>
                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                      id="comment"
                                      name="comment"
                                      rows="4">{{ old('comment') }}</textarea>
                            @error('comment')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="publish" class="block text-sm font-medium text-gray-700 mb-2">
                                Publish
                            </label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    id="publish"
                                    name="publish"
                                    required>
                                <option value="1" {{ old('publish') == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('publish') == 0 ? 'selected' : '' }}>No</option>
                            </select>
                            @error('publish')
                                <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('feedbacks.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
