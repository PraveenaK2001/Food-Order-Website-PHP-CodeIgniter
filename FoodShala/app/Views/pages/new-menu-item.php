
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
      <li class="nav-item">
        <a class="nav-link" href="/FoodShala/public/dashboard" >Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/FoodShala/public/" >FoodShala Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/FoodShala/public/my-res-menu">My Restaurant Menu</a>
      </li>
      <li class="nav-item  active">
        <a class="nav-link" href="#">Add New Menu Item</a>
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
    
  </div>
  <a class="nav-link" href="/FoodShala/public/user-login">Sign In</a>&nbsp;&nbsp;
  <a class="nav-link" href="/FoodShala/public/user-registration">Sign Up</a>
    <?php
}
?>
  
</nav>



  <h2>Enter Menu Item Details</h2>


              <form  method="post" >
                  <div class="col-sm-3 my-1">
                      <label  for="iname" >Item Name</label>
                      <div >
                          <input class="form-control" type="text" name="iname" id="iname" >
                      </div>
                  </div>

                  <div class="col-sm-3 my-1">
                      <label for="itype" >Item Type</label>
                      <div >

                          <select  class="form-control" name="itype"id="itype">
                                <option value="veg" selected>Veg</option>
                                <option value="nonveg">Non Veg</option>
                          </select>
                
                      </div>
                  </div>

                  <div class="col-sm-3 my-1">
                      <label for="icost">Item Cost</label>
                      <div>
                          <input class="form-control" type="text" name="icost" id="icost">
                      </div>
                  </div>
                  
                  
                  
                  <div class="col-sm-3 my-1">
              <input type="submit" class="btn btn-primary" value="Add Menu Item" formaction="/FoodShala/public/MenuItem/New-Menu-Item" >
            </div>
              <div class="col-sm-3 my-1" >
                
                <?= \Config\Services::validation()->listErrors();?>
              </div>

              </form>
  </body>
  <?php include_once(APPPATH.'/views/layouts/footer.php')?>