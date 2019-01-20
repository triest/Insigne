<?php

$this->registerJsFile('@web/js/user.js');
?>
<div id="usersApp" class="vue">
    <div class="admin-default-index">
        <!--serach for table -->
        <label>Login</label>

      <!--      <input type="text"  v-model="searchName" v-on:keyup="searchNameFunction()"  placeholder="Search title.."/>-->
            <label>Search title:</label>



        <table class="table table-condensed">
            <thead>
            <tr>

                <th>Login</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>email</th>
                <th>Подробно</th>
            </tr>
            </thead>
            <tbody>

            <tr v-for="user in users">

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