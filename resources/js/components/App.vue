<template>
    <router-view :user="user">
    </router-view>
</template>

<script>
export default {
    data: function() {
        return {
            user: {}
        };
    },
    mounted() {
        this.user = this.$attrs.user;
    },
    methods: {
    }
};
</script>
