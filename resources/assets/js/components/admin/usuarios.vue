<template>
    <div class="row">
        <data-source
                language="es"
                :table-data="information.data"
                :columns="columns"
                :pagination="information.pagination"
                :actions="actions"
                @change="changePage"
                @searching="onSearch"></data-source>
    </div>
</template>
<script>
    import dataSource from 'vue-datasource'
    export default {
        mounted(){
            this.init();
        },
        data () {
            let self = this;
            return {
                information: {
                    pagination: {},
                    data: []
                },
                columns: [
                    {
                        name: 'Nombre',
                        key: 'name',
                    },
                    {
                        name: 'Email',
                        key: 'email',
                    },
                    {
                        name: 'Rol',
                        key: 'rol',
                    },

                ],
                actions: [
                    {
                        text: 'Editar Usuario',
                        icon: 'fa fa-pencil',
                        class: 'btn-warning btn-sm',
                        event(e, row) {
                            console.log(row)
                        }
                    },
                    {
                        text: 'Remover checklist',
                        icon: 'fa fa-times',
                        class: 'btn-danger btn-sm',
                        event(e, row) {
                            console.log(row)
                        }
                    },
                ],


            }
        },
        methods: {

            init(){
                axios.get('api/traer/usuarios').then(r => {
                    console.log(r.data)
                }).catch(e => {
                    console.log(e)
                })
            },
            changePage(e){

            },
            onSearch(e){

            },
            success(){
                this.$notify({
                    title: 'Exito',
                    message: 'La operacion se ha completado con exito',
                    type: 'success'
                });
            },
            error(error){
                this.$notify({
                    title: 'Error',
                    message: 'Error : ' + error,
                    type: 'error'
                });
            },
        },
        components: {
            'data-source': dataSource
        }
    }
</script>
