{{-- Include Bootstrap CSS --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Permissions') }}
            </h2>
            {{-- Add a "Create" button aligned to the right --}}
            @can('create,permissions')
            <a href="{{ route('permissions.create') }}" class="btn btn-primary">Create</a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- add commponent for flash --}}
           <x-message></x-message>
            {{-- Main Content --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Table for Permissions --}}
                    <table class="table table-bordered">
                        <thead class="table-white">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Created_at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->created_at }}</td>
                                    <td>
                                        @can('update,permissions')
                                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary">Edit</a>
                                            
                                        @endcan
                                        
                                        @can('delete,permissions')
                                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    
                                            
                                        @endcan
                                        </td>
                                </tr>
                               @endforeach
                        </tbody>
                    </table>

                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
