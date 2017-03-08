<template>
    <div class="row">
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label>Proveedores</label>
                    <el-select v-model="asignacion.idBodega"
                               @change="getInfo"
                               clearable
                               placeholder="Seleccionar"
                               style="width: 99%">
                        <el-option
                                v-for="item in filteredProveedores"
                                :key="item.id"
                                :label="item.nombreProveedor"
                                :value="item.nombreProveedor">
                        </el-option>
                    </el-select>
                </div>
            </div>
            <br>


            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label>Proveedores seleccionados</label>
                    <el-select clearable
                               placeholder="Seleccionar"
                               style="width: 99%">
                        <el-option
                                v-for="item in selectedProveedores"
                                :key="item.id"
                                :label="item.nombreProveedor"
                                :value="item.id">
                            <span style="float: left; font-size: 12px; word-wrap: break-word">
                                {{ item.nombreProveedor }}  --
                                Direccion : {{ item.direccionBodega }}  --
                                Comuna : {{item.comuna}}  --
                                Region : {{item.region}}
                                &nbsp;
                                &nbsp;
                                &nbsp;
                            </span>
                            <span style="float: right; color: #8492a6; font-size: 12px">
                                Licitacion : {{ item.licitacion }}
                            </span>
                        </el-option>
                    </el-select>
                </div>
            </div>
            <br>


            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                </div>
            </div>


            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label>Revisores</label>
                    <el-select v-model="asignacion.idRevisor" clearable placeholder="Seleccionar" style="width: 99%">
                        <el-option
                                v-for="item in revisores"
                                :key="item.id"
                                :label="item.name"
                                :value="item.id">
                        </el-option>
                    </el-select>
                </div>
            </div>
        </div>
        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    Panel body ...
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import _ from 'lodash'
    export default {
        mounted(){
            this.getProveedores();
            this.getRevisores();
        },
        data () {
            return {
                value: '',
                proveedores: '',
                filteredProveedores: '',
                selectedProveedores: '',
                revisores: [],
                asignacion: {
                    idChecklist: '',
                    idRevisor: '',
                    idBodega: ''
                }
            }
        },
        methods: {
            getProveedores(){
                axios.get('api/get/supervision/proveedores').then(r => {
                    this.proveedores = r.data;
                    this.filteredProveedores = _.uniqBy(r.data, 'nombreProveedor');
                }).catch(e => {
                    console.log(e)
                })
            },
            getRevisores(){
                axios.get('api/get/supervision/revisores').then(r => {
                    _.forEach(r.data, d => {
                        _.forEach(d.get_users, u => {
                            this.revisores.push(u);
                        })
                    })
                }).catch(e => {
                    console.log(e)
                })
            },
            getInfo(value){
                this.selectedProveedores = _.filter(this.proveedores, p => {
                    return p.nombreProveedor === value;
                });
            },
            getChecklists(){

            }
        }
    }
</script>
