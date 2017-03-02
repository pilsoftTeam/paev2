<template>
    <div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Evaluacion</th>
                            <th>Agrupacion</th>
                            <th>Item</th>
                            <th>Checklist</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Dolly</td>
                            <td>Dolly</td>
                            <td>Dolly</td>
                            <td>Dolly</td>
                        </tr>
                        </tbody>
                    </table>
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
            return {}
        },
        props: {
            info: {
                required: true,
                type: Object
            }
        },
        methods: {
            init(){
                axios.get('api/get/evaluacion/info/' + this.info.id).then(r => {
                    console.log(r.data);
                }).catch(e => {
                    console.log(e);
                })
            }
        }
    }
</script>
