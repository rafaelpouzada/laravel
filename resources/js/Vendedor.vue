<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/" class="nav-item nav-link">Vendas</router-link>
                    <router-link to="/vendedores" class="nav-item nav-link">Vendedores</router-link>
                    <router-link to="/vendedor/criar" class="nav-item nav-link">Criar Vendedor</router-link>
                </div>
            </div>
        </nav>

        <router-view> </router-view>
    </div>
</template>

<script>
    export default {}
</script>
