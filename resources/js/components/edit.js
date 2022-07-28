import MixinsEdit from '../../crud/mixins/edit.js'

Vue.component('languageline-edit', {
    data() {
        return {
            link: '/admin/languagelines',
        }
    },
    mixins: [MixinsEdit]
});
