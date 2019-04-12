<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><button @click="getModal(1)" class="btn btn-success">Añadir</button> Departamentos de productos</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nombre</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="d in departaments" :key="d.id">
                                    <td><img :src="d.image" width="80px" alt=""></td>
                                    <td>{{d.name}}</td>
                                    <td>
                                        <router-link :to="'/products/departaments/'+d.id" class="btn btn-default">Ver</router-link>
                                        <button @click="getDepartament(d.id)" class="btn btn-warning">
                                            Editar
                                        </button>
                                        <button @click="remove(d.id)" class="btn btn-danger">
                                            Eliminar
                                        </button>                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal" tabindex="-1" role="dialog" id="modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{action}} Departamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="addOrUpdate()">
                        <div class="form-group">
                            <label for="" class="control-label">Nombre</label>
                            <input type="text" v-model="departament.name" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>  
                </div>
                </div>
            </div>
            </div>            
        </div>

    </div>
</template>
<script>
    export default{
        data(){
            return{
                departament:{
                    name:''
                },
                departaments:[],
                action:'Añadir'
            }
        },
        methods:{
            getModal(mode){
                if(mode == 1){
                    this.action = "Añadir"
                }else if(mode == 2){
                    this.action = "Editar"
                }
                $('#modal').modal('toggle')
            },
            clean(){
                this.departament.name = ""
            },
            getDepartament(id){
                this.getModal(2);
                axios.get('/products/departaments/'+id)
                    .then(response => {
                        this.departament = response.data;
                    });
            },
            getDepartaments(){
                axios.get('/products/departaments')
                    .then(response => {
                        this.departaments = response.data;
                    })
            },
            addOrUpdate(){
                if(this.departament.id){
                    axios.put('/products/departaments/'+this.departament.id,this.departament)
                        .then(response => {
                            this.getDepartaments();
                            this.getModal()
                            this.clean()    
                            this.$toasted.show("Actualizado con exito !!", { 
                                theme: "bubble", 
                                position: "bottom-right",                                
                                duration : 5000
                            });                        
                        })
                }else{
                    axios.post('/products/departaments',this.departament)
                        .then(response => {
                            this.getDepartaments();
                            this.getModal()
                            this.clean()
                            this.$toasted.show("Guardado con exito !!", { 
                                theme: "bubble",  
                                position: "bottom-right",                            
                                duration : 5000
                            });                             
                        });
                }
            },
            remove(id){
                axios.delete('/products/departaments/'+id)
                    .then(response => {
                        this.getDepartaments();
                            this.$toasted.show("Eliminado con exito !!", { 
                                theme: "bubble", 
                                position: "bottom-right", 
                                duration : 5000
                            });                        
                    });
            }
        },
        mounted(){
            this.getDepartaments();
        }        
    }
</script>