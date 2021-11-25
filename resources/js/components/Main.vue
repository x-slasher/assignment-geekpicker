<template>
    <div>
        <h4 class="text-center">Dashboard</h4><br/>
        <h4>Total converted amount: </h4><p>{{userData.total}}</p>
        <h4>Third highest conversion: </h4><p>{{userData.third}}</p>
        <h4>Most conversion user: </h4><p>{{userData.most}}</p>

        <button type="button" class="btn btn-info" @click="this.$router.push('/books/add')">Make Transfer</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            userData: [],
        }
    },
    created() {

        this.$axios.get('/api/total-transaction')
            .then(response => {
                this.userData.total = response.data.data;
            })
            .catch(function (error) {
                console.error(error);
            });
        this.$axios.get('/api/third-transaction')
            .then(response => {
                this.userData.third = response.data.data;
            })
            .catch(function (error) {
                console.error(error);
            });
        this.$axios.get('/api/most-transaction')
            .then(response => {
                this.userData.most = response.data.data[0].users.name;
            })
            .catch(function (error) {
                console.error(error);
            });
    },
    methods: {
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>
