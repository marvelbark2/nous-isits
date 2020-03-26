<div class="form-group">
    <label for="matiere">matiere</label>
    <input type="text" name="matiere" id="matiere" class="form-control{{ $errors->has('matiere') ? ' is-invalid' : '' }}" value="{{ old('matiere') ?? $step->data('matiere') }}">
    @if ($errors->has('matiere'))
        <span class="invalid-feedback">{{ $errors->first('matiere') }}</span>
    @endif
</div>
