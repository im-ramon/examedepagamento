<template>
    <div class="perfil_container">
        <h2>Perfil</h2>
        <form>
            <div class="perfil_input">
                <label for="perfil_nome"><strong>Usuário:</strong></label>
                <input
                    type="text"
                    id="perfil_nome"
                    :value="$store.state.activeUser.name"
                    disabled
                />
            </div>

            <div class="perfil_input">
                <label for="perfil_post_grad"
                    ><strong>Posto/Grad:</strong></label
                >
                <input
                    type="text"
                    id="perfil_post_grad"
                    :value="$store.state.activeUser.post_grad"
                    disabled
                />
            </div>

            <div class="perfil_input">
                <label for="perfil_email"><strong>E-mail:</strong></label>
                <input
                    type="text"
                    id="perfil_email"
                    :value="$store.state.activeUser.email"
                    disabled
                />
            </div>
            <div class="perfil_input">
                <label for="perfil_ch_equipe_name"
                    ><strong>Chefe da equipe:</strong></label
                >
                <input
                    type="text"
                    id="perfil_ch_equipe_name"
                    :value="$store.state.activeUser.ch_equipe_name"
                    disabled
                />
            </div>
            <div class="perfil_input">
                <label for="perfil_ch_equipe_pg"
                    ><strong>P/G chefe da equipe:</strong></label
                >
                <input
                    type="text"
                    id="perfil_ch_equipe_pg"
                    :value="$store.state.activeUser.ch_equipe_pg"
                    disabled
                />
            </div>
            <div class="perfil_input">
                <label for="perfil_userType">
                    <strong>Nível de acesso:</strong>
                </label>
                <input
                    type="text"
                    id="perfil_userType"
                    :value="$store.state.activeUser.userType"
                    disabled
                />
            </div>
            <div class="perfil_input">
                <label for="perfil_local_assinatura">
                    <strong>Local da assinatura: </strong>
                </label>
                <input
                    type="text"
                    id="perfil_local_assinatura"
                    :value="$store.state.activeUser.local_assinatura"
                    disabled
                />
            </div>
            <div class="perfil_input">
                <label for="perfil_om">
                    <strong>OM: </strong>
                </label>
                <input
                    type="text"
                    id="perfil_om"
                    :value="$store.state.activeUser.om"
                    disabled
                />
            </div>
        </form>
    </div>
</template>

<script>
export default {};
</script>

<style>
.perfil_container form {
    padding-left: 1.2em;
    width: calc(100% - 1.2em);
}
.perfil_input {
    width: 100%;
    display: flex;
}
.perfil_container input {
    margin-bottom: 0.7em;
    flex: 1;
    margin-left: 1em;
}
</style>
