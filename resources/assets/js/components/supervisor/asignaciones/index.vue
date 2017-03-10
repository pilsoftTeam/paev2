<template>
    <div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body example">
                        <el-table :data="asignaciones"
                                  border
                                  style="width: 100%">
                            <el-table-column
                                    prop="get_bodegas.nombreProveedor"
                                    label="Proveedor"
                                    sortable>
                            </el-table-column>
                            <el-table-column
                                    prop="get_bodegas.licitacion"
                                    label="Licitacion">
                            </el-table-column>
                            <el-table-column
                                    prop="get_bodegas.comuna"
                                    label="Comuna">
                            </el-table-column>
                            <el-table-column
                                    prop="get_bodegas.region"
                                    label="Region">
                            </el-table-column>
                            <el-table-column
                                    prop="get_revisor.name"
                                    label="Revisor">
                            </el-table-column>
                            <el-table-column
                                    prop="get_supervisor.name"
                                    label="Supervisor">
                            </el-table-column>
                            <el-table-column
                                    prop="estado"
                                    label="Estado"
                                    width="120"
                                    :filters="filters"
                                    :filter-method="filterTag">
                                <template scope="scope">
                                    <el-tag :type="scope.row.estado === 'pendiente' ? 'primary' : 'success'"
                                            close-transition>
                                        {{scope.row.estado}}
                                    </el-tag>
                                </template>
                            </el-table-column>

                            <el-table-column
                                    label="Operaciones">
                                <template scope="scope">
                                    <el-button-group>
                                        <el-button
                                                title="exportar informacion a excel"
                                                type="success"
                                                @click="handleEdit(scope.$index, scope.row)">
                                            <i class="fa fa-file-excel-o"></i>
                                        </el-button>
                                        <el-button
                                                title="Mas detalles de la revision"
                                                type="info"
                                                @click="handleEdit(scope.$index, scope.row)">
                                            <i class="fa fa-eye"></i>
                                        </el-button>
                                    </el-button-group>
                                </template>
                            </el-table-column>
                        </el-table>
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
                asignaciones: [],
                filters: [
                    {text: 'Pendiente', value: 'pendiente'},
                    {text: 'Revisado', value: 'revisado'},
                    {text: 'Aprobado', value: 'aprobado'},
                    {text: 'Informado', value: 'informado'}
                ]
            }
        },
        methods: {

            init(){
                axios.get('api/get/asignaciones').then(r => {
                    //console.log(r.data)
                    this.asignaciones = r.data;
                }).catch(e => {
                    console.log(e);
                })
            },
            filterTag(value, row) {
                return row.estado === value;
            },
            handleEdit(row, index){
                console.log(row);
                console.log(index);
            }

        }
    }
</script>
