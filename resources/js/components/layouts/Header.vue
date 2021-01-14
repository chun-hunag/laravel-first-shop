<template>
  <div>
      <nav class="navbar navbar-expand-md navbar-light header shadow-sm" >
        <div class="container">
            <a class="navbar-brand" href="/">
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
                        <li v-if="isGuest" class="nav-item">
                            <router-link :to="{name: 'register, query:{}'}" class="nav-link"> Register </router-link>
                        </li>
                    </div>
                    <div v-else>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{userName}} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/logout"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                   Logout
                                </a>

                                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                    @csrf
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
export default {
    data () {
      return {
          isGuest : true,
          isRegisterPage: false,
          userName : '',
      }
    },
    mounted : function () {
        new Promise((resolve, reject) => {
            axios.get('/user/is-guest')
                .then(response => {
                    this.isGuest = response.data.isGuest;
                    return resolve(response);
                })
                .catch(error => {

                });
        }).then(
            () => { // success
                axios.get('/user/get-user-name')
                     .then(response => {
                        this.userName = response.data.name;
                     })
                     .catch(error => {
                     });
            },
            () => { // failed
            }
        );        
    }
}
</script>