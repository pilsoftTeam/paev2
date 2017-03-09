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

        <el-dialog title="Asignar Checklist" v-model="assignChecklistToBodega" size="small">


            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <el-select v-model="selectedItems.idChecklist" style="width: 99%"
                               placeholder="Seleccione un checklist">
                        <el-option
                                v-for="item in checklists"
                                :key="item.id"
                                :label="item.nombre"
                                :value="item.id">
                        </el-option>
                    </el-select>
                </div>
            </div>

            <span slot="footer" class="dialog-footer">
                <el-button @click="assignChecklistToBodega = false">Cancelar</el-button>
                <el-button type="primary" @click="saveChecklist">Guardar</el-button>
          </span>
        </el-dialog>
        <el-dialog title="Editar checklist" v-model="editChecklistToBodega" size="small">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <el-select v-model="selectedItems.idChecklist" style="width: 99%"
                               placeholder="Seleccione un checklist">
                        <el-option
                                v-for="item in checklists"
                                :key="item.id"
                                :label="item.nombre"
                                :value="item.id">
                        </el-option>
                    </el-select>
                </div>
            </div>
            <span slot="footer" class="dialog-footer">
                <el-button @click="editChecklistToBodega = false">Cancelar</el-button>
                <el-button type="primary" @click="saveChecklist">Guardar</el-button>
          </span>
        </el-dialog>


        <el-dialog title="Remover checklist de bodega" v-model="removeChecklistToBodega" size="tiny">

            <h4>Atencion</h4>
            <p>¿ Esta seguro que desea remover el checklist asignado ?</p>


            <span slot="footer" class="dialog-footer">
                <el-button @click="removeChecklistToBodega = false">Cancelar</el-button>
                <el-button type="danger" @click="deleteAssignment">Remover</el-button>
          </span>
        </el-dialog>


    </div>
</template>
<script>
    import dataSource from 'vue-datasource'
    export default {
        mounted(){
            this.init();
            this.getChecklists();
        },
        data () {
            let self = this;
            return {
                selectedItems: {
                    idBodega: '',
                    idChecklist: ''
                },
                checklists: '',
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
                            if (row) {
                                self.initAssign(row);
                            }

                        }
                    },
                    {
                        text: 'Editar Checklists asignado',
                        icon: 'fa fa-pencil',
                        class: 'btn-warning btn-sm',
                        event(e, row) {
                            if (row.row.idChecklist) {
                                self.editAssign(row);
                            } else {
                                self.warning('Esta bodega aun no tiene un checklist asignado.  No se puede editar');
                            }

                        }
                    },
                    {
                        text: 'Remover checklist',
                        icon: 'fa fa-times',
                        class: 'btn-danger btn-sm',
                        event(e, row) {
                            if (row.row.idChecklist) {
                                self.removeAssign(row);
                            } else {
                                self.warning('Esta bodega aun no tiene un checklist asignado.  No se puede remover la asignacion');
                            }
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
            getChecklists(){

                axios.get('api/get/checklists').then(r => {
                    this.checklists = r.data;
                }).catch(e => {
                    console.log(e)
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
                this.selectedItems.idBodega = row.row.id;
                this.assignChecklistToBodega = true;
            },
            editAssign(row){
                this.selectedItems.idBodega = row.row.id;
                this.selectedItems.idChecklist = row.row.idChecklist;
                this.editChecklistToBodega = true;
            },
            removeAssign(row){
                this.selectedItems.idBodega = row.row.id;
                this.removeChecklistToBodega = true;
            },

            saveChecklist(){
                axios.put('api/assign/checklist', this.selectedItems).then(r => {
                    this.assignChecklistToBodega = false;
                    this.editChecklistToBodega = false;
                    this.success();
                    this.init();
                }).catch(e => {
                    this.error(e);
                })
            },
            deleteAssignment(){
                axios.put('api/delete/assignment', this.selectedItems).then(r => {
                    this.removeChecklistToBodega = false;
                    this.success();
                    this.init();
                }).catch(e => {
                    this.error(e);
                })
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
            warning(message){
                this.$notify({
                    title: 'Atención',
                    message: message,
                    type: 'warning'
                });
            }


        },
        components: {
            'data-source': dataSource
        }
    }
</script>
