{{-- Include Bootstrap CSS --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articles') }}
            </h2>
            {{-- Add a "Back" button aligned to the right --}}
            <a href="{{ route('articles.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <x-message></x-message>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-light">
                        
                        <div class="card-body">
                            <h5 class="card-title mb-4">Create New Article</h5>
                            <form action=" {{ route('articles.store') }}"method="POST">
                                @csrf
                                
                                {{-- Title Field --}}
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input 
                                        type="text" 
                                        name="title" 
                                        value="{{ old('title') }}" 
                                        id="title" 
                                        class="form-control @error('title') is-invalid @enderror" placeholder="Enter title">
                                    
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                

                                {{-- Content Field --}}
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea 
                                        name="content" 
                                        id="content" 
                                        class="form-control @error('content') is-invalid @enderror" rows="5" placeholder="Enter content">{{ old('content') }}</textarea>
                                    
                                    @error('content')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Author Field --}}
                                <div class="mb-3">
                                    <label for="author" class="form-label">Author</label>
                                    <input 
                                        type="text" 
                                        name="author" 
                                        value="{{ old('author') }}" 
                                        id="author" 
                                        class="form-control @error('author') is-invalid @enderror" placeholder="Enter author name">
                                    
                                    @error('author')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Submit Button --}}
                                <div class="d-grid ">
                                    <button type="submit" style="width: 150px" class="btn btn-primary">Save Permission</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
