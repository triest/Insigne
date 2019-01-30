<?php

$this->registerJsFile('@web/js/users.js');
$this->title = "Список пользователей"
?>
<div id="usersApp" class="vue">
    <div class="admin-default-index">
        <!--serach for table -->
        <label>Login</label>
        <input v-model="searchLogin">
        <!--serach for table -->
        <label>Фамилия</label>
        <input v-model="searchFalily">
        <label>Имя</label>
        <input v-model="searchName">

        <label>Отчетво</label>
        <input v-model="searchPatronymic">
        <table class="table table-condensed">
            <label>Email</label>
            <input v-model="searchEmail">
            <table class="table table-condensed">

                <thead>
                <tr>

                    <th>
                        <a
                                href="#"
                                v-on:click="sort('username')">Login
                        </a>
                    </th>
                    <th>
                        <a
                                href="#"
                                v-on:click="sort('family')">Фамилия
                        </a>
                    </th>
                    <th>
                        <a
                                href="#"
                                v-on:click="sort('name')">Имя
                        </a>
                    </th>
                    <th>
                        <a
                                href="#"
                                v-on:click="sort('patronymic')">Отчество
                        </a>
                    </th>
                    <th>
                        <a
                                href="#"
                                v-on:click="sort('email')">Email
                        </a>
                    </th>
                    <th>Подробно</th>
                </tr>
                </thead>
                <tbody>

                <tr v-for="user in filterName">

                    <td>
                        {{user.username}}
                    </td>
                    <td>
                        {{user.family}}
                    </td>

                    <td>
                        {{user.name}}
                    </td>
                    <td>
                        {{user.patronymic}}
                    </td>
                    <td>
                        {{user.email}}
                    </td>
                    <td>
                        <!--  <a v-bind:href="admin/users/{user.id}">Подробно</a> -->

                        <a :href="'/admin/default/edit?id=' + user.id">Редактировать</a>
                    </td>

                </tr>
                </tbody>
            </table>
    </div>
</div>