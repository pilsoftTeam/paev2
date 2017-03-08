<template>
    <div class="container">
        <el-tabs v-model="activeName">
            <el-tab-pane label="Checklists" name="checklists">
                <checklists-component></checklists-component>
            </el-tab-pane>
            <el-tab-pane label="Usuarios" name="usuarios"><i class="fa fa-user"></i></el-tab-pane>
            <el-tab-pane label="Asignacion bodegas/checklists" name="asignacion">
                <asignacion-bodegas-checklists></asignacion-bodegas-checklists>
            </el-tab-pane>
            <el-tab-pane label="Task" name="fourth">Task</el-tab-pane>
        </el-tabs>


    </div>
</template>
<script>
    import checklists from './checklists.vue'
    import asignacionBodegasChecklists from './asignacionBodegasChecklist.vue'
    export default {
        mounted() {

        },
        data(){
            return {
                activeName: 'checklists'
            }
        },
        methods: {},
        computed: {},
        components: {
            'checklists-component': checklists,
            'asignacion-bodegas-checklists': asignacionBodegasChecklists
        }
    }
</script>
