<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Task Form') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ $action }}">
                        @csrf
                        @if (isset($task))
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{ $task->id }}">
                        @endif
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="task">Task :</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter task" value="{{ $task->title??old('title') }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="description">Description :</label>
                                    <textarea name="description" class="form-control" placeholder="Enter description">{{ $task->description??old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="deadline">Deadline :</label>
                                    <input type="date" name="deadline" 
                                    class="form-control" 
                                    placeholder="Enter deadline"
                                    @php
                                        $deadline = isset($task)?date('Y-m-d',strtotime($task->deadline)):'';
                                    @endphp
                                    value="{{ $deadline??old('deadline') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-dark float-right">Save</button>
                            </div>
                        </div>
                  </form>

          </div>
      </div>
  </div>
</div>
</x-app-layout>
