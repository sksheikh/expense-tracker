<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Categories') }}
            </h2>
            <a href="{{ route('categories.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Add Category</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($categories as $category)
                            <div class="border rounded-lg overflow-hidden shadow-sm">
                                <div class="p-4 border-b" style="background-color: {{ $category->color }}20;">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-lg font-semibold" style="color: {{ $category->color }};">{{ $category->name }}</h3>
                                        <div class="w-6 h-6 rounded-full" style="background-color: {{ $category->color }};"></div>
                                    </div>
                                </div>
                                <div class="p-4 bg-white">
                                    <div class="text-sm text-gray-500 mb-2">
                                        {{ $category->expenses->count() }} expenses
                                    </div>
                                    <div class="text-sm text-gray-700 mb-4">
                                        Total: {{ number_format($category->expenses->sum('amount'), 2) }} BDT
                                    </div>
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('categories.edit', $category) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this category? All associated expenses will also be deleted.')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-3 text-center py-4 text-gray-500">
                                No categories found. <a href="{{ route('categories.create') }}" class="text-blue-500 hover:underline">Create your first category</a>.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>