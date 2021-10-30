<?php
	include_once('inc/header.php');
  
			 		if(Session::get('customer_login')==false){
						 
                        header('Location:login.php');
					 }
              
?>
<style type="text/css"> 
    h2{
        font-size: 18px;
        font-weight: bold;
        color: red !important;
        display: inline;
    }
   
</style>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<div class="oderpage">
                        <h1>ORDER PAGE</h1>
                    </div>
			</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php
	include('inc/footer.php');
?>