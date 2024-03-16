@props(["label", "type", "name", "id" => null, "placeholder","value" => null])

<div class="form-group">
    <label for="{{ $id }}"><b>{{ $label }}</b> : </label>
    <input type="{{ $type }}" class="form-control
    @error($name)
        is-invalid
    @enderror
    " name="{{ $name }}" value="{{ old($name) ?? $value }}" id="{{ $id }}" placeholder="{{ $placeholder }}">
    @error($name)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


 {{-- <div class="form-group">
                        <label for=""><b>Name</b></label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        @error("name")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}
