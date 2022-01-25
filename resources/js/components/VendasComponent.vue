<template>
    <div>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-8">
                    <h2 class="text-center">
                        Vendas
                    </h2>
                </div>
                <div class="col col-lg-2">
                    <router-link to="/vendas/criar" class="nav-item nav-link"><i class="mdi mdi-cart-plus"></i> Nova Venda</router-link>
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Vendedor</th>
                <th>Valor</th>
                <th>Comissao</th>
                <th>Data</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="venda in vendas.data" :key="venda.id">
                <td>{{ venda.id }}</td>
                <td>{{ venda.nome }}</td>
                <td>{{ venda.valor }}</td>
                <td>{{ venda.comissao }}</td>
                <td>{{ venda.data_venda | formatDate }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                vendas: []
            }
        },
        created() {
            this.axios
                .get('http://localhost:8080/api/vendas/')
                .then(response => {
                    this.vendas = response.data;
                });
        },
        methods: {

        }
    }
</script>
