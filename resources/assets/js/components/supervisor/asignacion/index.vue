<template>
    <div class="row">
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label>Proveedores</label>
                    <el-select v-model="value" clearable placeholder="Seleccionar" style="width: 99%">
                        <el-option
                                v-for="item in filteredProveedores"
                                :key="item.id"
                                :label="item.nombreProveedor"
                                :value="item.id">
                        </el-option>
                    </el-select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label>Revisores</label>
                    <el-select v-model="value" clearable placeholder="Seleccionar" style="width: 99%">
                        <el-option
                                v-for="item in options"
                                :key="item.id"
                                :label="item.label"
                                :value="item.value">
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
                selectedProveedor: '',
                revisores: '',
                options: [
                    {
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
                    }
                ],
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
                    console.log(r.data)
                }).catch(e => {
                    console.log(e)
                })
            }
        }
    }
</script>
