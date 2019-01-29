new Vue({
    el: '#usersApp',
    data: {
        users: [],
        searchLogin: "",
        searchName: "",
        searchFalily: "",
        searchPatronymic: "",
        currentSort:'name',
        currentSortDir:'asc',
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

        sort:function(col) {
            //if s == current sort, reverse
         // return   this.users.items.sort(this.users.username, 'value', 'desc');
            //return this.users.orderBy(this.users,'login')

            console.log(this.currentSortDir)
         //   return this.users.orderBy(this.users,'name','ASC')
            //this.users.sort(this.users.username)
           /* if(this.currentSortDir=='ASC'){
                this.currentSortDir='DESC';
            }
            else{
                this.currentSortDir='ASC';
            }*/

        },



    },
    computed: {
        filterName: function () {
            return this.users.filter(post => {
                return post.username.toLowerCase().includes(this.searchLogin.toLowerCase())
            })
            return this.users;
        }
    },
    beforeMount() {
        this.getUsers()
    },

})
