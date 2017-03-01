<template>
    <div>
        <div class="row">
            <h6 class="text-center">CHECKLIST : {{selectedChecklist.nombre}}</h6>
            <hr>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <h4 class="pull-left">Items</h4>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <el-button @click="showAddItems = true"
                                   type="success"
                                   size="small"
                                   class="pull-right"
                                   title="Añadir un nuevo item">
                            <i class="el-icon-plus"></i>
                        </el-button>
                    </div>
                </div>

                <div class="list-group">
                    <a href="#"
                       class="list-group-item"
                       v-for="item in items"
                       :key="item.id">
                        {{item.nombre}}
                        <hr>
                        <div class="btn-group btn-block">
                            <button type="button"
                                    class="btn btn-warning btn-sm"
                                    @click="showEditDialog(item)"
                                    title="Editar este item">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                            <button type="button"
                                    class="btn btn-sm btn-danger"
                                    @click="showDeleteDialog(item.id)"
                                    title="Eliminar este item">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm pull-right" title="Cargar este item">
                                <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                    </a>

                </div>
            </div>
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <h4>Agrupaciones y evaluaciones</h4>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <el-dialog title="Añadir un nuevo item" v-model="showAddItems" size="small">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <el-form :model="newItem" :rules="rules" ref="newItem">
                        <el-form-item label="Nombre del item" prop="name">
                            <el-input type="text" v-model="newItem.name"></el-input>
                        </el-form-item>
                    </el-form>
                </div>
            </div>
            <span slot="footer" class="dialog-footer">
                <el-button @click="showAddItems = false">Cancelar</el-button>
                <el-button type="primary" @click="submitForm('newItem')">Confirmar</el-button>
            </span>
        </el-dialog>

        <el-dialog title="Eliminar item" v-model="deleteItemDialog" size="tiny">
            <h4>Borrar este item</h4>
            <p>Al borrar este item se perderan todas las agrupaciones y evaluaciones que contenian este elemento. Se
                recomienda exportar a excel</p>
            <span slot="footer" class="dialog-footer">
                <el-button @click="dialogVisible = false">Cancelar</el-button>
                <el-button type="danger" @click="deleteItem">Eliminar</el-button>
            </span>
        </el-dialog>

    </div>
</template>
<script>
    export default {
        mounted(){
            this.getItems();
        },
        data () {
            return {
                items: '',
                newItem: {
                    idChecklist: '',
                    name: ''
                },
                selectedIdforDeletion: '',
                showAddItems: false,
                deleteItemDialog: false,
                rules: {
                    name: [
                        {required: true, message: 'Por favor escriba algo', trigger: 'blur'},
                        {
                            min: 3,
                            max: 999,
                            message: 'El texto debe ser mas de 3 y menor de 999 caracteres',
                            trigger: 'blur'
                        }
                    ],
                }
            }
        },
        props: {
            selectedChecklist: {
                type: Object,
                required: true
            }
        },
        methods: {
            getItems(){
                axios.get('api/get/items/' + this.selectedChecklist.id).then(r => {
                    this.items = r.data;
                }).catch(e => {
                    console.log(e)
                })
            },
            submitForm(formName){
                this.$refs[formName].validate(valid => {
                    if (valid) {
                        let data = this.newItem;
                        data.idChecklist = this.selectedChecklist.id;
                        axios.post('api/create/item', data).then(r => {
                            this.showAddItems = false;
                            data.idChecklist = '';
                            data.name = '';
                            this.getItems();
                            this.success();
                        }).catch(e => {
                            this.error(e);
                        })
                    } else {
                        return false;
                    }
                })
            },

            showEditDialog(item){
                console.log(item);
            },
            showDeleteDialog(id){
                this.deleteItemDialog = true;
                this.selectedIdforDeletion = id;
            },

            deleteItem(){
                axios.delete('api/delete/item/' + this.selectedIdforDeletion).then(r => {
                    this.selectedIdforDeletion = '';
                    this.deleteItemDialog = false;
                    this.getItems();
                    this.success();
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
                    message: 'Error :' + error,
                    type: 'error'
                });
            }
        }
    }
</script>
