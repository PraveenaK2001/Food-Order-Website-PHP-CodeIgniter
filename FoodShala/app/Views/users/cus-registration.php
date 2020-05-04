
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
  <a class="nav-link" href="/FoodShala/public/user-login">Sign In</a>&nbsp;&nbsp;
  <a class="nav-link" href="/FoodShala/public/user-registration">Sign Up</a>
    <?php
}
?>
  
</nav>
	
<h2>Customer Registration</h2>


              <form  method="post" >
                  <div class="col-sm-3 my-1">
                      <label  for="cname" >Name</label>
                      <div >
                          <input class="form-control" type="text" name="cname" id="cname" >
                      </div>
                  </div>

                  <div class="col-sm-3 my-1">
                      <label for="email">Email</label>
                      <div>
                          <input class="form-control" type="email" name="email" id="email">
                      </div>
                  </div>
                  
                  
                  <div class="col-sm-3 my-1">
                      <label for="pass">Password</label>
                      <div>
                          <input class="form-control" type="Password" name="pass" id="pass">
                      </div>
                  </div>
                  
                  <div class="col-sm-3 my-1">
                      <label for="pass2">Confirm Password</label>
                      <div>
                          <input class="form-control" type="Password" name="pass2" id="pass2" onblur="checkpass()">
                      </div>
                      <div id="passdiv"></div>
                  </div>
                  <script type="text/javascript">
                    function checkpass()
                    {
                      var p1=document.getElementById('pass').value;
                      var p2=document.getElementById('pass2').value;
                      if(p1!=p2)
                        document.getElementById('passdiv').innerHTML="Password not matching";
                      else
                      document.getElementById('passdiv').innerHTML="";

                    }
                  </script>
                  <div class="col-sm-3 my-1">
                      <label for="address">Address</label>
                      <div>
                        <textarea class="form-control" name="address" id="address"></textarea>
       
                      </div>
                  </div>
                   <div class="col-sm-3 my-1">
                      <label for="fprefer" >Food Preference</label>
                      <div >

                          <select  class="form-control" name="fprefer"id="fprefer">
                                <option value="veg" selected>Veg</option>
                                <option value="nonveg">Non Veg</option>
                          </select>
                
                      </div>
                  </div>

                  
                  <div class="col-sm-3 my-1">
              <input type="submit" class="btn btn-primary" value="Register" formaction="/FoodShala/public/add-customer" >
            </div>
              <div class="col-sm-3 my-1" >
                
                <?= \Config\Services::validation()->listErrors();?>
              </div>

              </form>
  </body>

</body>
<?php include_once(APPPATH.'/views/layouts/footer.php')?>