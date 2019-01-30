new Vue({
    el: '#usersApp',
    data: {
        users: [],
        searchLogin: "",
        searchName: "",
        searchFalily: "",
        searchPatronymic: "",
        searchEmail: "",
        currentSort: 'name',
        currentSortDir: 'asc',
        sortKey: '',
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

        sort: function (col) {
            console.log(col);
            this.currentSort(col);
           //  return this.users.items.sort(this.users.username, 'value', 'desc');
          //  return this.users.col.orderBy(this.users,col)


        },


    },
    computed: {
        filterName: function () {
            return this.users.filter(post => {
                return post.family.toLowerCase().includes(this.searchFalily.toLowerCase()) &&
                    post.username.toLowerCase().includes(this.searchLogin.toLowerCase()) &&
                    post.name.toLowerCase().includes(this.searchName.toLowerCase()) &&
                    post.patronymic.toLowerCase().includes(this.searchPatronymic.toLowerCase()) &&
                    post.email.toLowerCase().includes(this.searchEmail.toLowerCase())
            })
                .sort(function(a, b) {
                    a = a.name.toLowerCase();
                    b = b.name.toLowerCase();
                    return a < b ? 1 : b < a ? -1 : 0;
                });

        }
    },
    beforeMount() {
        this.getUsers()
    },

})
