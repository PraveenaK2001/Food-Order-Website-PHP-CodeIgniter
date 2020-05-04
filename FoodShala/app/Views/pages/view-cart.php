
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
      <li class="nav-item ">
        <a class="nav-link" href="/FoodShala/public/" >Home </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">View Cart<span class="sr-only">(current)</span></a>
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
    
  </div>
  <a class="nav-link" href="/FoodShala/public/user-login">Sign In</a>&nbsp;&nbsp;
  <a class="nav-link" href="/FoodShala/public/user-registration">Sign Up</a>
    <?php
}
?>
  
</nav>
	
  <h2>To place order for following items in your cart, click&nbsp;<a href="/FoodShala/public/place-order" class="btn btn-primary">Order these items</a></h2>

  <?php foreach($allitems as $Cart_Item):?>
<div class="card w-75">
  <div class="card-body">
    <h5 class="card-title"><?=$Cart_Item['Item_Name']?>&nbsp;&nbsp;<small><?=$Cart_Item['Item_Type']?></small>&nbsp;&nbsp;<small>Rs <?=$Cart_Item['Item_Cost']?></small>&nbsp;&nbsp;<small><a href="
<?='/FoodShala/public/Remove-From-Cart/'.$Cart_Item['Item_Id']?>

      " class="btn btn-primary">Remove from cart</a></small></h5>
    
  </div>
</div>



<?php endforeach;?>

</body>
<?php include_once(APPPATH.'/views/layouts/footer.php')?>