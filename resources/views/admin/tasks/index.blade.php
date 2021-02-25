<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>Tasks Listing</h2>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ route('task.create') }}" class="btn btn-dark float-right">Add New</a>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Task </th>
                                    <th> Description </th>
                                    <th> Deadline </th>
                                    <th> Logged </th>
                                    <th> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $key => $task)
                                    @php
                                        $sn = $key+1;
                                    @endphp
                                    <tr>
                                        <td>{{ $sn }}</td>
                                        <td> {{ $task->title }} </td>
                                        <td> {{ $task->description }} </td>
                                        <td> {{ date('d, m Y h:m',strtotime($task->deadline)) }} </td>
                                        <td> {{ $task->created_at->diffforhumans() }} </td>
                                        <td>
                                            <a href="{{ route('task.assign.to.user', $task->id) }}"> Assign </a> 
                                            | <a href="{{ route('task.edit', $task->id) }}"> Edit </a>
                                            | <a href="{{ route('task.destroy', $task->id) }}"> Delete </a>
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
