<template>
    <div>

        <section v-if="errored">
            <section v-for="erro in erros">
                <div v-for="err in erro">{{ err }}</div>
            </section>
        </section>

        <h3 class="text-center">Nova Venda</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addVenda">
                    <div class="form-group">
                        <label>Valor</label>
                        <input type="number" step="0.01" pattern="^\d*(\.\d{0.2})?$" min="0.01" class="form-control" v-model="venda.valor">
                    </div>
                    <div class="form-group">
                        <label>Vendedor</label>
                        <select class="form-control" v-model="venda.vendedor_id">
                            <option value="" disabled selected>Selecione um vendedor</option>
                            <option v-for="vendedor in vendedores.data" :key="vendedor.id" :value="vendedor.id">{{ vendedor.nome }}</option>
                        </select>
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
                venda: {},
                vendedores: {},
                erros: [],
                errored: false
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
            addVenda() {
                this.axios
                    .post('http://localhost:8080/api/vendas', this.venda)
                    .then(response => (
                        this.$router.push({ name: 'home' })
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
