<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <router-link to="/products/departaments/" class="btn btn-default">Atras</router-link>
                    <button class="btn btn-success" @click="getModal()">Añadir Categoria</button>
                </div>
                <div class="card-body">
                    <h3 class="text-center">Categorias del {{departament.name}}</h3>
                    <div class="table-responsive">
                        <table class="table table-hovered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="list in lists" :key="list.id">
                                    <td>{{list.name}}</td>
                                    <td>
                                        <button class="btn btn-warning" @click="getEdit(list.id)">Editar</button>
                                        <button class="btn btn-danger" @click="remove(list.id)">Borrar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span v-if="form.id">Editar</span><span v-else>Crear</span> Categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="addOrUpdate()">
                        <div class="form-group">
                            <label for="" class="control-label">Nombre</label>
                            <input type="text" v-model="form.name" class="form-control">
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
</template>

<script>
export default {
    props:['id'],
    data(){
        return{
            departament:{
                name:''
            },
            lists:[],
            form:{
                name:'',
                product_departament_id:this.id
            }
        }
    },
    methods:{
        getModal(){
            $('#modal').modal('toggle')
        },
        clean(){
            this.form.name = ""
            this.form.id = ""
        },
        getDepartament(){
            axios.get(window.$backroutes.departaments+"/"+this.id)
            .then(response => {
                this.departament = response.data
            })
            .catch(err => {
                alert(err)
            });
        },
        getList(){
            axios.get(window.$backroutes.categories)
            .then(response => {
                this.lists = response.data
            })
            .catch(err => {
                alert(err)
            })
        },
        addOrUpdate(){
            if(this.form.id){
                axios.put(window.$backroutes.categories+'/'+id,this.form)
                .then(response => {
                    this.getList();
                    this.getModal()
                    this.clean()    
                    this.$toasted.show("Actualizado con exito !!", { 
                        theme: "bubble", 
                        position: "bottom-right",                                
                        duration : 5000
                    });                   
                })
                .catch(err => {
                    alert(err)
                });
            }else{
                axios.post(window.$backroutes.categories,this.form)
                .then(response => {
                    this.getList();
                    this.getModal()
                    this.clean()    
                    this.$toasted.show("Guardado con exito !!", { 
                        theme: "bubble", 
                        position: "bottom-right",                                
                        duration : 5000
                    });                   
                })
                .catch(err => {
                    alert(err)
                });
            }
        },
        getEdit(id){
            axios.get(window.$backroutes.categories+'/'+id)
            .then(response => {
                this.form = response.data
                this.getModal()
            })
            .catch(err => {
                alert(err)
            })
        },
        remove(id){
            axios.delete(window.$backroutes.categories+'/'+id)
            .then(response => {
                this.getList();
                this.getModal()
                this.clean()    
                this.$toasted.show("Eliminado con exito !!", { 
                    theme: "bubble", 
                    position: "bottom-right",                                
                    duration : 5000
                });                   
            })
            .catch(err => {
                alert(err)
            });
        }
    },
    mounted(){
        this.getDepartament()
        this.getList()
    }
}
</script>

