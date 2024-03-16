@extends("admin.layouts.master")

@section("title","Role")

@section("master_content")

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <h3>Roles</h3>
                <hr>
                <table class="table table-sm table-bordered text-center">
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>

                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a href="" class="btn btn-sm btn-success mx-1"><i class="fa fa-eye"></i></a>
                                <a href="" class="btn btn-sm btn-info mx-1"><i class="fa fa-edit"></i></a>
                                <a href="" class="btn btn-sm btn-danger mx-1"><i class="fa fa-trash"></i></a>
                                <a href="" class="btn btn-sm btn-primary mx-1"><i class="fas fa-tasks"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @if (in_array("role-create",$permissions))
            <div class="col-md-4">
                <h3>Create Role</h3>
                <hr>
                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf
                    <x-form.input label="Name" type="text" name="name" placeholder="Enter role name" id="name"/>
                    {{-- <div class="form-group">
                        <label for=""><b>Name</b></label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        @error("name")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    <button class="btn btn-sm btn-success btn-block">Submit</button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>

@stop
