@foreach($languages AS $lang => $dir)
    @component('nos.crud::fields.text', [ 'required' => 1])
        @slot('label')
            {{$lang}}
        @endslot
        @slot('vModel')
            form.text.{{$lang}}
        @endslot
        @slot('name')
            text
        @endslot
        @slot('placeholder')
            @lang('nos.languageline::languageline.table.columns.text')
        @endslot
    @endcomponent
@endforeach
