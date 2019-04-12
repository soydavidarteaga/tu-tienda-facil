import HomeComponent from './components/Home.vue'
import ProductDepartament from './components/products/departaments/index.vue'
import showProductDepartament from './components/products/departaments/show.vue'
import product from './components/products/index.vue'
import createProduct from './components/products/create.vue'
import VueRouter from 'vue-router'
const routes = [
    {
         path:'/',
         component:HomeComponent
    },
    {
        path:'/products/departaments',
        component:ProductDepartament
    },
    {
        path:'/products/departaments/:id',
        component:showProductDepartament,
        props:true
    },
    {
        path:'/products',
        component:product
    },
    {
        path:'/products/create/:id',
        component:createProduct,
        props:true
    }
]
const router = new VueRouter({
    routes
});

export default router;