<?php
require_once('db/config.php');
	$id=$_GET['id'];
?>
<?php
include('inc/header.php');
?>

<div id="banner-t" class="text-center">
	<div class="row">
		<div class="banner-t-item col-md-6 col-sm-12 col-xs-12">
			<a href="#"><img src="img/home/banner-t-1.png" alt="" class="img-thumbnail"></a>
		</div>
		<div class="banner-t-item col-md-6 col-sm-12 col-xs-12">
			<a href="#"><img src="img/home/banner-t-1.png" alt="" class="img-thumbnail"></a>
		</div>
	</div>
</div>
<?php
		$sql_product="SELECT *FROM tbl_sanpham where sanpham_id=$id";
		$query_sanpham=mysqli_query($conn,$sql_product);
		while($row=mysqli_fetch_array($query_sanpham)){;
		?>
<div id="wrap-inner">
	<div id="product-info">
		<div class="clearfix"></div>
		<h3>
			<?php echo $row['sanpham_name'] ?>
		</h3>
		<div class="row">
			<div id="product-img" class="col-xs-12 col-sm-12 col-md-3 text-center">
				<img src="admin/img/<?php echo $row['sanpham_image'] ?>" width="150px">
			</div>
			<div id="product-details" class="col-xs-12 col-sm-12 col-md-9">
				<p>Giá: <span class="price"><?php echo number_format($row['sanpham_gia'])." VNĐ" ?></span></p>
				<p>Bảo hành:<?php echo $row['baohanh'] ?></p>
				<p>Phụ kiện: <?php echo $row['phukien'] ?></p>
				<p>Tình trạng: <?php echo $row['tinhtrang'] ?></p>
				<p>Khuyến mại: Hỗ trợ trả góp 0% dành cho các chủ thẻ Ngân hàng Sacombank</p>
				<p>Còn hàng: <?php echo $row['trangthai'] ?></p>
				
					<form action="cart.php" method="post">
					<fieldset>
						<input type="hidden" name="tensanpham" value="<?php echo $row['sanpham_name']   ?>">
						<input type="hidden" name="sanpham_id" value="<?php echo $row['sanpham_id']   ?>">
						<input type="hidden" name="giasanpham" value="<?php echo $row['sanpham_gia']   ?>">
						<input type="hidden" name="hinhanh" value="<?php echo $row['sanpham_image']   ?>">
						<input type="hidden" name="soluong" value="1">
						<input type="submit" name="themgiohang" value="Thêm giỏ hàng" class="btn btn-warning">
					</fieldset>
				</form>
				
			</div>
		</div>
	</div>
	<div id="product-detail">
		<h3>Chi tiết sản phẩm</h3>
		<p class="text-justify"><?php echo $row['sanpham_mota'] ?></p>
	</div>
	<?php
if(isset($_POST['submit'])){
	$sanpham_id=$_POST['sanpham_id'];
	$email=$_POST['email'];
	$name=$_POST['name'];
	$noidung=$_POST['noidung'];
	$sql_comment="INSERT INTO tbl_comment(sanpham_id,name,noidung,email,created_at) VALUES('$sanpham_id','$name','$noidung','$email',null)";
	$query_comment=mysqli_query($conn,$sql_comment);



}
	?>
	<hr>
	
	<div id="comment">
		<h3>Bình luận</h3>
		<div class="col-md-9 comment">
			<form method="post" action="">
			<div class="form-group">
					<input type="hidden" class="form-control" name="sanpham_id" value="<?php echo $row['sanpham_id'] ?>">
				</div>
				<div class="form-group">
					<label for="email">Email:</label>
					<input required type="email" class="form-control" id="email" name="email">
				</div>
				<div class="form-group">
					<label for="name">Tên:</label>
					<input required type="text" class="form-control" id="name" name="name">
				</div>
				<div class="form-group">
					<label for="cm">Bình luận:</label>
					<textarea required rows="10" id="cm" class="form-control" name="noidung"></textarea>
				</div>
				<div class="form-group text-right">
					<button type="submit" class="btn btn-default" name="submit">Gửi</button>
				</div>
			</form>
		</div>
	</div>
	<div id="comment-list">
		<?php 
			$sql_get_comment=mysqli_query($conn,"SELECT *FROM tbl_comment where sanpham_id=$id");
		while($row_get_comment=mysqli_fetch_array($sql_get_comment)){?>
		<ul>
			<li class="com-title">
				<?php echo $row_get_comment['name']  ?>
				<br>
				<span>	<?php echo $row_get_comment['created_at']  ?></span>
			</li>
			<li class="com-details">
			<?php echo $row_get_comment['noidung']  ?>
			</li>
		</ul>
<?php
		}
		?>
	</div>
</div>
<!-- end main -->
</div>
</div>
</div>
</section>
<!-- endmain -->

<!-- footer -->
<footer id="footer">
	<div id="footer-t">
		<div class="container">
			<div class="row">
				<div id="logo-f" class="col-md-3 col-sm-12 col-xs-12 text-center">
					<a href="#"><img src="img/home/logo.png"></a>
				</div>
				<div id="about" class="col-md-3 col-sm-12 col-xs-12">
					<h3>About us</h3>
					<p class="text-justify">Vietpro Academy thành lập năm 2009. Chúng tôi đào tạo chuyên sâu trong 2
						lĩnh vực là Lập trình Website & Mobile nhằm cung cấp cho thị trường CNTT Việt Nam những lập
						trình viên thực sự chất lượng, có khả năng làm việc độc lập, cũng như Team Work ở mọi môi trường
						đòi hỏi sự chuyên nghiệp cao.</p>
				</div>
				<div id="hotline" class="col-md-3 col-sm-12 col-xs-12">
					<h3>Hotline</h3>
					<p>Phone Sale: (+84) 0988 550 553</p>
					<p>Email: sirtuanhoang@gmail.com</p>
				</div>
				<div id="contact" class="col-md-3 col-sm-12 col-xs-12">
					<h3>Contact Us</h3>
					<p>Address 1: B8A Võ Văn Dũng - Hoàng Cầu Đống Đa - Hà Nội</p>
					<p>Address 2: Số 25 Ngõ 178/71 - Tây Sơn Đống Đa - Hà Nội</p>
				</div>
			</div>
		</div>
		<div id="footer-b">
			<div class="container">
				<div class="row">
					<div id="footer-b-l" class="col-md-6 col-sm-12 col-xs-12 text-center">
						<p>Học viện Công nghệ Vietpro - www.vietpro.edu.vn</p>
					</div>
					<div id="footer-b-r" class="col-md-6 col-sm-12 col-xs-12 text-center">
						<p>© 2017 Vietpro Academy. All Rights Reserved</p>
					</div>
				</div>
			</div>
			<div id="scroll">
				<a href="#"><img src="img/home/scroll.png"></a>
			</div>
		</div>
	</div>
</footer>
<!-- endfooter -->
</body>
<?php
		}
		?>
</html>