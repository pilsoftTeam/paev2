<template>
    <div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <el-tabs v-model="activeName">
                        <el-tab-pane label="Entrada de datos" name="uno">

                            <ul class="list-group">
                                <li class="list-group-item">
                                    <i class="fa fa-etsy" aria-hidden="true"></i>
                                    Entrada de texto
                                    <button class="btn btn-xs btn-info pull-right" @click="assignInput('texto')">Usar
                                    </button>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-calculator" aria-hidden="true"></i>
                                    Entrada de numero
                                    <button class="btn btn-xs btn-info pull-right" @click="assignInput('numero')">Usar
                                    </button>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    Entrada de fecha
                                    <button class="btn btn-xs btn-info pull-right" @click="assignInput('fecha')">Usar
                                    </button>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    Entrada de hora
                                    <button class="btn btn-xs btn-info pull-right" @click="assignInput('hora')">Usar
                                    </button>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    Entrada de seleccion unica
                                    <button class="btn btn-xs btn-info pull-right"
                                            @click="assignInput('seleccionUnica')">
                                        Usar
                                    </button>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    Entrada de seleccion multiple
                                    <button class="btn btn-xs btn-info pull-right"
                                            @click="assignInput('seleccionMultiple')">
                                        Usar
                                    </button>
                                </li>
                            </ul>

                        </el-tab-pane>
                        <el-tab-pane label="Informacion relevante" name="dos">


                            <el-form ref="data" :model="data">
                                <el-form-item label="Criticidad">
                                    <el-input v-model="data.criticidad"
                                              placeholder="Opcional">
                                    </el-input>
                                </el-form-item>


                                <el-form-item label="Documentos requeridos">
                                    <el-input v-model="data.documentosVerificadores"
                                              :rows="2"
                                              type="textarea"
                                              placeholder="Separe cada uno de los documentos requeridos con una coma ´,´ ">
                                    </el-input>
                                </el-form-item>

                                <el-form-item label="Aspecto evaluativo">
                                    <el-input v-model="data.aspectoEvaluativo"
                                              :rows="2"
                                              type="textarea"
                                              placeholder="Opcional">
                                    </el-input>
                                </el-form-item>

                            </el-form>


                        </el-tab-pane>
                        <el-tab-pane label="Opciones de observación" name="tres">
                            <label>¿ Tiene esta evaluacion una observación escrita ?</label>
                            <br>
                            <el-switch
                                    v-model="data.observacionEscrita"
                                    on-text="SI"
                                    off-text="NO"
                                    on-color="#13ce66"
                                    off-color="#ff4949">
                            </el-switch>
                            <br>
                            <br>
                            <label>¿ Tiene esta evaluacion una observación documental ?</label>
                            <br>
                            <el-switch
                                    v-model="data.observacionDocumental"
                                    on-text="SI"
                                    off-text="NO"
                                    on-color="#13ce66"
                                    off-color="#ff4949">
                            </el-switch>
                            <br>
                            <br>
                            <label>¿ Esta evaluación se puede replicar ?</label>
                            <br>
                            <el-switch
                                    v-model="data.replicable"
                                    on-text="SI"
                                    off-text="NO"
                                    on-color="#13ce66"
                                    off-color="#ff4949">
                            </el-switch>


                        </el-tab-pane>
                    </el-tabs>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <h5>Previsualización</h5>
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <h5 class="col-xs-10 col-sm-10 col-md-10 col-lg-10" style="word-wrap: break-word">
                                Evaluacion : <b>{{data.evaluacion}}</b>
                            </h5>
                            <h5 class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="word-wrap: break-word">
                                Criticidad : <b>{{data.criticidad}}</b>
                            </h5>
                            <div>
                                <el-input v-if="data.tipo === 'texto'"
                                          v-model="placeholders.texto"
                                          placeholder="Escriba algo">
                                </el-input>

                                <el-input-number v-if="data.tipo === 'numero'"
                                                 v-model="placeholders.numero"
                                                 style="width: 99%">
                                </el-input-number>

                                <el-date-picker
                                        v-if="data.tipo === 'fecha'"
                                        v-model="placeholders.fecha"
                                        style="width: 99%"
                                        placeholder="Elija una fecha">
                                </el-date-picker>

                                <el-time-picker v-if="data.tipo === 'hora'"
                                                v-model="placeholders.hora"
                                                style="width: 99%"
                                                :picker-options="{selectableRange: '00:00:00 - 24:00:00'}"
                                                placeholder="Elija la hora">
                                </el-time-picker>


                                <div class="row" v-if="data.tipo === 'seleccionUnica'">
                                    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                                        <el-select style="width: 99%" v-model="placeholders.seleccionUnica"
                                                   placeholder="Seleccionar">
                                            <div v-if="data.get_cumplimientos" class="isHere">
                                                <el-option
                                                        v-for="opciones in data.get_cumplimientos.get_opciones_cumplimientos"
                                                        :key="opciones.id"
                                                        :value="opciones.valor"
                                                        :label="opciones.titulo">
                                                </el-option>
                                            </div>
                                        </el-select>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">

                                        <el-button
                                                size="mini"
                                                type="success"
                                                @click="opcionesCumplimientoDialogVisible = true"
                                                title="Agregar una opcion de cumplimiento a la evaluacion">
                                            <i class="fa fa-angle-down fa-2x" aria-hidden="true"></i>
                                        </el-button>
                                    </div>

                                    <br>
                                    <br>
                                    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11"
                                         v-if="placeholders.seleccionUnica">
                                        <h5>Opcion elegida : <b>{{placeholders.seleccionUnica}}</b></h5>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" v-if="placeholders.seleccionUnica">
                                        <el-button type="primary"
                                                   size="mini"
                                                   title="¿ Esta opcion desencadena otra pregunta ?">
                                            <i class="fa fa-question fa-2x" aria-hidden="true"></i>
                                        </el-button>
                                    </div>


                                </div>


                                <div class="row" v-if="data.tipo === 'seleccionMultiple'">
                                    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                                        <el-select
                                                v-model="placeholders.seleccionMultiple"
                                                style="width: 99%"
                                                multiple
                                                placeholder="Seleccion múltiple">
                                            <el-option
                                                    v-for="item in options"
                                                    :key="item.value"
                                                    :label="item.label"
                                                    :value="item.value">
                                            </el-option>
                                        </el-select>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                        <button class="btn btn-block btn-xs btn-success"
                                                @click="opcionesCumplimientoDialogVisible = true"
                                                title="Agregar una opcion de cumplimiento a la evaluacion">
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>


                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <el-collapse>
                                        <el-collapse-item
                                                title="Subir adjuntos / Aspectos evaluativos , Documentos requeridos"
                                                name="1">
                                            <div class="row">
                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"
                                                     v-if="data.aspectoEvaluativo">
                                                    <h5 class="text-center">Aspecto Evaluativo</h5>
                                                    <p style="word-wrap: break-word">{{data.aspectoEvaluativo}}</p>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"
                                                     v-if="data.documentosVerificadores">
                                                    <h5 class="text-center">Documentos verificadores</h5>
                                                    <p style="word-wrap: break-word">
                                                        {{data.documentosVerificadores}}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"
                                                     v-if="data.observacionEscrita">
                                                    <h5 class="text-center">Observacion Escrita</h5>
                                                    <el-input type="textarea"></el-input>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"
                                                     v-if="data.observacionDocumental">
                                                    <h5 class="text-center">Observacion documental</h5>
                                                    <el-upload
                                                            class="upload-demo"
                                                            :drag="true"
                                                            action="//jsonplaceholder.typicode.com/posts/"
                                                            :mutiple="true">
                                                        <i class="el-icon-upload"></i>
                                                        <div class="el-upload__text">Suelte archivos aqui o <em>haga
                                                            click para subir</em></div>
                                                    </el-upload>
                                                </div>
                                            </div>
                                        </el-collapse-item>
                                    </el-collapse>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>

            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <el-button class="btn-block" type="success" @click="saveEvaluacion">
                    Guardar cambios
                </el-button>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>


        </div>


        <el-dialog title="Opciones de cumplimiento" v-model="opcionesCumplimientoDialogVisible" size="large">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <el-form :model="formCumplimiento" :rules="rules" ref="formCumplimiento">
                        <el-tabs v-model="activeNameForCumplimiento">
                            <el-tab-pane label="Lista de opciones para seleccionar"
                                         name="uno">

                                <div class="row">

                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                        <el-table
                                                :data="opcionesCumplimiento"
                                                style="width: 100%">
                                            <el-table-column
                                                    label="Nombre de cumplimiento"
                                                    prop="nombreCumplimiento">
                                            </el-table-column>
                                            <el-table-column
                                                    label="Fecha de creacion"
                                                    prop="created_at">
                                            </el-table-column>
                                            <el-table-column
                                                    label="Opciones">
                                                <template scope="scope">
                                                    <el-button
                                                            type="success"
                                                            size="small"
                                                            title="Seleccionar este cumplimiento para esta evaluación"
                                                            @click="setOpcion(scope.$index, scope.row)">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    </el-button>
                                                    <el-button
                                                            type="info"
                                                            size="small"
                                                            title="Vista previa del cumplimiento"
                                                            @click="handleVistaPrevia(scope.$index, scope.row)">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </el-button>
                                                    <el-button
                                                            type="warning"
                                                            size="small"
                                                            title="Editar este cumplimiento"
                                                            @click="handleEdit(scope.$index, scope.row)">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </el-button>
                                                    <el-button
                                                            type="danger"
                                                            size="small"
                                                            title="Borrar este cumplimiento"
                                                            @click="handleDelete(scope.$index, scope.row)">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </el-button>
                                                </template>
                                            </el-table-column>
                                        </el-table>
                                    </div>
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div v-if="showPreviewCumplimiento">

                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th>Titulo</th>
                                                            <th>Valor</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr v-for="item in previewCumplimientoData.get_opciones_cumplimientos">
                                                            <td>{{item.titulo}}</td>
                                                            <td>{{item.valor}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div v-else-if="showDeleteFrame">
                                                    <h4 class="text-center">Eliminar esta opcion de cumplimiento</h4>
                                                    <hr>

                                                    <p class="text-justify">Al eliminar esta opcion de cumplimiento ,
                                                        todas las evaluaciones
                                                        las usan pasaran a no tener evaluacion definida</p>

                                                    <br>

                                                    <el-button type="danger" class="btn btn-block"
                                                               @click="deleteCumplimiento">
                                                        Eliminar este cumplimiento
                                                    </el-button>
                                                </div>

                                                <div v-else>
                                                    <i class="fa fa-spinner text-center center-block"
                                                       aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </el-tab-pane>


                            <el-tab-pane label="Agregar una nueva opcion" name="dos">

                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <el-form-item label="Titulo de las opciones" prop="titulo">
                                            <el-input v-model="formCumplimiento.titulo"></el-input>
                                        </el-form-item>
                                    </div>
                                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                        <div class="row" v-for="item in formCumplimiento.opciones" :key="item.id">

                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                <el-form-item label="Valor de la opcion" prop="valor">
                                                    <el-input v-model="item.valor"></el-input>
                                                </el-form-item>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                <el-form-item label="Nombre de la opcion" prop="nombre">
                                                    <el-input v-model="item.nombre"></el-input>
                                                </el-form-item>
                                            </div>
                                            <hr>
                                        </div>


                                        <el-button type="success"
                                                   @click="saveOption('formCumplimiento')"
                                                   title="Guardar">
                                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                        </el-button>

                                        <el-button type="info"
                                                   class="pull-right"
                                                   title="Agregar una opcion"
                                                   @click="pushOption">
                                            <i class="fa fa-plus-circle"></i>
                                        </el-button>

                                    </div>

                                </div>

                            </el-tab-pane>
                        </el-tabs>
                    </el-form>
                </div>

            </div>
            <span slot="footer" class="dialog-footer">
                <el-button @click="opcionesCumplimientoDialogVisible = false">Cerrar</el-button>
            </span>
        </el-dialog>


    </div>
</template>
<style>
    .el-upload__input {
        display: none !important;
    }

    .el-upload-dragger {
        width: 315px !important;
    }
</style>
<script>
    export default {
        mounted(){
            this.init();
            this.getOptions();
        },
        data () {
            return {
                activeName: 'uno',
                activeNameForCumplimiento: 'uno',
                opcionesCumplimiento: '',

                data: {},

                formCumplimiento: {
                    titulo: '',
                    opciones: [{
                        nombre: '',
                        valor: ''
                    }]
                },
                rules: {
                    titulo: [
                        {required: true, message: 'Por favor escriba algo', trigger: 'blur'},
                        {
                            min: 6,
                            max: 999,
                            message: 'El titulo debe ser igual os mas largo que 6 caracteres',
                            trigger: 'blur'
                        }
                    ]
                },


                placeholders: {
                    texto: '',
                    numero: '',
                    fecha: '',
                    hora: '',
                    seleccionUnica: '',
                    seleccionMultiple: []

                },


                options: [
                    {
                        value: 'Option1',
                        label: 'Option1'
                    },
                    {
                        value: 'Option2',
                        label: 'Option2'
                    },
                    {
                        value: 'Option3',
                        label: 'Option3'
                    },
                    {
                        value: 'Option4',
                        label: 'Option4'
                    },
                    {
                        value: 'Option5',
                        label: 'Option5'
                    }],
                value5: [],
                opcionesCumplimientoDialogVisible: false,


                showPreviewCumplimiento: false,
                previewCumplimientoData: '',


                showDeleteFrame: false,
                deleteFrameData: ''

            }
        },
        props: {
            info: {
                required: true,
                type: Object
            }
        },
        methods: {
            init(){
                this.data = this.info;
                this.data.observacionEscrita == 0 ? this.data.observacionEscrita = false : this.data.observacionEscrita = true;
                this.data.observacionDocumental == 0 ? this.data.observacionDocumental = false : this.data.observacionDocumental = true;
                this.data.replicable == 0 ? this.data.replicable = false : this.data.replicable = true;

            },
            afterUpdate(){
                axios.get('api/get/evaluacion/info/' + this.data.id).then(r => {
                    this.data.get_cumplimientos = r.data[0].get_cumplimientos;
                }).catch(e => {
                    console.log(e);
                });
            },
            assignInput(type){
                this.data.tipo = type;
            },
            getOptions(){
                axios.get('api/get/opciones/cumplimiento').then(r => {
                    this.opcionesCumplimiento = r.data;
                }).catch(e => {
                    console.log(e)
                })
            },
            pushOption(){
                let obj = {
                    nombre: '',
                    valor: ''
                };
                this.formCumplimiento.opciones.push(obj);
            },
            saveOption(formName){
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        let data = this.formCumplimiento;
                        axios.post('api/save/cumplimiento', data).then(r => {
                            let obj = {
                                nombre: '',
                                valor: ''
                            };
                            this.formCumplimiento.titulo = '';
                            this.formCumplimiento.opciones.length = 0;
                            this.formCumplimiento.opciones.push(obj);
                            this.activeNameForCumplimiento = 'uno';
                            this.getOptions();
                        }).catch(e => {
                            console.log(e);
                        })

                    } else {
                        return false;
                    }
                });


            },
            handleEdit(row, item){

            },
            handleVistaPrevia(row, item){
                this.showPreviewCumplimiento = true;
                this.previewCumplimientoData = item;
            },
            handleDelete(row, item){
                this.showPreviewCumplimiento = false;
                this.showDeleteFrame = true;
                this.deleteFrameData = item.id;
            },
            deleteCumplimiento(){
                axios.delete('api/delete/cumplimiento/' + this.deleteFrameData).then(r => {
                    this.showDeleteFrame = false;
                    this.getOptions();
                }).catch(e => {
                    console.log(e);
                })
            },
            setOpcion(row, item){

                let formData = {
                    evaluacion: this.data.id,
                    cumplimiento: item.id
                };

                axios.put('api/set/opcion', formData).then(r => {
                    this.opcionesCumplimientoDialogVisible = false;
                    this.success();
                    this.afterUpdate();
                }).catch(e => {
                    this.error(e);
                })
            },

            saveEvaluacion(){
                axios.put('api/update/evaluacion', this.data).then(r => {
                    console.log(r.data);
                    this.success()
                }).catch(e => {
                    this.error(e)
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
