</div>
   <div class="footer">
   	  <div class="wrapper">	
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
						<h4>Thông Tin</h4>
						<ul>
						<li><a href="#">Thông Tin Của Chúng Tôi</a></li>
						<li><a href="#">Dịch Vụ Khách Hàng</a></li>
						<li><a href="#"><span>Tìm Kiếm Nâng Cao</span></a></li>
						<li><a href="#">Đơn Hàng Và Phản Hồi</a></li>
						<li><a href="#"><span>Liên Hệ VS Chúng Tôi</span></a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Tại Sao Bạn Nên Chọn Tôi</h4>
						<ul>
						<li><a href="about.php">Thông Tin</a></li>
						<li><a href="faq.php">Dịch Vụ Khách Hàng</a></li>
						<li><a href="#">Chính Sách Bảo Mật</a></li>
						<li><a href="contact.php"><span>Sơ Đồ Trang Web</span></a></li>
						<li><a href="preview.php"><span>Search Terms</span></a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Tài Khoản Của Tôi</h4>
						<ul>
							<li><a href="contact.php">Đăng Nhập</a></li>
							<li><a href="index.php">Xem Giỏ Hàng</a></li>
							<li><a href="#">SP Ưa Thích</a></li>
							<li><a href="#">Đơn Hàng Của Tôi</a></li>
							<li><a href="faq.php">Hỗ Trợ</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Liên Hệ</h4>
						<ul>
							<li><span>0774452227</span></li>
							<li><span>0329568259</span></li>
						</ul>
						<div class="social-icons">
							<h4>Theo Dõi Tôi</h4>
					   		  <ul>
							      <li class="facebook"><a href="#" target="_blank"> </a></li>
							      <li class="twitter"><a href="#" target="_blank"> </a></li>
							      <li class="googleplus"><a href="#" target="_blank"> </a></li>
							      <li class="contact"><a href="#" target="_blank"> </a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>
			<div class="copy_right">
				<p>Website được thiết kế bởi Nguyễn Minh Hiếu</p>
		   </div>
     </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
	  <script defer src="js/jquery.flexslider.js"></script>
	  <script type="text/javascript">
		$(function(){
		  SyntaxHighlighter.all();
		});
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	  </script>
</body>
</html>
