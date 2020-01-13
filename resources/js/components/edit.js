Vue.component('languageline-edit', {
    data() {
        return {
            form: this.data,
            loading: false,
            mediaCollections: {}
        }
    },
    props: {
        data: {
            default: () => {
                return {}
            }
        }
    },
    methods: {
        update() {
            if (this.loading) {
                return;
            }
            this.getMedia();
            this.loading = true;
            axios.put('/admin/languagelines/' + this.data.id, this.form)
            .then(response => {
                window.location.href = '/admin/languagelines';
                this.systemMessage('success',{
                    'title':this.trans('crud.actions.info'),
                    'text':this.trans('crud.actions.success.edit')
                });
            })
            .catch(error => {
                this.systemMessage('error',{
                    'title':this.trans('crud.actions.warning'),
                    'text':this.trans('crud.actions.fail.info')
                });
                _.forEach(error.response.data.errors, (item, index) => {
                    this.errors.add({
                        field: index,
                        msg: _.head(item)
                    });
                });
            })
            .finally(() => {
                this.loading = false;
            });
        },
        getMedia() {
            _.forEach(this.$refs, (item, index) => {
                if (item.$refs.dropzone) {
                    this.$set(this.mediaCollections, index, item.$refs.dropzone.getAcceptedFiles());
                }
            });
            this.form = Object.assign({
                'mediaCollections': this.mediaCollections
            }, this.form);
        },
        
    }
});
