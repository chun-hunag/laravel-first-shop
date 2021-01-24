<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>

                    <div class="card-body">
                        <div>
                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control" name="first_name" v-model="firstName" required autocomplete="first_name" autofocus>

                                    <div v-if="showError('first_name')">
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ getErrorMsg('first_name') }}</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control" name="last_name" v-model="lastName" required autocomplete="last_name" autofocus>

                                    <div v-if="showError('last_name')">
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ getErrorMsg('last_name')}}</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" v-model="email" required autocomplete="email">

                                    <div v-if="showError('email')">
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ getErrorMsg('email') }}</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cellphone" class="col-md-4 col-form-label text-md-right">Cellphone</label>

                                <div class="col-md-6">
                                    <input id="cellphone" type="text" class="form-control" name="cellphone" v-model="cellphone" required autocomplete="cellphone">

                                    <div v-if="showError('cellphone')">
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ getErrorMsg('cellphone') }}</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" v-model="password" required autocomplete="new-password">

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
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" v-model="passwordConfirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="button"  v-on:click="register" class="btn btn-primary">
                                        Register
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
export default {
    data () {
      return {
          firstName : '',
          lastName : '',
          email : '',
          cellphone : '',
          password : '',
          passwordConfirmation : '',
          errors : ''
      }
    },
    methods : {
        register : function () {
            new Promise((resolve, reject) => {
             axios.post('/register',{
                'first_name' : this.firstName,
                'last_name' : this.lastName,
                'email' : this.email,
                'cellphone' : this.cellphone,
                'password' : this.password,
                'password_confirmation' : this.passwordConfirmation
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
    },
    computed : {

    }
}
</script>