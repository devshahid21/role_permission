{{-- Include Bootstrap CSS --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit User') }}
            </h2>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('users.update', $users->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $users->name }}" >

                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $users->email }}" >

                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check">
                            @foreach ($roles as $role)
                                <div class="mb-2">

                                    <input type="checkbox" 
                                    {{ $hasroles->contains($role->id) ? 'checked' : '' }} 
                                    id="role-{{ $role->id }}" 
                                    name="role[]" 
                                    value="{{ $role->id }}" 
                                    class="form-check-input">
                             
                             <label for="role-{{ $role->id }}" class="form-check-label">
                                 {{ $role->name }}
                             </label>
                             
                                </div>
                            @endforeach
                        </div>

                   

                        <button type="submit" class="btn btn-primary">Update</button>   
                    </form>

                </div>
            </div>
        </div>

</x-app-layout>
