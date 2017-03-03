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
                                              placeholder="Opcional">
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
                            <h6>{{data.evaluacion}}</h6>
                            <div>
                                <el-input v-if="data.tipo === 'texto'"
                                          placeholder="Escriba algo">
                                </el-input>

                                <el-input-number v-if="data.tipo === 'numero'"
                                                 style="width: 99%">
                                </el-input-number>

                                <el-date-picker
                                        v-if="data.tipo === 'fecha'"
                                        style="width: 99%"
                                        type="week"
                                        format="Week WW"
                                        placeholder="Elija una fecha">
                                </el-date-picker>

                                <el-time-picker v-if="data.tipo === 'hora'"
                                                style="width: 99%"
                                                :picker-options="{selectableRange: '00:00:00 - 24:00:00'}"
                                                placeholder="Elija la hora">
                                </el-time-picker>

                                <el-select v-if="data.tipo === 'seleccionUnica'"
                                           style="width: 99%"
                                           placeholder="Select">
                                    <el-option label="opt" value="opt"></el-option>
                                </el-select>

                                <el-select v-if="data.tipo === 'seleccionMultiple'"
                                           v-model="value5"
                                           style="width: 99%"
                                           multiple
                                           placeholder="Select">
                                    <el-option
                                            v-for="item in options"
                                            :key="item.value"
                                            :label="item.label"
                                            :value="item.value">
                                    </el-option>
                                </el-select>

                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <el-collapse>
                                        <el-collapse-item
                                                title="Subir adjuntos / Aspectos evaluativos , Documentos requeridos"
                                                name="1">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci
                                                    aliquam asperiores eos, expedita facere fuga inventore ipsa labore
                                                    minima numquam omnis, quas quasi qui, similique soluta sunt velit!
                                                    Ex,
                                                    quam.
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
        </div>
    </div>
</template>
<script>
    export default {
        mounted(){
            this.init();
        },
        data () {
            return {
                activeName: 'uno',
                data: {},
                options: [{
                    value: 'Option1',
                    label: 'Option1'
                }, {
                    value: 'Option2',
                    label: 'Option2'
                }, {
                    value: 'Option3',
                    label: 'Option3'
                }, {
                    value: 'Option4',
                    label: 'Option4'
                }, {
                    value: 'Option5',
                    label: 'Option5'
                }],
                value5: []

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
            assignInput(type){
                this.data.tipo = type;
            }
        }
    }
</script>
