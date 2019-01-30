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
        sortKey: 'username',
        sortOrder: 1
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
                    error => console.log(error)
                )
        },
        searchNameFunction: function () {
            return users;
        },

        sort: function (col) {
            this.sortKey = col;
            this.sortOrder = -this.sortOrder;
        },
    },
    computed: {
        filterName: function () {
            var that = this;
            return this.users.filter(post => {
                return post.family.toLowerCase().includes(this.searchFalily.toLowerCase()) &&
                    post.username.toLowerCase().includes(this.searchLogin.toLowerCase()) &&
                    post.name.toLowerCase().includes(this.searchName.toLowerCase()) &&
                    post.patronymic.toLowerCase().includes(this.searchPatronymic.toLowerCase()) &&
                    post.email.toLowerCase().includes(this.searchEmail.toLowerCase())
            })
                .sort(function (a, b) {
                    a = a[that.sortKey].toLowerCase();
                    b = b[that.sortKey].toLowerCase();
                    if (that.sortOrder == 1) {
                        return a < b ? 1 : b < a ? -1 : 0;
                    }
                    else {
                        return a > b ? 1 : b > a ? -1 : 0;
                    }
                });

        }
    },
    beforeMount() {
        this.getUsers()
    },

})
