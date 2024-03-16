@extends("admin.layouts.master")

@section("title","Assign Permission")

@section("master_content")

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                {{-- {{ dd($permissions) }} --}}
                <div class="d-flex justify-content-between">
                    <div>
                        <h3>Assign Permisson to <b><small class="text-info">{{ $role->name }}</small></b></h3>
                    </div>
                    <div>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-success">Back</a>
                    </div>
                </div>
                <hr>
                <form action="{{ route("admin.roles.assign__permission",$role->id) }}" method="post">
                    @csrf
                    @foreach ($all_permissions as $permission)
                        <p class="m-0"><input type="checkbox" class="mx-1"
                            value="{{ $permission->id }}"
                            name="permissions[]"
                            @if (in_array($permission->id,$alreadyGiven))
                                checked
                            @endif
                            >{{ $permission->name }}</p>
                    @endforeach

                    <div class="my-2">
                        <button class="btn btn-sm btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
