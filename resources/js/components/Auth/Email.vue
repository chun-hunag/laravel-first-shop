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

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="button" v-on:click="send" class="btn btn-primary">
                                  Send Password Reset Link
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
          errors : ''
          
      }
    },
    methods : {
        send: function () {
            axios.post('/password/email',{
                'email' : this.email,

            })
            .then(response => {
                this.$router.push({ name: 'index'});
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
    }
}
</script>