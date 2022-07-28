@component('nos.crud::create', [
    'componentName' => 'languageline',
    'path' => 'nos.languageline::'
])
    @slot('inputs')
        @component('nos.crud::fields.text', [
            'required' => 1
        ])
            @slot('label')
                @lang('nos.languageline::crud.languageline.columns.group')
            @endslot
            @slot('vModel')
                form.group
            @endslot
            @slot('name')
                group
            @endslot
            @slot('placeholder')
                @lang('nos.languageline::crud.languageline.columns.group')
            @endslot
        @endcomponent
        @component('nos.crud::fields.text', [
            'required' => 1
        ])
            @slot('label')
                @lang('nos.languageline::crud.languageline.columns.key')
            @endslot
            @slot('vModel')
                form.key
            @endslot
            @slot('name')
                key
            @endslot
            @slot('placeholder')
                @lang('nos.languageline::crud.languageline.columns.key')
            @endslot
        @endcomponent
        @include("nos.languageline::admin.languagelines.input-translations")
    @endslot
@endcomponent
