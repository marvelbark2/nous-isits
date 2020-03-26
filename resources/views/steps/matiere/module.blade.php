<div class="form-group">
    <label for="module">Module</label>
    <input type="text" name="module" id="module" class="form-control{{ $errors->has('module') ? ' is-invalid' : '' }}" value="{{ old('module') ?? $step->data('module') }}">
    @if ($errors->has('module'))
        <span class="invalid-feedback">{{ $errors->first('module') }}</span>
    @endif
</div>
