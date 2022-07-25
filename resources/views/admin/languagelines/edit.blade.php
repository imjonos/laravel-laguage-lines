@extends('nos.crud::layouts.app')

@section('title', trans('nos.languageline::languageline.table.title'))

@section('content')

    <languageline-edit
        :data="{{ $data }}"
        inline-template>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a
                            href="{{ route("languagelines.index") }}">@lang('nos.languageline::languageline.table.title')</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('crud.buttons.edit') №@{{ data.id }}
                    </li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">
                    @lang('crud.buttons.edit') №@{{ data.id }}
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            @component('nos.crud::fields.text', [
    'required' => 1
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
                            @component('nos.crud::fields.text', [
                                'required' => 1
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
                            @include("nos.languageline::admin.languagelines.input-translations")


                            <div class="text-right">
                                <button class="btn btn-primary" @click="update">
                                    <i v-if="loading" class="fas fa-pulse fa-spinner"></i>
                                    @lang('crud.buttons.save')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </languageline-edit>
@endsection
