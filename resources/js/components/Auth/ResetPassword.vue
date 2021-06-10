<template>
<div class="container content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Reset Password</div>

                <div class="card-body">
                    <div>
                        <!-- Email Input -->
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
                        <!-- Password Input -->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" value="" v-model="password" name="password" required autocomplete="new-password">
                                <div v-if="showError('password')">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ getErrorMsg('password') }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" v-model="passwordConfirmation" name="password_confirmation"  required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="button" v-on:click="reset" class="btn btn-primary">
                                  Reset Password
                                </button>
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
          email : '',
          password : '',
          passwordConfirmation : '',
          token : '',
          errors : ''
          
      }
    },
    methods : {
        reset: function () {
            axios.post('/password/reset',{
                'email' : this.email,
                'password' : this.password,
                'password_confirmation' : this.passwordConfirmation,
                'token' : this.token

            })
            .then(response => {
                console.log(response.data);
            }).catch(error => {
                if(error.response.status = 422){
                    this.errors = error.response.data.errors;
                }
            });
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
    },
    mounted: function () {
        this.email = this.$route.query.email;
        this.token = this.$route.query.token;
    }
}
</script>