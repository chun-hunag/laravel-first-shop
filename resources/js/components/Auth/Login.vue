<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <div method="" action="">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" :value="email" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control" name="password" :value="password" required autocomplete="current-password">

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
                                <button :onclick="login()" class="btn btn-primary">
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
        login () {
            // axios.defaults.withCredentials = true;
            // let param = { 
            //                 'email' : this.email,
            //                 'password' : this.password, 
            //             };
            // let url = '/login';
            // let options = {
            //     method: 'POST',
            //     headers: {           
            //                 'X-Requested-With' : 'XMLHttpRequest',
            //                 'Access-Control-Allow-Credentials': true
            //              },
            //     data: param,
            //     withCredentials: true, // 默认的
            //     url,
            // };
            axios({ 
                    method: 'post', 
                    url: '/login', 
                    headers: { 
                        'X-Requested-With' : 'XMLHttpRequest' 
                    },
                    params: { 
                        'email' : this.email,
                        'password' : this.password, 
                    },
                    // xsrfHeaderName: 'X-XSRF-TOKEN', // default
                    // withCredentials: true, // 默认的
                  })    
            .then(reponse => {
                console.log(response);
            }).catch(error => {
                console.log(error);
            });


            // axios.request(options)
            // .then(reponse => {
            //     console.log(response);
            // }).catch(error => {

            // });
            // axios.get(
            // {
            //     url :　'/login',
            //     params : {
            //         'email' : this.email,
            //         'password' : this.password,
            //     },
            //     headers : {
            //         'X-CSRF-TOKEN2' : document.head.querySelector('meta[name="csrf-token"]'),
            //         'X-Requested-With' : 'XMLHttpRequest'
            //     }

            // })
            // .then(reponse => {
            //     console.log(response);
            // }).catch(error => {

            // });
        }
    }
}
</script>