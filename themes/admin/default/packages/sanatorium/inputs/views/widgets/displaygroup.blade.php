@section('styles')
    @parent
    <style type="text/css">
        .table-displaygroup {
            table-layout: fixed;
            width: 100%;
        }
        .table-displaygroup-label {
            width: 150px;
            word-wrap: break-word;
        }
        .table-displaygroup-value img {
            max-width: 100%;
        }
    </style>
@stop

{{-- Display group --}}
@if ( $style == 'table' )

    <table class="table table-displaygroup table-displaygroup-{{ $group->id }}"
           summary="{{ $group->name }}">
        <tbody>
        @foreach( $group->attributes as $attribute )
            <?php $contents = Widget::make('sanatorium/inputs::display.show', [$entity, $attribute->slug, null, 'view']); ?>
            @if ( ($show_empty || trim($contents)) && !in_array($attribute->slug, $hide_slugs) && !in_array($attribute->type, $hide_types) )
                <tr>
                    <th class="table-displaygroup-cell table-displaygroup-label table-displaygroup-{{ $attribute->type }}" id="group-{{ $group->id }}-{{ $attribute->slug }}">{{ transattr($attribute->slug, $attribute->name) }}</th>
                    <td class="table-displaygroup-cell table-displaygroup-value table-displaygroup-{{ $attribute->type }}" headers="group-{{ $group->id }}-{{ $attribute->slug }}">{!! $contents !!}</td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>

@else

    @foreach( $group->attributes as $attribute )
        <?php $contents = Widget::make('sanatorium/inputs::display.show', [$entity, $attribute->slug, null, 'view']); ?>
        @if ( ($show_empty || trim($contents)) && !in_array($attribute->slug, $hide_slugs) && !in_array($attribute->type, $hide_types) )
            {!! $contents !!}
        @endif
    @endforeach

@endif


