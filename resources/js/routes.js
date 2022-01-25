import Vendas from './components/VendasComponent.vue';
import CriarVenda from './components/CriarVendaComponent.vue';
import Vendedores from './components/VendedoresComponent.vue';
import CriarVendedor from './components/CriarVendedorComponent.vue';
import EditarVendedor from './components/EditarVendedorComponent.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Vendas
    },
    {
        name: 'vendasCriar',
        path: '/vendas/criar',
        component: CriarVenda
    },
    {
        name: 'vendedores',
        path: '/vendedores',
        component: Vendedores
    },
    {
        name: 'vendedorCriar',
        path: '/vendedor/criar',
        component: CriarVendedor
    },
    {
        name: 'vendedorEditar',
        path: '/vendedor/editar/:id',
        component: EditarVendedor
    }
];
