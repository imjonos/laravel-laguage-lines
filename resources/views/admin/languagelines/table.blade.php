<div class="table-responsive mb-3">
    <table class="table">
        <thead>
        <tr>
            <th>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="selectAll" @change="selectAll"
                           v-model="allSelected" :value="true">
                    <label class="custom-control-label" for="selectAll"></label>
                </div>
            </th>
            @component('codersstudio.crud::th', [
                'order' => true
            ])
                @slot('columnName')
                    id
                @endslot
                @slot('title')
                    @lang('codersstudio.languageline::languageline.table.columns.id')
                @endslot
            @endcomponent
            @component('codersstudio.crud::th', [
                'order' => true
            ])
                @slot('columnName')
                    group
                @endslot
                @slot('title')
                    @lang('codersstudio.languageline::languageline.table.columns.group')
                @endslot
            @endcomponent
            @component('codersstudio.crud::th', [
                'order' => true
            ])
                @slot('columnName')
                    key
                @endslot
                @slot('title')
                    @lang('codersstudio.languageline::languageline.table.columns.key')
                @endslot
            @endcomponent
            @component('codersstudio.crud::th', [
                'order' => true
            ])
                @slot('columnName')
                    text
                @endslot
                @slot('title')
                    @lang('codersstudio.languageline::languageline.table.columns.text')
                @endslot
            @endcomponent

            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in data.data">
            <td>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" :id="'check' + item.id" v-model="selected"
                           :value="item.id" @change="checkItem">
                    <label class="custom-control-label" :for="'check' + item.id"></label>
                </div>
            </td>
            <td>
                @{{ item.id }}
            </td>
            <td>
                @{{ item.group }}
            </td>
            <td>
                @{{ item.key }}
            </td>
            <td>
                <template v-for="(lang, index) in item.text">
                    <div>@{{ index }}: @{{ lang }}</div>
                </template>
            </td>

            <td class="nowrap">
                <a class="btn btn-primary btn-sm" :href="'/admin/languagelines/' + item.id + '/edit'"
                   data-toggle="tooltip" data-placement="top" title="@lang('crud.buttons.edit')">
                    <i class="fas fa-pen-square"></i>
                </a>
                <button class="btn btn-danger btn-sm" @click="destroy(item.id)" data-toggle="tooltip"
                        data-placement="top" title="@lang('crud.buttons.delete')">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<b-pagination
    v-model="data.current_page"
    :total-rows="data.total"
    :per-page="data.per_page"
    @change="getData"
></b-pagination>
