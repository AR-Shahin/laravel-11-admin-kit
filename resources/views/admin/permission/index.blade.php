@extends("admin.layouts.master")

@section("title","Permission")
@push(
    "css"
)
<x-utility.datatable-css/>
@endpush
@section("master_content")


<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <h3>Permissions</h3>
                <hr>
                <table class="table table-sm table-bordered data-table">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>

                    {{-- @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <a href="" class="btn btn-sm btn-success mx-1"><i class="fa fa-eye"></i></a>
                                <a href="" class="btn btn-sm btn-info mx-1"><i class="fa fa-edit"></i></a>
                                <a href="" class="btn btn-sm btn-danger mx-1"><i class="fa fa-trash"></i></a>
                                <a href="" class="btn btn-sm btn-primary mx-1"><i class="fas fa-tasks"></i></a>
                            </td>
                        </tr>
                    @endforeach --}}
                </table>
            </div>
            @if (in_array("permission-create",$permissions))
            <div class="col-md-4">
                <h3>Create permission</h3>
                <hr>
                <form action="{{ route('admin.permissions.store') }}" method="POST">
                    @csrf


                    <x-form.input label="Name" type="text" name="name" placeholder="Enter permission name" id="name"/>
                    <button class="btn btn-sm btn-success btn-block">Submit</button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>

@stop


@push("script")

<x-utility.datatable-js/>

<script>

      $(function () {
    var table = $('.data-table').DataTable({
        "processing": true,
        "retrieve": true,
        "serverSide": true,
        'paginate': true,
        'searchDelay': 700,
        "bDeferRender": true,
        "responsive": true,
        "autoWidth": true,
        "order": [ [0, 'desc'] ],
        ajax: "{{ route('admin.permissions.data_table') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'actions', name: 'actions'},
        ],
    });
  });
</script>
@endpush
