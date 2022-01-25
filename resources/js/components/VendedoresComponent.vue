<template>
    <div>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-8">
                    <h2 class="text-center">
                        Vendedores
                    </h2>
                </div>
                <div class="col col-lg-2">
                    <router-link to="/vendedor/criar" class="nav-item nav-link"><i class="mdi mdi-account-plus-outline"></i> Novo Vendedor</router-link>
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="vendedor in vendedores.data" :key="vendedor.id">
                <td>{{ vendedor.id }}</td>
                <td>{{ vendedor.nome }}</td>
                <td>{{ vendedor.email }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'vendedorEditar', params: { id: vendedor.id }}" class="btn btn-success">Editar</router-link>
                        <button class="btn btn-danger" @click="deleteVendedor(vendedor.id)">Remover</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                vendedores: []
            }
        },
        created() {
            this.axios
                .get('http://localhost:8080/api/vendedores/')
                .then(response => {
                    this.vendedores = response.data;
                });
        },
        methods: {
            deleteVendedor(id) {
                this.axios
                    .delete(`http://localhost:8080/api/vendedores/${id}`)
                    .then(response => {
                        let i = this.vendedores.map(data => data.id).indexOf(id);
                        this.vendedores.splice(i, 1)
                    });
            }
        }
    }
</script>
