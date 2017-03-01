<template>
    <div class="container">
        <div class="row" v-if="!showItemCreation">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <el-menu default-active="1" class="el-menu-vertical-demo">
                            <el-menu-item index="1">
                                <i class="el-icon-menu"></i>
                                Checklists
                            </el-menu-item>
                            <el-menu-item index="2">
                                <i class="el-icon-setting"></i>
                                Usuarios
                            </el-menu-item>
                        </el-menu>
                    </div>
                </div>
            </div>

            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 __borderLeft">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" v-for="item in checklists">
                                <el-card :id="'checklist' + item.id">
                                    <img src="http://placehold.it/350x150" class="image">
                                    <div>
                                        <hr>
                                        <span @dblclick="editChecklist(item)">
                                            {{item.nombre}}
                                        </span>
                                        <br>
                                        <br>
                                        <div class="bottom clearfix">
                                            <el-button type="success" class="button pull-right" @click="create(item)">
                                                Agregar items
                                            </el-button>
                                            <el-button type="warning" class="button" @click="editChecklist(item)">
                                                Editar
                                            </el-button>
                                            <el-button type="danger" @click="showDeleteDialog(item.id)" class="button">
                                                Eliminar
                                            </el-button>
                                        </div>
                                    </div>
                                </el-card>
                                <br>
                            </div>
                        </div>
                        <br>
                        <br>
                        <el-button class="btn btn-block" type="success" @click="showAddChecklist = true">
                            Agregar un nuevo checklist
                        </el-button>
                    </div>

                </div>
            </div>
        </div>


        <items :selectedChecklist="selectedChecklist" v-if="showItemCreation"></items>


        <el-dialog title="Agregar un nuevo checklist" v-model="showAddChecklist" size="small">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <el-form :model="newChecklistForm" :rules="rules" ref="newChecklistForm">
                        <el-form-item label="Nombre del checklist" prop="newChecklistName">
                            <el-input type="textarea" v-model="newChecklistForm.newChecklistName"></el-input>
                        </el-form-item>
                    </el-form>
                </div>
            </div>

            <span slot="footer" class="dialog-footer">
                <el-button @click="showAddChecklist = false">Cancelar</el-button>
                <el-button type="primary" @click="submitForm('newChecklistForm')">Agregar</el-button>
            </span>
        </el-dialog>
        <el-dialog title="Editar checklist" v-model="showEditChecklist" size="small">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <el-form :model="editChecklistForm" :rules="rules" ref="newChecklistForm">
                        <el-form-item label="Nombre del checklist" prop="newChecklistName">
                            <el-input type="textarea" v-model="editChecklistForm.newChecklistName"></el-input>
                        </el-form-item>
                    </el-form>
                </div>
            </div>

            <span slot="footer" class="dialog-footer">
                <el-button @click="showEditChecklist = false">Cancelar</el-button>
                <el-button type="primary" @click="submitEditForm('newChecklistForm')">Editar</el-button>
            </span>
        </el-dialog>
        <el-dialog title="Eliminar checklist" v-model="showDeleteChecklist" size="tiny">

            <h3>Atencion!</h3>
            <p>Si usted elimina este checklist todas las evaluaciones se perderan. Se recomienda exportar la informacion
                a excel.</p>

            <span slot="footer" class="dialog-footer">
                <el-button @click="showDeleteChecklist = false">Cancelar</el-button>
                <el-button type="danger" @click="deleteChecklist">Eliminar</el-button>
            </span>
        </el-dialog>


    </div>
</template>
<script>
    import items from './modulos/items.vue'
    export default {
        mounted() {
            this.getChecklists();
        },
        data(){
            return {
                checklists: '',
                newChecklistForm: {
                    newChecklistName: ''
                },
                editChecklistForm: {
                    id: '',
                    newChecklistName: ''
                },
                checklistDeletionId: '',
                selectedChecklist: '',
                showAddChecklist: false,
                showEditChecklist: false,
                showDeleteChecklist: false,
                showItemCreation: false,
                rules: {
                    newChecklistName: [
                        {required: true, message: 'Por favor escriba algo', trigger: 'blur'},
                        {
                            min: 10,
                            max: 999,
                            message: 'El texto debe ser mas de 10 y menor de 999 caracteres',
                            trigger: 'blur'
                        }
                    ],
                }
            }
        },
        methods: {

            getChecklists(){
                axios.get('api/get/checklists').then(r => {
                    this.checklists = r.data;
                }).catch(e => {
                    console.log(e)
                })
            },
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        let data = this.newChecklistForm;
                        axios.post('api/create/checklist', data).then(r => {
                            this.showAddChecklist = false;
                            this.newChecklistForm.newChecklistName = '';
                            this.getChecklists();
                            this.success();
                        }).catch(e => {
                            this.error(e);
                        })
                    } else {
                        return false;
                    }
                });
            },
            submitEditForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        let data = this.editChecklistForm;
                        axios.put('api/edit/checklist', data).then(r => {
                            this.showEditChecklist = false;
                            this.editChecklistForm.newChecklistName = '';
                            this.getChecklists();
                            this.success();
                        }).catch(e => {
                            this.error(e);
                        })
                    } else {
                        return false;
                    }
                });
            },
            editChecklist(checklist){
                this.editChecklistForm.id = checklist.id;
                this.editChecklistForm.newChecklistName = checklist.nombre;
                this.showEditChecklist = true;
            },
            showDeleteDialog(id){
                this.showDeleteChecklist = true;
                this.checklistDeletionId = id;
            },
            deleteChecklist(){
                axios.delete('api/delete/checklist/' + this.checklistDeletionId).then(r => {
                    this.showDeleteChecklist = false;
                    this.getChecklists();
                    this.success();
                }).catch(e => {
                    this.error(e);
                })
            },


            create(item){
                this.selectedChecklist = item;
                this.showItemCreation = true;
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
            }
        },
        computed: {},
        components: {
            'items': items
        }
    }
</script>
