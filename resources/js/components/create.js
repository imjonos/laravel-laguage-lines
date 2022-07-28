import MixinsCreate from '../../crud/mixins/create.js'

Vue.component('languageline-create', {
    data() {
        return {
            link: '/admin/languagelines',
            form: {
                text: {}
            },
        }
    },
    mixins: [MixinsCreate]
});
