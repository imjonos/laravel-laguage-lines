@foreach($languages AS $lang => $dir)
    @component('nos.crud::fields.text', [
        'required' => 1,
        'label' => $lang,
        'vModel' => 'form.text.'.$lang,
        'name' => 'text',
        'placeholder' => trans('nos.languageline::crud.languageline.columns.text')
    ])
    @endcomponent
@endforeach
