<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>Roles Listing</h2>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ route('role.create') }}" class="btn btn-dark float-right">Add New</a>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role Name </th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $role)
                                    @php
                                        $sn = $key+1;
                                    @endphp
                                    <tr>
                                        <td>{{ $sn }}</td>
                                        <td> {{ $role->name }} </td>
                                        <td>
                                            <a href="{{ route('roles.permissions', $role->id) }}">Manage Permissions</a> |
                                            <a href="{{ route('role.edit', $role->id) }}">Edit</a> |
                                            <a href="{{ route('role.destroy', $role->id) }}">Delete</a>
                                        </td>
                                    </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>

                    </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
