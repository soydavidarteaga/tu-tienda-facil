import HomeComponent from './components/Home.vue'
import ProductDepartament from './components/products/Departaments.vue'
import VueRouter from 'vue-router'
const routes = [
    {
         path:'/',
         component:HomeComponent
    },
    {
        path:'/products/departaments',
        component:ProductDepartament
    }
]
const router = new VueRouter({
    routes
});

export default router;