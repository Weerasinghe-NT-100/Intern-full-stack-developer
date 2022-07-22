<template>
  <nav class="navbar navbar-expand-lg bg-light">
     <div class="container-fluid">
         <a class="navbar-brand" href="#">Navbar</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="mb-2 navbar-nav me-auto mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Products</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="#">Banners</a>
                </li>
             </ul>
         </div>
     </div>
</nav>
</template>

<script>
export default {
  name: 'NavBar',
}
</script>