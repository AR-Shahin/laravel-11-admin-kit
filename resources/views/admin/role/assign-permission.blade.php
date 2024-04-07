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


                 {{-- <form action="{{ route("admin.roles.assign__permission",$role->id) }}" method="post">
                    @csrf
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="pills-view-tab" data-toggle="pill" href="#pills-view" role="tab" aria-controls="pills-view" aria-selected="true">View</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="pills-create-tab" data-toggle="pill" href="#pills-create" role="tab" aria-controls="pills-create" aria-selected="false">Create</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="pills-edit-tab" data-toggle="pill" href="#pills-edit" role="tab" aria-controls="pills-edit" aria-selected="false">Edit</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-update-tab" data-toggle="pill" href="#pills-update" role="tab" aria-controls="pills-update" aria-selected="false">Update</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="pills-delete-tab" data-toggle="pill" href="#pills-delete" role="tab" aria-controls="pills-delete" aria-selected="false">Delete</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="pills-other-tab" data-toggle="pill" href="#pills-other" role="tab" aria-controls="pills-other" aria-selected="false">Other</a>
                          </li>
                      </ul>
                      <hr>
                      <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-view" role="tabpanel" aria-labelledby="pills-view-tab">
                            <input type="checkbox" onclick="addCheckboxClick"> Choose All
                                @foreach ($permissionArrays["view"] as $permission)
                                <p class="m-0"><input type="checkbox" class="mx-1"
                                    value="{{ $permission["id"] }}"
                                    name="permissions[]"
                                    @if (in_array($permission["id"],$alreadyGiven))
                                        checked
                                    @endif
                                    >{{ $permission["name"] }}</p>
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="pills-create" role="tabpanel" aria-labelledby="pills-create-tab">
                            <input type="checkbox" onclick="addCheckboxClick"> Choose All
                            @foreach ($permissionArrays["create"] as $permission)
                            <p class="m-0"><input type="checkbox" class="mx-1"
                                value="{{ $permission["id"] }}"
                                name="permissions[]"
                                @if (in_array($permission["id"],$alreadyGiven))
                                    checked
                                @endif
                                >{{ $permission["name"] }}</p>
                        @endforeach
                        </div>
                        <div class="tab-pane fade" id="pills-edit" role="tabpanel" aria-labelledby="pills-edit-tab">
                            <input type="checkbox" onclick="addCheckboxClick"> Choose All

                            @foreach ($permissionArrays["edit"] as $permission)
                            <p class="m-0"><input type="checkbox" class="mx-1"
                                value="{{ $permission["id"] }}"
                                name="permissions[]"
                                @if (in_array($permission["id"],$alreadyGiven))
                                    checked
                                @endif
                                >{{ $permission["name"] }}</p>
                        @endforeach
                        </div>
                        <div class="tab-pane fade" id="pills-update" role="tabpanel" aria-labelledby="pills-update-tab">
                            <input type="checkbox" onclick="addCheckboxClick"> Choose All

                            @foreach ($permissionArrays["update"] as $permission)
                            <p class="m-0"><input type="checkbox" class="mx-1"
                                value="{{ $permission["id"] }}"
                                name="permissions[]"
                                @if (in_array($permission["id"],$alreadyGiven))
                                    checked
                                @endif
                                >{{ $permission["name"] }}</p>
                        @endforeach
                        </div>
                        <div class="tab-pane fade" id="pills-delete" role="tabpanel" aria-labelledby="pills-delete-tab">
                            <input type="checkbox" onclick="addCheckboxClick"> Choose All

                            @foreach ($permissionArrays["delete"] as $permission)
                            <p class="m-0"><input type="checkbox" class="mx-1"
                                value="{{ $permission["id"] }}"
                                name="permissions[]"
                                @if (in_array($permission["id"],$alreadyGiven))
                                    checked
                                @endif
                                >{{ $permission["name"] }}</p>
                        @endforeach
                        </div>
                        <div class="tab-pane fade" id="pills-other" role="tabpanel" aria-labelledby="pills-other-tab">
                            <input type="checkbox" onclick="addCheckboxClick"> Choose All

                            @foreach ($permissionArrays["other"] as $permission)
                            <p class="m-0"><input type="checkbox" class="mx-1"
                                value="{{ $permission["id"] }}"
                                name="permissions[]"
                                @if (in_array($permission["id"],$alreadyGiven))
                                    checked
                                @endif
                                >{{ $permission["name"] }}</p>
                        @endforeach
                        </div>
                      </div>
                    <div class="my-2">
                        <button class="btn btn-sm btn-success">Submit</button>
                    </div>
                </form> --}}
                <form action="{{ route("admin.roles.assign__permission", $role->id) }}" method="post">
                    @csrf
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        @foreach ($permissionArrays as $type => $permissions)
                        <li class="nav-item ">
                            <a class=" nav-link{{ $loop->first ? ' active ' : '' }}" id="pills-{{ $type }}-tab" data-toggle="pill" href="#pills-{{ $type }}" role="tab" aria-controls="pills-{{ $type }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ ucfirst($type) }}</a>
                        </li>
                        @endforeach
                    </ul>
                    <hr class="p-0 my-1">
                    <div class="tab-content" id="pills-tabContent">
                        @foreach ($permissionArrays as $type => $permissions)
                        <div class="tab-pane fade{{ $loop->first ? ' show active' : '' }}" id="pills-{{ $type }}" role="tabpanel" aria-labelledby="pills-{{ $type }}-tab">

                            @if (count($permissions) > 0)
                            <input type="checkbox" onclick="addCheckboxClick('{{ $type }}')" id="addCheckboxId_{{ $type }}"
                            @if ( !array_diff(collect($permissions)->map(fn($i)=> $i["id"])->toArray(), $alreadyGiven))
                            checked
                            @endif
                            > <label style="cursor: pointer" for="addCheckboxId_{{ $type }}">Choose All</label>
                            <hr class="p-0 my-1">
                            <div class="permissionDiv">
                                @foreach ($permissions as $permission)
                                <p class="m-0" style="cursor: pointer"><input type="checkbox" class="mx-1 addItems" value="{{ $permission['id'] }}" name="permissions[]" {{ in_array($permission['id'], $alreadyGiven) ? 'checked' : '' }} onclick='ars("{{ count($permissions) }}",this,"addCheckboxId_{{ $type }}")'>{{ $permission['name'] }}</p>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <div class="my-2">
                        <button class="btn btn-sm btn-success">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@stop


@push("script")
    <script>

    function addCheckboxClick(type) {
    if (document.getElementById(`addCheckboxId_${type}`).checked) {

        $('#pills-' + type + ' .addItems:input:checkbox').each(function() { this.checked = true; });
    } else {
        $('#pills-' + type + ' .addItems:input:checkbox').each(function() { this.checked = false; });
    }

}

function ars(a, t, foo) {
    var checkedCount = $(t).closest(".permissionDiv").find(".addItems:checked").length;
    $("#" + foo).prop("checked", checkedCount >= a);
}

    </script>
@endpush
