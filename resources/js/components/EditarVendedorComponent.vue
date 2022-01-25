<template>
    <div>
        <h3 class="text-center">Editar Vendedor</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateVendedor">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" v-model="vendedor.nome">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" v-model="vendedor.email">
                    </div>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                vendedor: {}
            }
        },
        created() {
            this.axios
                .get(`http://localhost:8080/api/vendedores/${this.$route.params.id}`)
                .then((res) => {
                    this.vendedor = res.data;
                });
        },
        methods: {
            updateVendedor() {
                this.axios
                    .patch(`http://localhost:8080/api/vendedores/${this.$route.params.id}`, this.vendedor)
                    .then((res) => {
                        this.$router.push({ name: 'vendedores' });
                    });
            }
        }
    }
</script>
