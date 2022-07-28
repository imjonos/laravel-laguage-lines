import MixinsIndex from '../../crud/mixins/index.js'

Vue.component('languageline-index', {
    data() {
        return {
            link: '/admin/languagelines',
        }
    },
    mixins: [MixinsIndex],
    methods: {
        scan() {//запрос на добавление новых переводов из файлов
            if (this.loading) return;
            this.loading = true;
            axios.post('/admin/languagelines/scan')
                .then(response => {
                    this.loading = false;
                    this.getData();
                })
                .catch(error => {
                    this.loading = false;
                });
        }
    }
});
