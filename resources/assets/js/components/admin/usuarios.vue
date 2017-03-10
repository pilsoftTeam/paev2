<template>
    <div class="row">
        <data-source
                language="es"
                :table-data="information.data"
                :columns="columns"
                :pagination="information.pagination"
                :actions="actions"
                @change="changePage"
                @searching="onSearch"></data-source>
    </div>
</template>
<script>
    export default {
        data () {
            let self = this;
            return {
                selectedItems: {
                    idBodega: '',
                    idChecklist: ''
                },
                checklists: '',
                assignChecklistToBodega: false,
                editChecklistToBodega: false,
                removeChecklistToBodega: false,
                information: {
                    pagination: {},
                    data: []
                },
                columns: [
                    {
                        name: 'Nombre',
                        key: 'name',
                    },
                    {
                        name: 'Email',
                        key: 'email',
                    },
                    {
                        name: 'Rol',
                        key: 'rol',
                    },

                ],
                actions: [
                    {
                        text: 'Asignar Checklists',
                        icon: 'fa fa-plus-circle',
                        class: 'btn-info btn-sm',
                        event(e, row) {
                            if (row) {
                                self.initAssign(row);
                            }

                        }
                    },
                    {
                        text: 'Editar Checklists asignado',
                        icon: 'fa fa-pencil',
                        class: 'btn-warning btn-sm',
                        event(e, row) {
                            if (row.row.idChecklist) {
                                self.editAssign(row);
                            } else {
                                self.warning('Esta bodega aun no tiene un checklist asignado.  No se puede editar');
                            }

                        }
                    },
                    {
                        text: 'Remover checklist',
                        icon: 'fa fa-times',
                        class: 'btn-danger btn-sm',
                        event(e, row) {
                            if (row.row.idChecklist) {
                                self.removeAssign(row);
                            } else {
                                self.warning('Esta bodega aun no tiene un checklist asignado.  No se puede remover la asignacion');
                            }
                        }
                    },
                ],


            }
        }
    }
</script>
