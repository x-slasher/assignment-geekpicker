<template>
    <div>
        <h4 class="text-center">Add Transfer</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addTransfer">
                    <div class="form-group">
                        <label>User Name</label>
                        <select class='form-control' v-model='transfer.receiver_id' >
                            <option value='0' >Select Name</option>
                            <option v-for='data in names' :value='data.id'>{{ data.name }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" class="form-control" v-model="transfer.amount">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Transfer</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            transfer: {},
            receiver_id: 0,
            names: []
        }
    },
    methods: {
        addTransfer() {
            this.$axios.post('/api/send-money', this.transfer)
                .then(response => {
                    this.$router.push({name:'main'})
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
        getNames: function(){
            axios.get('/api/all-users')
                .then(function (response) {
                    this.names = response.data.data;
                }.bind(this));

        }
    },
    created: function(){
        this.getNames()
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>
