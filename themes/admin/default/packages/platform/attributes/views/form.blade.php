@extends('layouts/default')

{{-- Page title --}}
@section('title')
    @parent
    {{{ trans("action.{$mode}") }}} {{{ trans('platform/attributes::common.title') }}}
@stop

{{-- Queue assets --}}
{{ Asset::queue('attributes', 'platform/attributes::css/form.scss') }}
{{ Asset::queue('selectize', 'selectize/css/selectize.bootstrap3.css', 'styles') }}

{{ Asset::queue('slugify', 'platform/js/slugify.js', 'jquery') }}
{{ Asset::queue('validate', 'platform/js/validate.js', 'jquery') }}
{{ Asset::queue('selectize', 'selectize/js/selectize.js', 'jquery') }}
{{ Asset::queue('underscore', 'underscore/js/underscore.js', 'jquery') }}
{{ Asset::queue('sortable', 'platform/attributes::js/jquery.sortable.js', 'jquery') }}
{{ Asset::queue('form', 'platform/attributes::js/form.js', [ 'platform', 'sortable', 'selectize', 'underscore', ]) }}
{{ Asset::queue('parsley-comparison', 'sanatorium/inputs::parsley/comparison.js', ['jquery', 'validate']) }}
{{ Asset::queue('vue', 'sanatorium/inputs::vue/vue.min.js') }}

{{-- Inline styles --}}
@section('styles')
    @parent
    <style type="text/css">
        .table.table-repeater > tbody > tr > td:first-child,
        .table.table-repeater > thead > tr > th:first-child {
            padding-left: 0;
        }
        .table.table-repeater > tbody > tr > td:last-child,
        .table.table-repeater > thead > tr > th:last-child {
            padding-right: 0;
        }
    </style>
@stop

{{-- Inline scripts --}}
@section('scripts')
    @parent
    <script type="text/javascript">

        // Repeater field
        var Repeater = new Vue({
            el: '#repeater',
            data: {
                debug: false,
                @if ( !empty($options) )
                options: {!! json_encode($options) !!}
                @else
                options: {
                    fields: [
                        {
                            label: '',
                            type: 'input'
                        }
                    ]
                }
                @endif
            },
            methods: {
                add: function(index, field) {
                    this.options.fields.splice(index + 1, 0, {
                        label: '',
                        type: 'input'
                    });
                },
                remove: function(field) {
                    this.options.fields.$remove(field);
                },
                storeSettings: function() {
                    var settings = JSON.stringify(this.options),
                        $field = $('#options');

                    if ( $field.length == 0 ) {
                        $('#repeater').after('<input type="hidden" name="options" id="options">');
                        $field = $('#options');
                    }

                    $field.val(settings);
                }
            }
        });

        Extension.Form.setOptions({!! json_encode($options) !!});

        function showHideByType() {

            $('select[name="type"]').change(function(event){
                var value = $(this).val();

                showHideByTypeSet(value);

            });

            showHideByTypeSet($('select[name="type"]').val());

        }

        function showHideByTypeSet(value) {
            $('[data-type-visible]').addClass('hidden').filter('.visible-' + value).removeClass('hidden');
            $('[data-type-hidden]').removeClass('hidden').filter('.hidden-' + value).addClass('hidden');
        }

        function showTypeSettings() {

            $('select[name="type"]').change(function(event){
                var value = $(this).val();

                showTypeSettingsSet(value);

            });

            showTypeSettingsSet( $('select[name="type"]').val() );

        }

        function showTypeSettingsSet(value) {

            $.ajax({
                type: 'GET',
                url: '{!! route('sanatorium.inputs.attributes.settings') !!}/' + value,
                data: {id: {{ $attribute->exists ? $attribute->id : 0 }}, html: true, values: {!! json_encode($attribute->settings) !!} },
                cache: false
            }).success(function(data){

                $('#type-settings').html(data);

                $('#attributes-form').parsley(window.ParsleyConfig).isValid();

            }).error(function(data){



            });

        }

        $(function(){
            showHideByType();

            showTypeSettings();
        });
    </script>
@stop

{{-- Page content --}}
@section('page')
    <section class="panel panel-default panel-tabs">

        {{-- Form --}}
        <form id="attributes-form" action="{{ request()->fullUrl() }}" method="post" accept-char="UTF-8" autocomplete="off" data-parsley-validate>

            {{-- Form: CSRF Token --}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <header class="panel-heading">

                <nav class="navbar navbar-default navbar-actions">

                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#actions">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <a class="btn btn-navbar-cancel navbar-btn pull-left tip" href="{{ route('admin.attributes.all') }}" data-toggle="tooltip" data-original-title="{{{ trans('action.cancel') }}}">
                                <i class="fa fa-reply"></i> <span class="visible-xs-inline">{{{ trans('action.cancel') }}}</span>
                            </a>

                            <span class="navbar-brand">{{{ trans("action.{$mode}") }}} <small>{{{ $attribute->name}}}</small></span>
                        </div>

                        {{-- Form: Actions --}}
                        <div class="collapse navbar-collapse" id="actions">

                            <ul class="nav navbar-nav navbar-right">

                                @if ($attribute->exists)

                                    <li>
                                        <a href="{{ route('admin.attribute.delete', $attribute->id) }}" class="tip" data-action-delete data-toggle="tooltip" data-original-title="{{{ trans('action.delete') }}}" type="delete">
                                            <i class="fa fa-trash-o"></i> <span class="visible-xs-inline">{{{ trans('action.delete') }}}</span>
                                        </a>
                                    </li>

                                @endif

                                <li>
                                    <button class="btn btn-primary navbar-btn" data-toggle="tooltip" data-original-title="{{{ trans('action.save') }}}">
                                        <i class="fa fa-save"></i> <span class="visible-xs-inline">{{{ trans('action.save') }}}</span>
                                    </button>
                                </li>

                            </ul>

                        </div>

                    </div>

                </nav>

            </header>

            <div class="panel-body">

                <div role="tabpanel">

                    {{-- Form: Tabs --}}
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active" role="presentation"><a href="#general-tab" aria-controls="general-tab" role="tab" data-toggle="tab">{{{ trans('platform/attributes::common.tabs.general') }}}</a></li>
                    </ul>

                    <div class="tab-content">

                        {{-- Tab: General --}}
                        <div role="tabpanel" class="tab-pane fade in active" id="general-tab">

                            <div class="row">

                                <div class="col-lg-5">

                                    <fieldset>

                                        <legend>{{{ trans('platform/attributes::model.general.legend') }}}</legend>

                                        <div class="row">

                                            <div class="col-lg-6">

                                                {{-- Name --}}
                                                <div class="form-group{{ Alert::onForm('name', ' has-error') }}">

                                                    <label for="name" class="control-label">
                                                        <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/attributes::model.general.name_help') }}}"></i>
                                                        {{{ trans('platform/attributes::model.general.name') }}}
                                                    </label>

                                                    <input type="text" class="form-control" name="name" id="name" placeholder="{{{ trans('platform/attributes::model.general.name') }}}" value="{{{ request()->old('name', $attribute->name) }}}" data-slugify="#slug" required data-parsley-trigger="change">

                                                    <span class="help-block">{{{ Alert::onForm('name') }}}</span>

                                                </div>

                                            </div>

                                            <div class="col-lg-6">

                                                {{-- Slug --}}
                                                <div class="form-group{{ Alert::onForm('slug', ' has-error') }}">

                                                    <label for="slug" class="control-label">
                                                        <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/attributes::model.general.slug_help') }}}"></i>
                                                        {{{ trans('platform/attributes::model.general.slug') }}}
                                                    </label>

                                                    <input type="text" class="form-control" name="slug" id="slug" placeholder="{{{ trans('platform/attributes::model.general.slug') }}}" value="{{{ request()->old('slug', $attribute->slug) }}}" required data-parsley-trigger="change">

                                                    <span class="help-block">{{{ Alert::onForm('slug') }}}</span>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-lg-6">

                                                {{-- Namespace --}}
                                                <div class="form-group{{ Alert::onForm('namespace', ' has-error') }}">

                                                    <label for="namespace" class="control-label">
                                                        <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/attributes::model.general.namespace_help') }}}"></i>
                                                        {{{ trans('platform/attributes::model.general.namespace') }}}
                                                    </label>

                                                    <select class="form-control" name="namespace" id="namespace">
                                                        <option value="">Select a namespace...</option>
                                                        @foreach ($namespaces as $namespace)
                                                            <option {{ request()->old('namespace', request()->get('namespace', $attribute->namespace)) === $namespace ? ' selected="selected"' : null}} value="{{{ $namespace }}}">{{{ $namespace }}}</option>
                                                        @endforeach
                                                    </select>

                                                    <span class="help-block">{{{ Alert::onForm('namespace') }}}</span>

                                                </div>

                                            </div>

                                            <div class="col-lg-6">

                                                {{-- Status --}}
                                                <div class="form-group{{ Alert::onForm('enabled', ' has-error') }}">

                                                    <label for="enabled" class="control-label">
                                                        <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/attributes::model.general.enabled_help') }}}"></i>
                                                        {{{ trans('platform/attributes::model.general.enabled') }}}
                                                    </label>

                                                    <select class="form-control" name="enabled" id="enabled" required data-parsley-trigger="change">
                                                        <option value="1"{{ input()->old('enabled', $attribute->enabled) == 1 ? ' selected="selected"' : null}}>{{{ trans('common.enabled') }}}</option>
                                                        <option value="0"{{ input()->old('enabled', $attribute->enabled) == 0 ? ' selected="selected"' : null}}>{{{ trans('common.disabled') }}}</option>
                                                    </select>

                                                    <span class="help-block">{{{ Alert::onForm('status') }}}</span>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-12">

                                                {{-- Description --}}
                                                <div class="form-group{{ Alert::onForm('description', ' has-error') }}">

                                                    <label for="description" class="control-label">
                                                        <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/attributes::model.general.description_help') }}}"></i>
                                                        {{{ trans('platform/attributes::model.general.description') }}}
                                                    </label>

                                                    <input type="text" class="form-control" name="description" id="description" placeholder="{{{ trans('platform/attributes::model.general.description') }}}" value="{{{ request()->old('description', $attribute->description) }}}" required data-parsley-trigger="change">

                                                    <span class="help-block">{{{ Alert::onForm('description') }}}</span>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="row visible-relation {{ $attribute->type == 'relation' ? '' : 'hidden' }}">

                                            <div class="col-md-12">

                                                {{-- Relation --}}
                                                <div class="form-group{{ Alert::onForm('relation', ' has-error') }}">

                                                    <label for="relation" class="control-label">
                                                        <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/inputs::model.general.relation_help') }}}"></i>
                                                        {{{ trans('sanatorium/inputs::model.general.relation') }}}
                                                    </label>

                                                    <?php
                                                    $selected_relation_slug = null;
                                                    if ( $relation = Sanatorium\Inputs\Models\Relation::where('attribute_id', $attribute->id)->first() )
                                                    {
                                                        $selected_relation_slug = $relation->relation;
                                                    }
                                                    ?>
                                                    <select name="relation" class="form-control" id="relation">
                                                        <option>{{ trans('sanatorium/inputs::model.general.relation_placeholder') }}</option>
                                                        @foreach( app('sanatorium.inputs.relations')->getRelations() as $key => $value )
                                                            <option value="{{ $key }}" {{ $key == $selected_relation_slug ? 'selected' : '' }}>{{ $value }}</option>
                                                        @endforeach
                                                    </select>

                                                    <span class="help-block">{{{ Alert::onForm('relation') }}}</span>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="row visible-relation {{ $attribute->type == 'relation' ? '' : 'hidden' }}" data-type-visible>

                                            <div class="col-md-12">

                                                {{-- Multiple--}}
                                                <div class="form-group{{ Alert::onForm('multiple', ' has-error') }}">

                                                    <label for="multiple" class="control-label">
                                                        <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/inputs::model.general.multiple_help') }}}"></i>
                                                        {{{ trans('sanatorium/inputs::model.general.multiple') }}}
                                                    </label>

                                                    <?php
                                                    $selected_relation_slug = null;
                                                    if ( $relation = Sanatorium\Inputs\Models\Relation::where('attribute_id', $attribute->id)->first() )
                                                    {
                                                        $selected_relation_slug = $relation->relation;
                                                    }
                                                    ?>
                                                    <select name="multiple" class="form-control" id="multiple">
                                                        <option value="0" {{ is_object($relation) ? $relation->multiple ? '' : 'selected' : '' }}>{{ trans('common.no') }}</option>
                                                        <option value="1" {{ is_object($relation) ? $relation->multiple ? 'selected' : '' : '' }}>{{ trans('common.yes') }}</option>
                                                    </select>

                                                    <span class="help-block">{{{ Alert::onForm('multiple') }}}</span>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-12">

                                                {{-- Group --}}
                                                <div class="form-group{{ Alert::onForm('group', ' has-error') }}">

                                                    <label for="description" class="control-label">
                                                        <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/inputs::model.general.group_help') }}}"></i>
                                                        {{{ trans('sanatorium/inputs::model.general.group') }}}
                                                    </label>

                                                    <?php
                                                    $selected_group_ids = [];
                                                    foreach ( $group = Sanatorium\Inputs\Models\Group::whereHas('attributes', function($query) use ($attribute) {
                                                        $query->where('attribute_id', $attribute->id);
                                                    })->get() as $group) {
                                                          $selected_group_ids[] = $group->id;
                                                    }
                                                    ?>
                                                    <select name="group[]" class="form-control" multiple>
                                                        <option>{{ trans('sanatorium/inputs::model.general.group_placeholder') }}</option>
                                                        @foreach( \Sanatorium\Inputs\Models\Group::all() as $group )
                                                            <option value="{{ $group->id }}" {{ in_array($group->id, $selected_group_ids) ? 'selected' : '' }}>{{ $group->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    <span class="help-block">{{{ Alert::onForm('group') }}}</span>

                                                </div>

                                            </div>

                                        </div>

                                        <div id="type-settings">

                                        </div>

                                    </fieldset>

                                </div>

                                <div class="col-lg-7">

                                    <fieldset>

                                        <legend>{{{ trans('platform/attributes::model.types.legend') }}}</legend>

                                        <div class="row">

                                            <div class="col-md-12">

                                                {{-- Type --}}
                                                <div class="form-group{{ Alert::onForm('type', ' has-error') }}">

                                                    <label for="type" class="control-label">
                                                        <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/attributes::model.types.type_help') }}}"></i>
                                                        {{{ trans('platform/attributes::model.types.type') }}}
                                                    </label>

                                                    <select class="form-control" name="type" id="type" data-selectize-disabled required data-parsley-trigger="change">
                                                        <option value="">Select a type...</option>
                                                        @foreach ($types as $type)
                                                            <option data-allow-options="{{ $type->allowOptions() ?: 0 }}"{{ request()->old('type', $attribute->type) === $type->getIdentifier() ? ' selected="selected"' : null }} value="{{{ $type->getIdentifier() }}}">{{{ $type->getName() }}}</option>
                                                        @endforeach
                                                    </select>

                                                    <span class="help-block">{{{ Alert::onForm('type') }}}</span>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="hide" data-no-options>

                                            <div class="jumbotron hidden-repeater" data-options data-type-hidden>
                                                <h4 class="text-center">{{{ trans('platform/attributes::message.options_not_allowed') }}}</h4>
                                            </div>

                                        </div>

                                        <div class="hide hidden-repeater" data-options data-type-hidden>

                                            <div class="form-group{{ Alert::onForm('options', ' has-error') }}">

                                                <span class="help-block">{{{ Alert::onForm('options') }}}</span>

                                                <ol class="options list-group"></ol>

                                            </div>

                                        </div>

                                        <div id="repeater" class="visible-repeater" data-type-visible>
                                            <table class="table table-repeater">
                                                <thead>
                                                    <tr>
                                                        <th>Label</th>
                                                        <th>Type</th>
                                                        <th class="text-right">
                                                            <button type="button" class="btn btn-link btn-sm" @click="debug = !debug">
                                                                Debug
                                                            </button>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="field in options.fields">
                                                        <td>
                                                            <input v-model="field.label" class="form-control" @change="storeSettings()" data-parsley-ui-enabled="false">
                                                        </td>
                                                        <td>
                                                            <select v-model="field.type" class="form-control" @change="storeSettings()" data-selectize-disabled data-parsley-ui-enabled="false">
                                                                @foreach ($types as $type)
                                                                    @if ( in_array($type->getIdentifier(), ['input', 'country']) )
                                                                    <option value="{{{ $type->getIdentifier() }}}">{{{ $type->getName() }}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td class="text-right">
                                                            <button type="button" @click="add($index, field)" class="btn btn-default">
                                                                <span class="sr-only">{{ trans('action.add') }}</span>
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                            <button type="button" @click="remove(field)" class="btn btn-default">
                                                                <span class="sr-only">{{ trans('action.delete') }}</span>
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div v-show="debug">
                                                <pre style="font-size:9px;">@{{ $data | json }}</pre>
                                            </div>
                                        </div>

                                    </fieldset>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="panel-footer" style="background-color:#f2f2f2;padding:0;">

                {{-- Translations --}}
                {{-- @todo: put this to localization package --}}
                @if ( function_exists('transattr') && $mode == 'update' )

                    <fieldset class="tab-content" style="margin-bottom:0;">

                        <div class="row">
                            <div class="col-md-12">
                                <legend>{{ trans('sanatorium/localization::translations/common.title') }}</legend>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-5">

                                @if ( App::bound('sanatorium.localization.language') )

                                    @foreach( app('sanatorium.localization.language')->findAll() as $language )

                                        <div class="form-group{{ Alert::onForm('name', ' has-error') }}">

                                            <label for="name" class="control-label">
                                                {{{ trans('platform/attributes::model.general.name') }}} <small>({{ $language->locale }})</small>
                                            </label>

                                            <input type="text"
                                                   class="form-control"
                                                   name="translations[name][{{ $language->locale }}]"
                                                   id="name"
                                                   placeholder="{{{ trans('platform/attributes::model.general.name') }}} ({{ $language->locale }})"
                                                   value="{{{ transattr($attribute->slug, $attribute->name, $language->locale) }}}"
                                                   data-parsley-trigger="change">

                                            <span class="help-block">{{{ Alert::onForm('name') }}}</span>

                                        </div>

                                    @endforeach

                                    @foreach( app('sanatorium.localization.language')->findAll() as $language )

                                        <div class="form-group{{ Alert::onForm('description', ' has-error') }}">

                                            <label for="description" class="control-label">
                                                {{{ trans('platform/attributes::model.general.description') }}} <small>({{ $language->locale }})</small>
                                            </label>

                                            <input type="text"
                                                   class="form-control"
                                                   name="translations[description][{{ $language->locale }}]"
                                                   id="description"
                                                   placeholder="{{{ trans('platform/attributes::model.general.description') }}} ({{ $language->locale }})"
                                                   value="{{{ transattr($attribute->slug, $attribute->description, $language->locale, 'description') }}}"
                                                   data-parsley-trigger="change">

                                            <span class="help-block">{{{ Alert::onForm('description') }}}</span>

                                        </div>

                                    @endforeach

                                @endif

                            </div>

                            <div class="col-md-7">

                                @if ( $attribute->options )

                                    @foreach( app('sanatorium.localization.language')->findAll() as $language )

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th colspan="3">{{ $language->name }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach( $attribute->options as $slug => $value )
                                                    @if ( is_string($slug) )
                                                    <tr>
                                                        <td>
                                                            {{ $language->locale }}
                                                        </td>
                                                        <td>
                                                            {{ $slug }}
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="translations[options][{{ $language->locale }}][{{ $slug }}]"
                                                                   id="description"
                                                                   placeholder="{{{ $slug }}} ({{ $language->locale }})"
                                                                   value="{{{ transattr($attribute->slug, $slug, $language->locale, 'options', $slug) }}}"
                                                                   data-parsley-trigger="change">
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>

                                    @endforeach

                                @endif

                            </div>

                        </div>

                    </fieldset>

                @endif

            </div>

        </form>

    </section>

    <script type="text/template" data-option-template>

        <li>

            <div class="form-inline">

                <div class="form-group">

                    <div class="input-group handle">
                        <div class="input-group-addon" data-option-move><i class="fa fa-arrows"></i></div>

                        <input class="form-control" id="label" name="options[<%= id %>][label]" type="text" value="<%= label %>" data-slugify="#option-<%= id %>" placeholder="{{{ trans('platform/attributes::model.types.option_label') }}}" data-parsley-ui-enabled="false">
			</div>

			<input class="form-control" id="option-<%= id %>" name="options[<%= id %>][value]" type="text" value="<%= value %>" placeholder="{{{ trans('platform/attributes::model.types.option_value') }}}" data-parsley-ui-enabled="false">

			<button class="btn btn-md btn-default" data-option-add><i class="fa fa-plus"></i></button>
			<button class="btn btn-md btn-default" data-option-remove><i class="fa fa-trash-o"></i></button>

		</div>

	</div>

</li>

</script>
@stop
