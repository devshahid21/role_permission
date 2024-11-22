{{-- Include Bootstrap CSS --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articles') }}
            </h2>
            {{-- Add a "Create" button aligned to the right --}}
            @can('create,articles')
            <a href="{{ route('articles.create') }}" class="btn btn-primary">Create</a>
                
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Content</th>
                                <th scope="col">Created_at</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <th scope="row">{{ $article->id }}</th>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ Str::limit($article->content, 50) }}...</td>  <!-- Limiting content to 50 chars -->
                                    <td>{{ $article->created_at->format('d-m-Y H:i') }}</td>  <!-- Formatting date -->

                                    <td>
                                        @can('edit,articles')
                                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-primary btn-sm">Edit</a>                                    
                                            
                                        @endcan
                                        @can('delete,articles')
                                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this article?')">Delete</button>
                                        </form>
                                        @endcan
                                  
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                        {{ $articles->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
