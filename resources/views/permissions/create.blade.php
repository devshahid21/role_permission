{{-- Include Bootstrap CSS --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Permissions') }}
            </h2>
            {{-- Add a "Back" button aligned to the right --}}
            <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow">
                        
                        <div class="card-body">
                            <form action="{{ route('permissions.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Permission Name</label>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        value="{{ old('name') }}" 
                                        id="name" 
                                        class="form-control @error('name') is-invalid @enderror">
                                    
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary w-35">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
