@component('nos.crud::table', [
    'componentName' => 'languageline',
    'columns' => [
      ['name' => 'id', 'order' => true],
      ['name' => 'group', 'order' => true],
      ['name' => 'key', 'order' => true],
      ['name' => 'text', 'order' => true],
      ['name' => 'created_at', 'order' => true],
    ]
])
    @slot('text')
        <template v-for="(lang, index) in item.text">
            <div>@{{ index }}: @{{ lang }}</div>
        </template>
    @endslot
@endcomponent
