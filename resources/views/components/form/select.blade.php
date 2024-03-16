@props(["label", "type", "name", "id" => null, "placeholder","value" => null])

<div class="form-group">
    <label for=""><b>{{ $label }} : </b></label>
    <select name="role_id" id="" class="form-control select2">
        <option value="">Select A Role</option>
        @foreach ($roles as $role)
        <option value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
    </select>
@error("role_id")
    <span class="text-danger">{{ $message }}</span>
@enderror
</div>
