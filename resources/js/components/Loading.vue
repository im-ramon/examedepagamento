<template>
    <div id="loading">
        <h1>Montando seu contracheque, aguarde...</h1>
        <img src="/svg/loading.svg" alt="Ícone de carregamento" />
    </div>
</template>

<script>
export default {
    mounted() {
        console.log("Component mounted.");
    },
};
</script>

<style>
@keyframes loading {
    100% {
        transform: rotate(360deg);
    }
}
#loading img {
    animation: loading 2s infinite linear;
    width: 150px;
}
#loading {
    display: flex;
    width: 100%;
    height: 100%;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}
</style>
