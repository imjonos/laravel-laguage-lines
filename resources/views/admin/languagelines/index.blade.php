@component('nos.crud::index', [
    'componentName' => 'languageline',
    'selected' => $selected,
    'path' => 'nos.languageline::'
])
    @section('buttons')
        <a class="btn btn-primary" @click="scan()">
            {{ trans('nos.languageline::crud.languageline.scan') }}
        </a>
    @endsection
@endcomponent
