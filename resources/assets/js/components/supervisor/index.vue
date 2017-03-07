<template>
    <div>
        <div class="container">
            <el-tabs v-model="activeName">
                <el-tab-pane label="Asignacion de checklists" name="usuario">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <asignacion-usuarios></asignacion-usuarios>
                        </div>
                    </div>
                </el-tab-pane>
                <el-tab-pane label="Confi" name="R">Config</el-tab-pane>
                <el-tab-pane label="Role" name="third">Role</el-tab-pane>
                <el-tab-pane label="Task" name="fourth">Task</el-tab-pane>
            </el-tabs>
        </div>


    </div>
</template>
<script>
    import asignacionUsuarios from './asignacion/index.vue'
    export default {
        data () {
            return {
                activeName: 'usuario'
            }
        },
        components: {
            'asignacion-usuarios': asignacionUsuarios
        }
    }
</script>
