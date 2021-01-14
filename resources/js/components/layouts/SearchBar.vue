<template>
  <div class="m-1 seachbar-container">
      <div class="container d-flex">
        <div class="col-md-3 mx-1 text-right"><i class="fab fa-shopify icon blue-mid"></i></div>
        <div class="col-md-6 search-bar">
            <form class="" method="POST" action="">
                <div class="d-flex bg-white">
                    <input class="col-md-10 search-input" type="text" name="search-content">
                      <button class="col-md-2 p-1 bg-blue-mid search-btn " ><i class="fas fa-search bg-blue-mid white icon"></i></button>
                </div>
            </form>
        </div>
        <div class="col-md-3 mx-1 text-left"><i class="fas fa-shopping-cart blue-mid icon"></i></div>
    </div>
  </div>
</template>

<script>
export default {
    data () {
      return {
      }
    }
}
</script>