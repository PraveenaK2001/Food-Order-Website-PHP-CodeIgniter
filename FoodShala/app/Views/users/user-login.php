
<?php 
$local_session = \Config\Services::session();
 ?>
<?php include_once(APPPATH.'/views/layouts/header.php')?>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">FoodShala</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<?php 
  if($local_session->get('utype')==="customer")
  {
?>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#" >Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/FoodShala/public/view-cart">View Cart</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/FoodShala/public/user-logout">Logout</a>
      </li>

      
    </ul>
  </div>
  

<?php 
}
else if($local_session->get('utype')==="restaurant")
{
?>
 <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#" >Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">My Restaurant Menu</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/FoodShala/public/MenuItem/New-Menu-Item">Add New Menu Item</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/FoodShala/public/user-logout">Logout</a>
      </li>

      
    </ul>
  </div>

<?php
}
else
{
  ?>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/FoodShala/public/" >Home <span class="sr-only">(current)</span></a>
      </li>
  
      
    </ul>
  </div>
  <a class="nav-link" href="#">Sign In</a>&nbsp;&nbsp;
  <a class="nav-link" href="/FoodShala/public/user-registration">Sign Up</a>
    <?php
}
?>
  
</nav>
	
<h2>Member Login</h2>


              <form  method="post" >
                  <div class="col-sm-3 my-1">
                      <label for="email">Your Email</label>
                      <div>
                          <input class="form-control" type="email" name="email" id="email">
                      </div>
                  </div>
                  
                  
                  <div class="col-sm-3 my-1">
                      <label for="pass">Your Password</label>
                      <div>
                          <input class="form-control" type="Password" name="pass" id="pass">
                      </div>
                  </div>
                  
                  
                  <div class="col-sm-3 my-1">
              <input type="submit" class="btn btn-primary" value="Login" formaction="/FoodShala/public/user-authenticate" >
            </div>
              <div class="col-sm-3 my-1" >
                
                <?= \Config\Services::validation()->listErrors();?>
              </div>

              </form>

</body>
<?php include_once(APPPATH.'/views/layouts/footer.php')?>