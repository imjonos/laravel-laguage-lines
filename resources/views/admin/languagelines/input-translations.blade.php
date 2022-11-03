@foreach($languages AS $lang)
    @component('nos.crud::fields.text', [
        'required' => 1,
        'label' => $lang->abbr,
        'vModel' => 'form.text.'.$lang->abbr,
        'name' => 'text',
        'placeholder' => trans('nos.languageline::crud.languageline.columns.text')
    ])
    @endcomponent
@endforeach
