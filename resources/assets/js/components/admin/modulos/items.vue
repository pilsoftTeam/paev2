<template>
    <div>
        <div class="row">
            <h6 class="text-center">CHECKLIST : {{selectedChecklist.nombre}}</h6>
            <hr>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-heading">Items</h4>
                        <el-button @click="showAddItems = true"
                                   type="success"
                                   class="pull-right"
                                   size="small"
                                   title="Añadir un nuevo item">
                            <i class="el-icon-plus"></i>
                        </el-button>
                    </div>
                </div>

                <div class="list-group">
                    <a href="##"
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
                                    @click="showDeleteDialog(item.id)"
                                    class="btn btn-sm btn-danger"
                                    title="Eliminar este item">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                            <button type="button"
                                    @click="loadItem(item)"
                                    class="btn btn-success btn-sm pull-right"
                                    title="Cargar este item">
                                <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" v-if="showItems">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>{{selectedItem.nombre}}</h5>
                        <div class="btn-group pull-right">
                            <button type="button"
                                    class="btn btn-default"
                                    title="Crear una agrupacion para este item">
                                <i class="fa fa-cube" aria-hidden="true"></i>
                            </button>
                            <button type="button"
                                    @click="showDialogEvaluacion(selectedItem)"
                                    class="btn btn-default"
                                    title="Crear una evaluacion para este item">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <br>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <h4 class="text-center">Agrupaciones</h4>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title">AAAAA</h5>
                                    </div>
                                    <div class="panel-body">
                                        Panel body ...
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <h4 class="text-center">Evaluaciones</h4>
                                <div v-for="evaluacion in evaluaciones.evaluaciones">
                                    <div class="row">
                                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <p style="word-wrap: break-word">{{evaluacion.evaluacion}}</p>
                                        </div>
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <div class="btn-group">
                                                <button type="button" title="Editar esta evaluacion"
                                                        class="btn btn-warning btn-xs">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" title="Eliminar esta evaluacion"
                                                        class="btn btn-danger btn-xs">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" title="Cargar evaluacion"
                                                        class="btn btn-success btn-xs">
                                                    <i class="fa fa-arrow-circle-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" v-else>
                <h4 class="text-center">Haga click en algun item para cargar informacion</h4>
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
        <el-dialog title="Editar item" v-model="editDialogVisible" size="small">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <el-form :model="selectedItemForEdition" :rules="rules" ref="selectedItemForEdition">
                        <el-form-item label="Nombre del item" prop="nombre">
                            <el-input type="text" v-model="selectedItemForEdition.nombre"></el-input>
                        </el-form-item>
                    </el-form>
                </div>
            </div>
            <span slot="footer" class="dialog-footer">
                <el-button @click="editDialogVisible = false">Cancelar</el-button>
                <el-button type="primary" @click="submitEditedForm('selectedItemForEdition')">Guardar</el-button>
            </span>
        </el-dialog>
        <el-dialog title="Eliminar item" v-model="deleteItemDialog" size="tiny">
            <h4>Borrar este item</h4>
            <p>Al borrar este item se perderan todas las agrupaciones y evaluaciones que contenian este elemento. Se
                recomienda exportar a excel
            </p>
            <span slot="footer" class="dialog-footer">
                <el-button @click="deleteItemDialog = false">Cancelar</el-button>
                <el-button type="danger" @click="deleteItem">Eliminar</el-button>
            </span>
        </el-dialog>


        <el-dialog title="Crear nueva evaluacion" v-model="showEvaluacionesDialog" size="small">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <el-form :model="newEvaluacion" :rules="rules" ref="newEvaluacion">
                        <el-form-item label="Nombre de la evaluación" prop="nombre">
                            <el-input type="text" v-model="newEvaluacion.nombre"></el-input>
                        </el-form-item>
                    </el-form>
                </div>
            </div>
            <span slot="footer" class="dialog-footer">
                <el-button @click="showEvaluacionesDialog = false">Cancelar</el-button>
                 <el-button type="primary" @click="submitEvaluacionForm('newEvaluacion')">Guardar</el-button>
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
                evaluaciones: {
                    evaluaciones: '',
                    agrupaciones: ''
                },
                newItem: {
                    idChecklist: '',
                    name: ''
                },
                newEvaluacion: {
                    nombre: '',
                    idItem: '',
                },
                selectedItem: '',
                selectedIdforDeletion: '',
                selectedItemForEdition: '',
                showItems: false,
                showAddItems: false,
                editDialogVisible: false,
                deleteItemDialog: false,
                showEvaluacionesDialog: false,
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
                    nombre: [
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
            loadItem(item){
                this.selectedItem = item;
                this.showItems = true;
                this.getEvaluaciones()
            },


            getEvaluaciones(id){
                axios.get('api/get/evaluaciones/' + this.selectedItem.id).then(r => {
                    this.evaluaciones.agrupaciones = r.data.agrupaciones;
                    this.evaluaciones.evaluaciones = r.data.evaluaciones;
                }).catch(e => {
                    console.log(e);
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
                this.selectedItemForEdition = item;
                this.editDialogVisible = true;
            },
            submitEditedForm(formName){
                this.$refs[formName].validate(valid => {
                    if (valid) {
                        let data = this.selectedItemForEdition;
                        axios.put('api/edit/item', data).then(r => {
                            this.editDialogVisible = false;
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


            showDialogEvaluacion(item){
                this.showEvaluacionesDialog = true;
                this.newEvaluacion.idItem = item.id;
            },

            submitEvaluacionForm(formName){
                this.$refs[formName].validate(valid => {
                    if (valid) {
                        let data = this.newEvaluacion;
                        axios.post('api/create/evaluacion', data).then(r => {
                            console.log(r.data);
                            this.showEvaluacionesDialog = false;
                            //this.editDialogVisible = false;
                            //this.getItems();
                            this.success();
                        }).catch(e => {
                            this.error(e);
                        })
                    } else {
                        return false;
                    }
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
