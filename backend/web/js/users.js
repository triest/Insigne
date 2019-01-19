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
            axios.get('admin/default/get')
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
                //  return this.users.filter(this.users=>{return users.username.match(this.searchName)})
            }
        }


    },
    beforeMount() {
        this.getUsers()
    }
})
