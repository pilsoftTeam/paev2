<template>
    <div>
        <el-tabs type="border-card">

            <el-tab-pane>
                <span slot="label">
                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                    &nbsp;
                    Información general
                </span>
                <informacion-general :info="evaluacion"></informacion-general>

            </el-tab-pane>
            <el-tab-pane>
                <span slot="label">
                    <i class="fa fa-font" aria-hidden="true"></i>
                    &nbsp;
                    Editor de la evaluacion
                </span>
                <editor-component :info="evaluacion"></editor-component>

            </el-tab-pane>

        </el-tabs>
    </div>
</template>
<script>
    import informacionGeneral from './tabs/infoGeneral.vue'
    import editor from './tabs/editor.vue'
    export default {
        data () {
            return {
                msg: 'Hello world!'
            }
        },
        props: {
            evaluacion: {
                required: true,
                type: Object
            }
        },
        components: {
            'informacion-general': informacionGeneral,
            'editor-component': editor
        }
    }
</script>
