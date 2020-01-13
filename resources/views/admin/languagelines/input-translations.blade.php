@foreach($languages AS $lang => $dir)
    @component('codersstudio.crud::fields.text', [ 'required' => 1])
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
            @lang('codersstudio.languageline::languageline.table.columns.text')
        @endslot
    @endcomponent
@endforeach
