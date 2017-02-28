<template>
    <div>
        <div class="row">
            <h6>CHECKLIST : {{selectedChecklist.nombre}}</h6>
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

                <div class="panel panel-default">
                    <div class="panel-body">

                        <el-menu mode="vertical" default-active="1" class="el-menu-vertical-demo">
                            <el-menu-item index="1">
                                <i class="el-icon-message"></i>
                                Navigator One
                            </el-menu-item>
                        </el-menu>

                    </div>
                </div>
            </div>
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <h4>Agrupaciones y evaluaciones</h4>
                <div class="panel panel-default">
                    <div class="panel-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aut commodi ea nobis obcaecati
                        odit
                        placeat
                        totam unde. A ab consectetur error ipsum iure maiores minus quo reprehenderit tempore tenetur!
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

    </div>
</template>
<style>

</style>
<script>
    export default {
        mounted(){
        },
        data () {
            return {
                showAddItems: false,
                newItem: {
                    id: '',
                    name: ''
                },
                rules: {
                    name: [
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
        props: {
            selectedChecklist: {
                type: Object,
                required: true
            }
        },
        methods: {
            submitForm(form){
                console.log(form);
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
