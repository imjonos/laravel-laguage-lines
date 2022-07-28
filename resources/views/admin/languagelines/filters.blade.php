@component('nos.crud::filters')
    @slot('inputs')
        @component('nos.crud::filter')
            @slot('input')
                @component('nos.crud::fields.text', [
	                'required' => 0
                ])
                    @slot('label')
                        @lang('nos.languageline::crud.languageline.columns.id')
                    @endslot
                    @slot('vModel')
                        form.id
                    @endslot
                    @slot('name')
                        id
                    @endslot
                    @slot('placeholder')
                        @lang('nos.languageline::crud.languageline.columns.id')
                    @endslot
                @endcomponent
            @endslot
        @endcomponent
        @component('nos.crud::filter')
            @slot('input')
                @component('nos.crud::fields.text', [
                'required' => 0
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

            @endslot
        @endcomponent
        @component('nos.crud::filter')
            @slot('input')
                @component('nos.crud::fields.text', [
                'required' => 0
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
            @endslot
        @endcomponent
        @component('nos.crud::filter')
            @slot('input')
                @component('nos.crud::fields.text', [
                'required' => 0
            ])
                    @slot('label')
                        @lang('nos.languageline::crud.languageline.columns.text')
                    @endslot
                    @slot('vModel')
                        form.text
                    @endslot
                    @slot('name')
                        text
                    @endslot
                    @slot('placeholder')
                        @lang('nos.languageline::crud.languageline.columns.text')
                    @endslot
                @endcomponent
            @endslot
        @endcomponent
    @endslot
@endcomponent
