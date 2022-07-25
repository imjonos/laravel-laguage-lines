<div class="row">
	<div class="col-md-3">
	@component('nos.crud::fields.text', [
	'required' => 0
])
    @slot('label')
        @lang('nos.languageline::languageline.table.columns.id')
    @endslot
    @slot('vModel')
        form.id
    @endslot
    @slot('name')
        id
    @endslot
    @slot('placeholder')
     	@lang('nos.languageline::languageline.table.columns.id')
    @endslot
@endcomponent

</div>
<div class="col-md-3">
	@component('nos.crud::fields.text', [
	'required' => 0
])
    @slot('label')
        @lang('nos.languageline::languageline.table.columns.group')
    @endslot
    @slot('vModel')
        form.group
    @endslot
    @slot('name')
        group
    @endslot
    @slot('placeholder')
     	@lang('nos.languageline::languageline.table.columns.group')
    @endslot
@endcomponent

</div>
<div class="col-md-3">
	@component('nos.crud::fields.text', [
	'required' => 0
])
    @slot('label')
        @lang('nos.languageline::languageline.table.columns.key')
    @endslot
    @slot('vModel')
        form.key
    @endslot
    @slot('name')
        key
    @endslot
    @slot('placeholder')
     	@lang('nos.languageline::languageline.table.columns.key')
    @endslot
@endcomponent

</div>
<div class="col-md-3">
	@component('nos.crud::fields.text', [
	'required' => 0
])
    @slot('label')
        @lang('nos.languageline::languageline.table.columns.text')
    @endslot
    @slot('vModel')
        form.text
    @endslot
    @slot('name')
        text
    @endslot
    @slot('placeholder')
     	@lang('nos.languageline::languageline.table.columns.text')
    @endslot
@endcomponent

</div>

</div>
