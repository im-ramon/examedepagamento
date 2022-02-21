<template>
    <div class="perfil_container">
        <h2>Perfil</h2>
        <ul>
            <li>
                <strong>Usuário:</strong>
                {{ $store.state.activeUser.name }}
            </li>
            <li>
                <strong>Posto/Grad:</strong>
                {{ $store.state.activeUser.post_grad }}
            </li>
            <li><strong>Email:</strong> {{ $store.state.activeUser.email }}</li>
            <li>
                <strong>Chefe da equipe:</strong>
                {{ $store.state.activeUser.ch_equipe_name }}
            </li>
            <li>
                <strong> Posto/Grad do chefe da euipe:</strong>
                {{ $store.state.activeUser.ch_equipe_pg }}
            </li>
            <li>
                <strong>Tipo de perfil:</strong>
                {{ $store.state.activeUser.userType }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {};
</script>
