<template>
    <div>


        <div class="container">
            <div class="row">


                <div class="col-xs-18 col-sm-3 col-md-3 col-lg-3">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h6 class="text-center"><b>Items</b></h6>
                            <ul class="list-group" v-for="item in items" :key="item.id">
                                <li class="list-group-item row">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <h6 class="text-center">{{item.nombre}}</h6>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <button class="btn btn-info center-block text-center"
                                                title="Cargar este item"
                                                @click="loadItem(item.id)">
                                            <i class="fa fa-arrow-circle-o-right"></i>
                                        </button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xs-18 col-sm-9 col-md-9 col-lg-9">

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h6 class="text-center"><b>{{this.revision.get_bodegas_for_evaluaciones.get_checklist.nombre}}</b>
                            </h6>
                            <hr>


                            <div v-if="selectedItems.get_evaluaciones">

                                <div class="row" v-for="evaluaciones in selectedItems.get_evaluaciones"
                                     :key="evaluaciones.id">
                                    <div class="col-lg-offset-1 col-xs-16 col-sm-10 col-md-10 col-lg-10 col-lg-offset-1">
                                        <p>{{evaluaciones.evaluacion}}</p>


                                        <el-input v-if="evaluaciones.tipo === 'texto'"
                                                  v-model="evaluaciones.valor"
                                                  placeholder="Escriba algo">
                                        </el-input>

                                        <el-input-number v-if="evaluaciones.tipo === 'numero'"
                                                         v-model="evaluaciones.valor"
                                                         style="width: 99%">
                                        </el-input-number>

                                        <el-date-picker
                                                v-if="evaluaciones.tipo === 'fecha'"
                                                v-model="evaluaciones.valor"
                                                style="width: 99%"
                                                placeholder="Elija una fecha">
                                        </el-date-picker>

                                        <el-time-picker v-if="evaluaciones.tipo === 'hora'"
                                                        style="width: 99%"
                                                        v-model="evaluaciones.valor"
                                                        :picker-options="{selectableRange: '00:00:00 - 24:00:00'}"
                                                        placeholder="Elija la hora">
                                        </el-time-picker>


                                        <div class="row" v-if="evaluaciones.tipo === 'seleccionUnica'">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <el-select style="width: 99%" v-model="evaluaciones.valor"
                                                           placeholder="Seleccionar">
                                                    <div v-if="evaluaciones.get_cumplimientos">
                                                        <el-option
                                                                v-for="opciones in evaluaciones.get_cumplimientos.get_opciones_cumplimientos"
                                                                :key="opciones.id"
                                                                :value="opciones.valor"
                                                                :label="opciones.titulo">
                                                        </el-option>
                                                    </div>
                                                </el-select>
                                            </div>

                                        </div>


                                        <div class="row" v-if="evaluaciones.tipo === 'seleccionMultiple'">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <el-select
                                                        v-model="evaluaciones.valor"
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
                                        </div>

                                        <br>
                                        <el-collapse>
                                            <el-collapse-item title="Consistency" name="1">
                                                <pre>
                                                    {{evaluaciones}}
                                                </pre>
                                            </el-collapse-item>
                                        </el-collapse>
                                        <hr>
                                    </div>
                                </div>
                            </div>


                            <div v-if="selectedItems.get_agrupaciones">
                                <div v-for="agrupacion in selectedItems.get_agrupaciones" :key="agrupacion.id">


                                    <div class="panel panel-default col-lg-offset-1 col-xs-16 col-sm-10 col-md-10 col-lg-10 col-lg-offset-1">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">{{agrupacion.nombre}}</h5>
                                        </div>
                                        <div class="panel-body">
                                            <div v-if="agrupacion.get_evaluaciones">
                                                <div class="row"
                                                     v-for="evaluaciones in agrupacion.get_evaluaciones"
                                                     :key="evaluaciones.id">


                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                        <p>{{evaluaciones.evaluacion}}</p>
                                                        <el-collapse>
                                                            <el-collapse-item title="Consistency" name="1">
                                                                <pre>
                                                                    {{evaluaciones}}
                                                                </pre>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import _ from 'lodash'
    export default {
        mounted(){
            this.initChecklist();
        },
        data () {
            return {
                msg: 'Hello world!',
                items: [],
                checklist: '',
                selectedItems: ''
            }
        },
        props: {
            revision: {
                type: Object,
                required: true
            }
        },
        methods: {
            initChecklist(){
                this.checklist = this.revision.get_bodegas_for_evaluaciones.get_checklist;

                let checklist = this.checklist;

                _.forEach(checklist.get_items, i => {
                    let obj = {
                        id: i.id,
                        nombre: i.nombre,
                    };
                    this.items.push(obj);

                    _.forEach(i.get_agrupaciones, a => {
                        _.forEach(a.get_evaluaciones, e => {
                            e.tipo === 'seleccionMultiple' ? e.valor = [] : e.valor = '';
                        })
                    });

                    _.forEach(i.get_evaluaciones, e => {
                        e.tipo === 'seleccionMultiple' ? e.valor = [] : e.valor = '';
                    })

                });

            },

            loadItem(id){
                let checklist = this.checklist;
                this.selectedItems = _.find(checklist.get_items, c => {
                    return c.id == id
                })
            }
        }
    }
</script>
