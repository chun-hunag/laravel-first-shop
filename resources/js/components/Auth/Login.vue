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

                                <div v-if="false">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ message }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" value="" v-model="password" required autocomplete="current-password">

                                <div v-if="false">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ message }}</strong>
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

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="button" v-on:click="login" class="btn btn-primary">
                                  Login
                                </button>
                                <a class="btn btn-link" href="'/password/request'">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
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
          
      }
    },
    methods : {
        login: function () {
            let email = this.email;
            let password = this.password;
            axios.post('/login',{
                'email' : email,
                'password' : password,
                })
                .then(response => {                    

                }).catch(error => {

                });
        }
    }
}
</script>