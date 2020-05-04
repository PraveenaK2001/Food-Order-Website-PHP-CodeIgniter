
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

      <li class="nav-item ">
        <a class="nav-link" href="/FoodShala/public/dashboard" >Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#" >FoodShala Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/FoodShala/public/my-res-menu">My Restaurant Menu</a>
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
	
<?php 
if($local_session->get('utype')==="customer")
{
?>

  <h2>Select an item to order and add to cart</h2>
<?php 
}
else
{
?>
<h2>FoodShala Home Page - All Restaurants Food List</h2>
 <?php  
}
?>


 

  <?php foreach($allitems as $Menu_Item):?>
<div class="card w-75">
  <div class="card-body">
    <h5 class="card-title"><?=$Menu_Item['Item_Name']?>&nbsp;&nbsp;<small><?=$Menu_Item['Item_Type']?></small>&nbsp;&nbsp;<small>Rs <?=$Menu_Item['Item_Cost']?></small>&nbsp;&nbsp;

<?php 
if($local_session->get('utype')!="restaurant")
{
?>

      <small><a href="<?='/FoodShala/public/AddToCart/'.$Menu_Item['Item_Id']?>" class="btn btn-primary">Add to cart</a></small>
<?php 
}
?>

      <br>
      <small>From Restaurant:&nbsp;<?=$Menu_Item['Rest_Name']?></small>

    </h5>

    
  </div>
</div>



<?php endforeach;?>
</body>
<?php include_once(APPPATH.'/views/layouts/footer.php')?>