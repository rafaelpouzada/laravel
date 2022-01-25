<template>
    <div>

        <section v-if="errored">
            <section v-for="erro in erros">
                <div v-for="err in erro">{{ err }}</div>
            </section>
        </section>

        <h3 class="text-center">Cadastrar Vendedor</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addVendedor">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" v-model="vendedor.nome">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" v-model="vendedor.email">
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                vendedor: {},
                erros: [],
                errored: false
            }
        },
        methods: {
            addVendedor() {
                this.axios
                    .post('http://localhost:8080/api/vendedores', this.vendedor)
                    .then(response => (
                        this.$router.push({ name: 'vendedores' })
                    ))
                    .catch((error) => {
                        this.erros = error.response.data.error;
                        console.log(this.erros);
                        this.errored = true
                    })
                    .finally(() => this.loading = false)
            }
        }
    }
</script>
