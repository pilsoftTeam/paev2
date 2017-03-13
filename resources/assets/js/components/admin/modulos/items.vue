<template>
    <div>
        <div v-if="!showEvaluacionesCreator">
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
                                        @click="showDialogAgrupacion(selectedItem)"
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
                                    <hr>
                                    <div class="panel panel-info" v-for="agrupacion in evaluaciones.agrupaciones">
                                        <div class="panel-heading">
                                            <h5>{{agrupacion.nombre}}</h5>
                                            <div class="btn-group pull-right">
                                                <button type="button"
                                                        @click="showDialogAgrupacionEdit(agrupacion)"
                                                        class="btn btn-warning btn-xs"
                                                        title="Editar esta agrupación">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                                <button type="button"
                                                        @click="showDialogAgrupacionDelete(agrupacion.id)"
                                                        class="btn btn-danger btn-xs"
                                                        title="Eliminar esta agrupación">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                                <button type="button"
                                                        @click="showDialogEvaluacion(agrupacion)"
                                                        class="btn btn-info btn-xs"
                                                        title="Agregar una evaluación a esta agrupación">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <ul class="list-group">
                                                <h5 class="text-center">Evaluaciones</h5>
                                                <li class="list-group-item">
                                                    <div v-for="evaluacion in agrupacion.get_evaluaciones">
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                <p style="word-wrap: break-word">
                                                                    <b>{{evaluacion.evaluacion}}</b>
                                                                </p>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                <div class="btn-group btn-group-justified" role="group"
                                                                     aria-label="Justified button group">
                                                                    <div class="btn-group" role="group">
                                                                        <button type="button"
                                                                                @click="showDialogEvaluacionEdit(evaluacion)"
                                                                                title="Editar esta evaluacion"
                                                                                class="btn btn-default btn-info btn-xs">
                                                                            <i class="fa fa-pencil-square-o"
                                                                               aria-hidden="true"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="btn-group" role="group">
                                                                        <button type="button"
                                                                                @click="showDialogEvaluacionDelete(evaluacion.id)"
                                                                                title="Eliminar esta evaluacion"
                                                                                class="btn btn-default btn-xs btn-danger">
                                                                            <i class="fa fa-trash"
                                                                               aria-hidden="true"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="btn-group" role="group">
                                                                        <button type="button"
                                                                                @click="initCreator(evaluacion)"
                                                                                title="Cargar evaluacion"
                                                                                class="btn btn-success btn-xs">
                                                                            <i class="fa fa-arrow-circle-right"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </li>
                                            </ul>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="text-center">Evaluaciones</h4>
                                    <hr>
                                    <div v-for="evaluacion in evaluaciones.evaluaciones">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <p style="word-wrap: break-word">
                                                    <b>{{evaluacion.evaluacion}}</b>
                                                </p>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


                                                <div class="btn-group btn-group-justified" role="group"
                                                     aria-label="Justified button group">
                                                    <div class="btn-group" role="group">
                                                        <button type="button"
                                                                @click="showDialogEvaluacionEdit(evaluacion)"
                                                                title="Editar esta evaluacion"
                                                                class="btn btn-default btn-info btn-xs">
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                    <div class="btn-group" role="group">
                                                        <button type="button"
                                                                @click="showDialogEvaluacionDelete(evaluacion.id)"
                                                                title="Eliminar esta evaluacion"
                                                                class="btn btn-default btn-xs btn-danger">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                    <div class="btn-group" role="group">
                                                        <button type="button"
                                                                @click="initCreator(evaluacion)"
                                                                title="Cargar evaluacion"
                                                                class="btn btn-success btn-xs">
                                                            <i class="fa fa-arrow-circle-right"></i>
                                                        </button>
                                                    </div>
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
            <el-dialog title="Editar evaluacion" v-model="editEvaluacionDialogVisible" size="small">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <el-form :model="selectedEvaluacionForEdition" :rules="rules"
                                 ref="selectedEvaluacionForEdition">
                            <el-form-item label="Nombre de la evaluacion" prop="evaluacion">
                                <el-input type="text" v-model="selectedEvaluacionForEdition.evaluacion"></el-input>
                            </el-form-item>
                        </el-form>
                    </div>
                </div>
                <span slot="footer" class="dialog-footer">
                <el-button @click="editEvaluacionDialogVisible = false">Cancelar</el-button>
                <el-button type="primary"
                           @click="submitEditedEvaluacionForm('selectedEvaluacionForEdition')">Guardar</el-button>
            </span>
            </el-dialog>
            <el-dialog title="Eliminar evaluacion" v-model="showDeleteEvaluacionDialog" size="tiny">
                <h4>Eliminar esta evaluacion</h4>
                <p>¿ Esta seguro que desea eliminar esta evaluación ?</p>
                <span slot="footer" class="dialog-footer">
                <el-button @click="showDeleteEvaluacionDialog = false">Cancelar</el-button>
                 <el-button type="danger" @click="deleteEvaluacion">Eliminar</el-button>
          </span>
            </el-dialog>


            <el-dialog title="Crear nueva agrupacion" v-model="showAgrupacionDialog" size="small">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <el-form :model="newAgrupacion" :rules="rules" ref="newAgrupacion">
                            <el-form-item label="Nombre de la agrupación" prop="nombre">
                                <el-input type="text" v-model="newAgrupacion.nombre"></el-input>
                            </el-form-item>
                        </el-form>
                    </div>
                </div>
                <span slot="footer" class="dialog-footer">
                <el-button @click="showAgrupacionDialog = false">Cancelar</el-button>
                 <el-button type="primary" @click="submitAgrupacionForm('newAgrupacion')">Guardar</el-button>
          </span>
            </el-dialog>
            <el-dialog title="Editar agrupacion" v-model="showEditAgrupacionDialog" size="small">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <el-form :model="selectedAgrupacionForEdition" :rules="rules"
                                 ref="selectedAgrupacionForEdition">
                            <el-form-item label="Nombre de la agrupación" prop="nombre">
                                <el-input type="text" v-model="selectedAgrupacionForEdition.nombre"></el-input>
                            </el-form-item>
                        </el-form>
                    </div>
                </div>
                <span slot="footer" class="dialog-footer">
                <el-button @click="showEditAgrupacionDialog = false">Cancelar</el-button>
                <el-button type="primary"
                           @click="submitEditedAgrupacionForm('selectedAgrupacionForEdition')">Guardar</el-button>
          </span>
            </el-dialog>
            <el-dialog title="Eliminar agrupacion" v-model="showDeleteAgrupacionDialog" size="tiny">
                <h4>Eliminar esta agrupacion</h4>
                <p>¿ Esta seguro que desea eliminar esta agrupacion ? . Se perderan todas las evaluaciones contenidas en
                    la
                    agrupacion.</p>
                <span slot="footer" class="dialog-footer">
                <el-button @click="showDeleteAgrupacionDialog = false">Cancelar</el-button>
                 <el-button type="danger" @click="deleteAgrupacion">Eliminar</el-button>
          </span>
            </el-dialog>
        </div>

        <div v-if="showEvaluacionesCreator">
            <evaluacion-creator :evaluacion="selectedEvaluacionForCreator"></evaluacion-creator>
        </div>


    </div>
</template>
<script>
    import Evaluacion from './evaluaciones.vue'
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
                    idAgrupacion: ''
                },
                newAgrupacion: {
                    nombre: '',
                    idItem: ''
                },
                selectedItem: '',
                selectedIdforDeletion: '',
                selectedItemForEdition: '',

                selectedAgrupacionForEdition: '',
                selectedAgrupacionForDeletion: '',


                selectedEvaluacionForEdition: '',
                selectedIdForEvaluacionDeletion: '',


                showItems: false,
                showAddItems: false,
                editDialogVisible: false,
                deleteItemDialog: false,

                showAgrupacionDialog: false,
                showEditAgrupacionDialog: false,
                showDeleteAgrupacionDialog: false,


                showEvaluacionesDialog: false,
                editEvaluacionDialogVisible: false,
                showDeleteEvaluacionDialog: false,


                selectedEvaluacionForCreator: '',
                showEvaluacionesCreator: false,


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
                    evaluacion: [
                        {required: true, message: 'Por favor escriba algo', trigger: 'blur'},
                        {
                            min: 3,
                            max: 999,
                            message: 'El texto debe ser mas de 3 y menor de 999 caracteres',
                            trigger: 'blur'
                        }
                    ]
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
            getEvaluaciones(){
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
                this.newEvaluacion.nombre = '';
                this.newEvaluacion.idAgrupacion = '';
                this.newEvaluacion.idItem = '';
                this.showEvaluacionesDialog = true;

                if (typeof item.get_evaluaciones !== 'undefined') {
                    this.newEvaluacion.idAgrupacion = item.id;
                    this.newEvaluacion.idItem = item.idItem;
                } else {
                    this.newEvaluacion.idItem = item.id;
                }


            },
            submitEvaluacionForm(formName){
                this.$refs[formName].validate(valid => {
                    if (valid) {
                        let data = this.newEvaluacion;
                        axios.post('api/create/evaluacion', data).then(r => {
                            this.showEvaluacionesDialog = false;
                            this.getEvaluaciones();
                            this.success();
                        }).catch(e => {
                            this.error(e);
                        })
                    } else {
                        return false;
                    }
                })
            },
            showDialogAgrupacion(item){
                this.showAgrupacionDialog = true;
                this.newAgrupacion.idItem = item.id;
            },
            submitAgrupacionForm(formName){
                this.$refs[formName].validate(valid => {
                    if (valid) {
                        let data = this.newAgrupacion;
                        axios.post('api/create/agrupacion', data).then(r => {
                            this.showAgrupacionDialog = false;
                            this.getEvaluaciones();
                            this.success();
                        }).catch(e => {
                            this.error(e);
                        })
                    } else {
                        return false;
                    }
                })
            },
            showDialogEvaluacionEdit(evaluacion){
                this.editEvaluacionDialogVisible = true;
                this.selectedEvaluacionForEdition = evaluacion;
            },
            submitEditedEvaluacionForm(formName){
                this.$refs[formName].validate(valid => {
                    if (valid) {
                        let data = this.selectedEvaluacionForEdition;
                        axios.put('api/edit/evaluacion', data).then(r => {
                            this.editEvaluacionDialogVisible = false;
                            this.getEvaluaciones();
                            this.success();
                        }).catch(e => {
                            this.error(e);
                        })
                    } else {
                        return false;
                    }
                })
            },
            showDialogEvaluacionDelete(id){
                this.showDeleteEvaluacionDialog = true;
                this.selectedIdForEvaluacionDeletion = id
            },
            deleteEvaluacion(){
                axios.delete('api/delete/evaluacion/' + this.selectedIdForEvaluacionDeletion).then(r => {
                    this.selectedIdForEvaluacionDeletion = '';
                    this.showDeleteEvaluacionDialog = false;
                    this.getEvaluaciones();
                    this.success();
                }).catch(e => {
                    this.error(e);
                })
            },
            showDialogAgrupacionEdit(agrupacion){
                this.selectedAgrupacionForEdition = agrupacion;
                this.showEditAgrupacionDialog = true;
            },
            submitEditedAgrupacionForm(formName){
                this.$refs[formName].validate(valid => {
                    if (valid) {
                        let data = this.selectedAgrupacionForEdition;
                        axios.put('api/edit/agrupacion', data).then(r => {
                            console.log(r.data);
                            this.showEditAgrupacionDialog = false;
                            this.getEvaluaciones();
                            this.success();
                        }).catch(e => {
                            this.error(e);
                        })
                    } else {
                        return false;
                    }
                })
            },
            showDialogAgrupacionDelete(id){
                this.showDeleteAgrupacionDialog = true;
                this.selectedAgrupacionForDeletion = id;

            },
            deleteAgrupacion(){
                axios.delete('api/delete/agrupacion/' + this.selectedAgrupacionForDeletion).then(r => {
                    this.showDeleteAgrupacionDialog = false;
                    this.getEvaluaciones();
                    this.success()

                }).catch(e => {
                    this.error(e);
                })
            },

            initCreator(evaluacion){
                this.selectedEvaluacionForCreator = evaluacion;
                this.showEvaluacionesCreator = true;
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
        },
        components: {
            'evaluacion-creator': Evaluacion
        }
    }
</script>
