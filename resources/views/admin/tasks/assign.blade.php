<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign Task To Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ $action }}">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h2><b>Task: {{ $task->title }}</b> </h2>
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-dark float-right">Save</button>
                                </div>
                            </div>
                            @csrf
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Name </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        @php
                                            $sn = $key+1;
                                            $checkbox_checked = '';
                                        @endphp
                                        @foreach ($task->users as $t_user)
                                            @php
                                                if($t_user->id == $user->id) {
                                                    $checkbox_checked = 'checked="checked"';
                                                    break;
                                                }
                                            @endphp
                                        @endforeach

                                        <tr>
                                            <td>{{ $sn }}</td>
                                            <td> {{ $user->name }} </td>
                                            <td> <input type="checkbox" name="users[]" value="{{ $user->id }}" {{ $checkbox_checked }}></td>
                                        </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-dark float-right">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
