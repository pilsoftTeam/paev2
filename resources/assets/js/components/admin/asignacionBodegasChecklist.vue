<template>
    <div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <data-source
                        language="es"
                        :table-data="information.data"
                        :columns="columns"
                        :pagination="information.pagination"
                        :actions="actions"
                        @change="changePage"
                        @searching="onSearch"></data-source>
            </div>
        </div>

        <el-dialog title="Tips" v-model="assignChecklistToBodega" size="small">


            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis eius eveniet facere in
                    necessitatibus perspiciatis placeat sed sunt ullam ut. Deserunt laborum odit provident, quae quis
                    reprehenderit ut! Beatae, perspiciatis.
                </div>
            </div>


            <span slot="footer" class="dialog-footer">
                <el-button @click="assignChecklistToBodega = false">Cancel</el-button>
                <el-button type="primary" @click="assignChecklistToBodega = false">Confirm</el-button>
          </span>
        </el-dialog>
        <el-dialog title="Tips" v-model="editChecklistToBodega" size="small">


            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis eius eveniet facere in
                    necessitatibus perspiciatis placeat sed sunt ullam ut. Deserunt laborum odit provident, quae quis
                    reprehenderit ut! Beatae, perspiciatis.
                </div>
            </div>


            <span slot="footer" class="dialog-footer">
                <el-button @click="editChecklistToBodega = false">Cancel</el-button>
                <el-button type="primary" @click="editChecklistToBodega = false">Confirm</el-button>
          </span>
        </el-dialog>
        <el-dialog title="Tips" v-model="removeChecklistToBodega" size="tiny">


            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis eius eveniet facere in
                    necessitatibus perspiciatis placeat sed sunt ullam ut. Deserunt laborum odit provident, quae quis
                    reprehenderit ut! Beatae, perspiciatis.
                </div>
            </div>


            <span slot="footer" class="dialog-footer">
                <el-button @click="removeChecklistToBodega = false">Cancel</el-button>
                <el-button type="primary" @click="removeChecklistToBodega = false">Confirm</el-button>
          </span>
        </el-dialog>


    </div>
</template>
<script>
    import dataSource from 'vue-datasource'
    export default {
        mounted(){
            this.init();
        },
        data () {
            return {
                selectedItem: '',
                assignChecklistToBodega: false,
                editChecklistToBodega: false,
                removeChecklistToBodega: false,
                information: {
                    pagination: {},
                    data: []
                },
                columns: [
                    {
                        name: 'Proveedor',
                        key: 'nombreProveedor',
                    },
                    {
                        name: 'Licitacion',
                        key: 'licitacion',
                    },
                    {
                        name: 'Direccion de la bodega',
                        key: 'direccionBodega',
                    },
                    {
                        name: 'Comuna',
                        key: 'comuna',
                    },
                    {
                        name: 'Region',
                        key: 'region',
                    },
                    {
                        name: 'Checklist Asignado',
                        key: 'get_checklist_name.nombre',
                    },

                ],
                actions: [
                    {
                        text: 'Asignar Checklists',
                        icon: 'fa fa-plus-circle',
                        class: 'btn-info btn-sm',
                        event(e, row) {
                            console.log(e);
                            console.log(row);
                            this.assignChecklistToBodega = true;

                        }
                    },
                    {
                        text: 'Editar Checklists asignado',
                        icon: 'fa fa-pencil',
                        class: 'btn-warning btn-sm',
                        event(e, row) {
                            console.log('Click row: ', row);
                        }
                    },
                    {
                        text: 'Remover checklist',
                        icon: 'fa fa-times',
                        class: 'btn-danger btn-sm',
                        event(e, row) {
                            console.log('Click row: ', row);
                        }
                    },
                ],


            }
        },
        methods: {
            init(){
                axios.get('api/admin/get/bodegas/' + 15).then(r => {
                    _.forEach(r.data.data, d => {
                        if (!d.get_checklist_name) {
                            d.get_checklist_name = {
                                nombre: 'NO ASIGNADO AUN'
                            }
                        }
                    });
                    this.information.data = r.data.data;
                    this.information.pagination = r.data;
                }).catch(e => {
                    console.log(e);
                })
            },
            changePage(values){
                axios.get('api/admin/get/bodegas/' + values.perpage + '?page=' + values.page).then(r => {
                    _.forEach(r.data.data, d => {
                        if (!d.get_checklist_name) {
                            d.get_checklist_name = {
                                nombre: 'NO ASIGNADO AUN'
                            }
                        }
                    });
                    this.information.data = r.data.data
                    this.information.pagination = r.data;
                }).catch(e => {
                    console.log(e);
                })
            },
            onSearch(searchQuery) {
                if (searchQuery) {
                    axios.get('api/admin/get/bodegas/search/' + searchQuery).then(r => {
                        _.forEach(r.data.data, d => {
                            if (!d.get_checklist_name) {
                                d.get_checklist_name = {
                                    nombre: 'NO ASIGNADO AUN'
                                }
                            }
                        });
                        this.information.data = r.data.data
                        this.information.pagination = r.data;
                    }).catch(e => {
                        console.log(e);
                    })
                } else {
                    this.init();
                }

            },

            initAssign(row){
                this.selectedItem = row.row.id;
                this.assignChecklistToBodega = true;
            }
        },
        components: {
            'data-source': dataSource
        }
    }
</script>
