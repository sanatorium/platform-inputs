<div class="form-group{{ Alert::onForm($attribute->slug, ' has-error') }}">

    <label for="{{ $attribute->slug }}" class="control-label">
        {{{ $attribute->name }}}
    </label>

    <input type="url" class="form-control" name="{{ $attribute->slug }}" id="{{ $attribute->slug }}" value="{{ $entity->{$attribute->slug} }}">

    <span class="help-block">{{{ Alert::onForm($attribute->slug) }}}</span>

</div>