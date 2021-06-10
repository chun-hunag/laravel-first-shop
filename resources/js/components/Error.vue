<template>
    <div class="container content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Error</div>

                    <div class="card-body">
                        <div>
                            <div class="form-group row">
                                <label for="error_message" class="col-md-4 col-form-label text-md-right invalid-feedback">{{errorMsg}}</label>
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
          errorMsg: ''
      }
    },
    methods : {

    },
    mounted : function () {
        this.errorMsg = this.$route.query.errorMessage;
    }
}
</script>