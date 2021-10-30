<?php
	include('inc/header.php');
?>
<?php
			 		if(Session::get('customer_login')==true){
						 
						 header('Location:order.php');
					 }
			   ?>
<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
		
		
		$insert_customer = $customer->Insert_customer($_POST);
	}else {
		$insert_customer='';
	}
?>
<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])){
		$login_customer = $customer->Login_customer($_POST);
	}else {
		$login_customer='';
	}
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>LOGIN</h3>
        	<p>Nhập thông tin tài khoản vào bên dưới.</p>
			<?php
				if(isset($login_customer)){
					echo $login_customer;
				}
			?>
        	<form action="" method="POST">
                	<input  type="text" name="emaillogin" class="field" placeholder="Enter email...">
                    <input  type="password" name="passwordlogin" class="field" placeholder="Enter password">
                 
                 <p class="note">Nếu bạn quên mật khẩu, nhấn vào <a href="#">đây</a></p>
                    <div class="buttons"><div><input type="submit" name="login" value="Đăng Nhập" class="grey"></input></div></div>
					</form>
                    </div>
    	<div class="register_account">
    		<h3>Đăng Ký Tài Khoản Mới</h3>
			<?php
				if(isset($insert_customer)){
					echo $insert_customer;
				}
			?>
    		<form action="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Nhập tên...">
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="Nhập Thành Phố">
							</div>
							
							<div>
								<input type="text" name="zipcode" placeholder="Nhập Zip Code">
							</div>
							<div>
								<input type="text" name="email" placeholder="Nhập email">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Nhập Địa Chỉ"> 
						</div>
		    		<div>
						<select id="country" name="country">
							<option value="null">Chọn Quốc Gia</option>
							<option value="VN">Việt Nam</option>        
							<option value="AF">Afghanistan</option>
							<option value="KR">Hàn Quốc</option>
							<option value="CN">Trung Quốc</option>
							<option value="USA">Mỹ</option>
							

		         </select>
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Nhập số điện thoại">
		          </div>
				  
				  <div>
					<input type="text" name="passwordregist" placeholder="Nhập mật khẩu">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" value="Đăng Ký" class="grey"></input></div></div>
		    <p class="terms">Bằng cách nhấp vào nút đăng ký bạn sẽ chấp nhận <a href="#">điều khoản &amp; điều kiện</a> của chúng tôi.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php
	include('inc/footer.php');
?>