<template>
    <div class="row">
        <div v-if="!showRevision">
            <div class="col-md-8 col-md-offset-2">
                <h4 class="text-center">Revisiones asignadas para usted</h4>
                <hr>
                <div class="panel panel-default" v-for="revision in revisiones">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Revision asignada
                        </h3>
                    </div>
                    <div class="panel-body">
                        <p class="text-center">Nombre Proveedor : <b>{{revision.get_bodegas_for_evaluaciones.nombreProveedor}}</b>
                        </p>
                        <p class="text-center">Direccion :
                            <b>{{revision.get_bodegas_for_evaluaciones.direccionBodega}}</b>
                        </p>
                        <p class="text-center"> Comuna : <b>{{revision.get_bodegas_for_evaluaciones.comuna}}</b></p>
                        <button @click="initRevision(revision)"
                                class="btn btn-success text-center center-block">
                            Iniciar <i class="fa fa-arrow-circle-o-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <revision-component :revision="selectedRevision"></revision-component>
        </div>

    </div>
</template>
<script>
    import revision from './modulos/revision.vue'
    export default {
        mounted(){
            this.getRevisiones();
        },
        data () {
            return {
                revisiones: '',
                selectedRevision: '',
                showRevision: false
            }
        },
        methods: {
            getRevisiones(){
                axios.get('api/get/revisiones').then(r => {
                    this.revisiones = r.data;
                }).catch(e => {
                    console.log(e)
                })
            },
            initRevision(revision){
                this.selectedRevision = revision;
                this.showRevision = true;
            }
        },
        components: {
            'revision-component': revision
        }
    }
</script>
