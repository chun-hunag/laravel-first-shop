<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" v-model="email"  required autocomplete="email" autofocus>

                                <div v-if="showError('email')">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ getErrorMsg('email') }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" value="" v-model="password" required autocomplete="current-password">

                                <div v-if="showError('password')">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ getErrorMsg('password') }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" :checked="remember ? 'checked' : ''">

                                    <label class="form-check-label" for="remember">
                                       Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
<!-- 
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="button" v-on:click="login" class="btn btn-primary">
                                  Login
                                </button>
                                <a class="btn btn-link" href="'/password/request'">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
export default {
    data () {
      return {
          message : '',
          remember : false,
          email : '',
          password : '',
          errors : ''
          
      }
    },
    methods : {
        login: function () {
            new Promise((resolve, reject) => {
                axios.post('/login',{
                    'email' : this.email,
                    'password' : this.password,
                    'remember' : this.remember
                })
                .then(response => {
                    resolve(response);                    
                }).catch(error => {
                    if(error.response.status = 422){
                        this.errors = error.response.data.errors;
                    }
                });
            }).then(
                () => { // success
                    axios.get('/user/get-user-name')
                        .then(response => {
                            this.$store.commit('setUserName', response.data.name);
                            this.$store.commit('setIsGuest', false);
                            this.$router.push('index');
                            location.reload(); // refresh csrf token
                        })
                        .catch(error => {
                        });
                },
                () => { // failed
                }


            );

        },
        showError : function (columnName) {
            if(this.errors.hasOwnProperty(columnName)){
                return true;
            }
            return false;
        },
        getErrorMsg :function (columnName) {
            return this.errors[columnName][0];
        }
    }
}
</script>