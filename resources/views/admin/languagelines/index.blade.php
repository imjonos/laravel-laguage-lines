@extends('nos.crud::layouts.app')

@section('title', trans('nos.languageline::languageline.table.title'))

@section('content')
	<languageline-index inline-template>
		<div>
			<div class="card mb-3">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center mb-3">
						<div class="font-weight-bold text-uppercase">
							@lang('nos.languageline::languageline.table.title')
						</div>
						<a class="btn btn-primary" href="{{ route("languagelines.create") }}">
							<i class="fas fa-plus"></i>
							@lang('crud.buttons.create')
						</a>
					</div>
					@include('nos.languageline::admin.languagelines.filters')
					<div class="d-flex justify-content-end flex-nowrap">
						<div>
							<button class="btn btn-warning" @click="clearFilters">
								<i class="fas fa-recycle"></i>
								@lang('crud.buttons.clear')
							</button>
							<button class="btn btn-primary" @click="getData(1)">
								<i class="fas fa-search"></i>
								@lang('crud.buttons.search')
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="card" :class="{ loading: loading }">
				<div class="card-body">
					<div class="row justify-content-between align-items-end">
						<div class="col-auto">
							<label for="">@lang('crud.labels.with_selected')</label>
							<div class="mb-3">
								<button class="btn btn-danger" @click="massDestroy">
									<i class="fas fa-trash-alt"></i>
									@lang('crud.buttons.delete')
								</button>
							</div>
						</div>
                        <div class="col-auto">
                            <div class="mb-3">
                                <button class="btn btn-success" @click="scan">
                                    <i class="fas fa-sync-alt" :class="{ 'fas-spin': loading }"></i>
                                    @lang('nos.languageline::languageline.table.scan')
                                </button>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="mb-3">
                                @include('vendor.nos.crud.export', ['route' => route('languagelines.export')])
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="mb-3">
                                @include('vendor.nos.crud.import', ['route' => route('languagelines.import')])
                            </div>
                        </div>

						<div class="col-auto">
							<div class="form-group mt-auto">
								<label for="">@lang('crud.labels.per_page')</label>
								<select class="form-control" v-model="data.per_page" @change="getData(1)">
									<option value="10">10</option>
									<option value="50">50</option>
									<option value="100">100</option>
								</select>
							</div>
						</div>
					</div>
					<div class="text-right mb-3 text-muted">
						@lang('crud.labels.found'): @{{ _.size(data.data) }} @lang('crud.labels.from') @{{ data.total }}
					</div>
					@include('nos.languageline::admin.languagelines.table')
				</div>
			</div>
		</div>
	</languageline-index>
@endsection
