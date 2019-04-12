<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <router-link to="/products/create/null" class="btn btn-success">Añadir</router-link> Mis Productos
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="list in lists" :key="list.id">
                                <td><img width="80px" :src="list.image" alt=""> </td>
                                <td>{{list.name}}</td>
                                <td>{{list.description}}</td>
                                <td>
                                    <router-link :to="'/products/create/'+list.id" class="btn btn-warning">Editar</router-link>
                                    <button @click="remove(list.id)" class="btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
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
    data(){
        return{
            lists:[]
        }
    },
    methods:{
        getList(){
            axios.get(window.$backroutes.products())
            .then(response => {
                this.lists = response.data
            })
            .catch(err => {
                alert(err)
            });
        },
        remove(id){
            axios.delete(window.$backroutes.products(id))
            .then(response => {
                this.getList()
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
        this.getList()
    }
}
</script>

