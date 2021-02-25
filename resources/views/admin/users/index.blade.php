<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>Users Listing</h2>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ route('user.create') }}" class="btn btn-dark float-right">Add New</a>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Name </th>
                                    <th>User Email </th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    @php
                                        $sn = $key+1;
                                    @endphp
                                    <tr>
                                        <td>{{ $sn }}</td>
                                        <td> {{ $user->name }} </td>
                                        <td> {{ $user->email }} </td>
                                        <td>
                                            <a href="{{ route('user.edit', $user->id) }}">Edit</a>
                                            @if ($user->id !== 1)
                                                | <a href="{{ route('user.destroy', $user->id) }}">Delete</a>
                                            @endif
                                        </td>
                                    </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
