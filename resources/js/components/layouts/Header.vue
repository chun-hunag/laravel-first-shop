<template>
  <div>
      <nav class="navbar navbar-expand-md navbar-light header shadow-sm" >
        <div class="container">
            <a class="navbar-brand" @click="goIndex()">
                First Shop
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto d-flex">
                    <!-- Authentication Links -->
                    <div v-if="isGuest">
                        <li class="nav-item">
                            <router-link :to="'/login'" class="nav-link"> Login </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/register'" class="nav-link"> Register </router-link>
                        </li>
                    </div>
                    <div v-else>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                {{ userName }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" @click="logout()">
                                   Logout
                                </a>

                                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                </form>
                            </div>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
  </div>
</template>

<script>
import axios from 'axios';
export default {
    data () {
      return {

      }
    },
    methods : {
        logout: function () {
            let jwtToken = this.$store.state.jwtToken;
            axios.post('/api/auth/logout', {},{
                headers: {
                    'Authorization': `Bearer ${jwtToken}`
                }
            })
            .then(response => {
                this.delCookie('token');
                this.$store.commit('setIsGuest', true);
                this.$router.push('index');
                location.reload(); // refresh csrf token
            }).catch(error => {
                console.log(error);
            });
        },
        goIndex: function () {
            this.$router.push('index');
        }
    },
    mounted: function () {
        let jwtToken = this.getCookie('token'); // get token from cookie
        if (jwtToken === null) { // if there is no token , not call api
            return
        }

        axios.get('/api/auth/me', {
            headers: {
                'Authorization': `Bearer ${jwtToken}`
            }
        })
        .then(response => {
            this.$store.commit('setUserName', response.data.last_name);
            if (this.userName !== '') { // 非空白 代表有登入
                this.$store.commit('setIsGuest', false);
                this.$store.commit('updateCart');  // 撈取cart 資料
            }
        })
        .catch(error => {
            
        });
    },
    computed : {
        userName: function () {
            return  this.$store.state.userName;
        },
        isGuest: function () {
            return this.$store.state.isGuest;
        }
    }
}
</script>