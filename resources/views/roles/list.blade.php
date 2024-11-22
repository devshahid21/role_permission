{{-- Include Bootstrap CSS --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Roles') }}
            </h2>
            {{-- Add a "Create" button aligned to the right --}}
            @can('create,roles')
            <a href="{{ route('roles.create') }}" class="btn btn-primary">Create</a>
            @endcan

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

              {{-- add commponent for flash --}}
           <x-message></x-message>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Permissions</th>
                                <th>Created_at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @if ($role->permissions)
                                            <ul>
                                                @foreach ($role->permissions as $permission)
                                                    <li>{{ $permission->name }}</li>                                                    

                                                @endforeach
                                            </ul>
                                        @else
                                            <span>No Permissions</span>
                                        @endif
                                    </td>
                                    <td>{{ $role->created_at->format('Y-m-d H:i') }}</td> <!-- Display the formatted created_at -->

                                    <td>
                                        @can('update,roles')
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        @endcan
                                        @can('delete,roles')
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this role?')">Delete</button>
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
