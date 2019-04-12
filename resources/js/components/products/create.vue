<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <router-link to="/products" class="btn btn-danger">Atras</router-link>
                    <span v-if="id != 'null'">Actualizar</span><span v-else>Crear</span> Productos
                </div>
                <div class="card-body">
                    <form @submit.prevent="next()">
                        <div v-if="step == 1">
                            <div class="form-group">
                                <label for="" class="control-label">Categoria</label>
                                <select v-model="form.product_category_id" name="" id="" class="form-control">
                                    <option value="">Seleccionar</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                        {{category.name}}
                                    </option>
                                </select>
                            </div>                               
                            <div class="form-group">
                                <label for="" class="control-label">Nombre</label>
                                <input type="text" v-model="form.name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Descripción</label>
                                <textarea name="" v-model="form.description" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div> 
                            <div class="form-group" v-if="dropzoneOptions.url">
                                <label for="" class="control-">Subir fotografias</label>
                                <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>                            
                            </div>                            
                        </div>
                        <div v-if="step == 2">
                            <div class="row">
                                <div class="col-md-2" v-for="image in images" :key="image.id">
                                    <img :src="image.url" width="100%" alt="">
                                    <button class="btn btn-primary btn-block" type="button" @click="setImage(image.url)" :disabled="image.url == form.image">Seleccionar</button>
                                    <button class="btn btn-danger btn-block" type="button" @click="removeImage(image.id)" :disabled="image.url == form.image">Eliminar</button>
                                </div>
                            </div>
                        </div>    
                        <br>

                        <div class="form-group">
                            <button class="btn btn-default" type="button" @click="step = 1" v-if="step == 2">
                                <span>Anterior</span>
                            </button>                             
                            <button class="btn btn-success" :disabled="step == 2 && !form.image">
                                <span v-if="step == 1">Siguiente</span>
                                <span v-else>Guardar</span>
                            </button>    
                        </div>                                                            
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
export default {   
    props:['id'], 
    data(){
        return{
            form:{
                name:'',
                description:'',
                product_category_id:'',
                code:'',
                image:null
            },
            categories:[],
            dropzoneOptions: {
                    url: this.url,
                    thumbnailWidth: 150,
                    maxFilesize: 0.5,
                    headers: {
                        "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]').content
                    }                    
            },
            step:1,
            images:[]
        }
    },
    components: {
        vueDropzone: vue2Dropzone
    },    
    methods:{      
        getCategories(){
            axios.get(window.$backroutes.categories)
            .then(response => {
                this.categories = response.data
            })
            .catch(err => {
                alert(err)
            })
        },
        setImage(url){
            this.form.image = url;
        },
        getImages(){
            //Tomamos la misma url del dropzone
            axios.get(this.dropzoneOptions.url)
            .then(response => {
                this.images = response.data;
            })
            .catch(err => {
                alert(err)
            });
        },
        getEdit(id){
            axios.get(window.$backroutes.products(id))
            .then(response => {
                this.form = response.data
                this.dropzoneOptions.url = window.$backroutes.image(this.form.code);
            })
            .catch(err => {
                alert(err)
            })
        },
        next(){
            if(this.step == 1){
                this.getImages();
            }
            if(this.step == 2){
                if(this.id == 'null'){
                    axios.post(window.$backroutes.products(),this.form)
                    .then(response => {
                        this.$router.push('/products')
                        this.$toasted.show("Creado con exito !!", { 
                            theme: "bubble", 
                            position: "bottom-right",                                
                            duration : 5000
                        });                       
                    })
                    .catch(err => {
                        alert(err)
                    });
                }else{
                    axios.put(window.$backroutes.products(this.id),this.form)
                    .then(response => {
                        this.$router.push('/products')
                        this.$toasted.show("Actualizado con exito !!", { 
                            theme: "bubble", 
                            position: "bottom-right",                                
                            duration : 5000
                        });                       
                    })
                    .catch(err => {
                        alert(err)
                    });                    
                }
            }
            this.step++;
        },
        removeImage(id){
            axios.delete(window.$backroutes.image(id))
            .then(response => {
                this.getImages();
            })
            .catch(err => {
                alert(err)
            });
        }
    },
    mounted(){
        this.getCategories()
        if(this.id != 'null'){
            this.getEdit(this.id)
        }else{
            this.form.code = window.rand_code(6)
            this.dropzoneOptions.url = window.$backroutes.image(this.form.code);
        }
    }
}
</script>
