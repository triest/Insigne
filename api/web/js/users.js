new Vue({
    el: '#usersApp',
    data: {
        users: [],
        searchLogin: "",
        searchName: "",
        searchFalily: "",
        searchPatronymic: ""
    },
    methods: {
        getUsers: function () {
            axios.get('/admin/default/get')
                .then(
                    response => {

                        this.users = response.data;
                    }
                )
                .catch(
                    // error=>console.log(error)
                )
        },
        searchNameFunction: function () {
            return users;
        },
        computed: {
            filterName: function () {
                console.log("filetes");
                //  return this.user.filter(this.user=>{return user.username.match(this.searchName)})
            }
        }


    },
    beforeMount() {
        this.getUsers()
    }
})
