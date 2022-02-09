<template>
    <div>
        <h1>HOME INDEX</h1>
        <h3>{{ url }}</h3>
    </div>
</template>

<script>
export default {
    computed: {
        url() {
            let path = window.location.href;
            return `${path.split("/")[0]}//${path.split("/")[1]}${
                path.split("/")[2]
            }`;
        },
    },
};
</script>
