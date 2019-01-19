
new Vue({
    el: '#usersApp',
    data:{

    },
    methods: {
        getUsers: function () {
            axios.get('admin/default/get')
                .then(
                    response=> {
                           console.log(response.data);
                        this.tasks=response.data;
                    }
                )
                .catch(
                    // error=>console.log(error)
                )
        }
    },
    beforeMount(){
        this.getUsers()
    }
})
