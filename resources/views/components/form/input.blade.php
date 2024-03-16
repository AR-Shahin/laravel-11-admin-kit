@props(["label", "type", "name", "id" => null, "placeholder"])

<div class="form-group">
    <label for="{{ $id }}"><b>{{ $label }}</b></label>
    <input type="{{ $type }}" class="form-control
    @error($name)
        is-invalid
    @enderror
    " name="{{ $name }}" value="{{ old($name) }}" id="{{ $id }}" placeholder="{{ $placeholder }}">
    @error($name)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

