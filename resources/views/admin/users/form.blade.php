<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User Form') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ $action }}">
                        @csrf
                        @if (isset($user))
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{ $user->id }}">
                        @endif
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="name">User Name:</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter user name" value="{{ $user->name??old('name') }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="email">User Email:</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter email name" value="{{ $user->email??old('email') }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="role">User Role:</label>
                                    <select name="user_role" class="form-control">
                                        <option value="">Please a Select Role for User</option>
                                        @foreach ($roles as $role)
                                            @php
                                                $selected = '';
                                                $user_role_name = isset($user->roles[0]) ? $user->roles[0]->name:'';
                                                if( (isset($user) && $user_role_name == $role->name) || (old('user_role') == $role->name) )
                                                    $selected = 'selected="selected"';
                                            @endphp
                                            <option value="{{ $role->name }}" {{ $selected }}> {{ $role->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Password:</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter password" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Confirm Password:</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Enter confirm password">
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
