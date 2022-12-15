<?php
require_once('db/config.php');
require_once('inc/header.php');
?>
<?php
if(isset($_POST['themgiohang'])){
	$tensanpham=$_POST['tensanpham'];
	$sanpham_id=$_POST['sanpham_id'];
	$hinhanh=$_POST['hinhanh'];
	$gia=$_POST['giasanpham'];
	$soluong=$_POST['soluong'];

	
	$sql_select_giohang=mysqli_query($conn,"SELECT *FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
	
	$count=mysqli_num_rows($sql_select_giohang);
	if($count>0){
		$row_sanpham=mysqli_fetch_array($sql_select_giohang);
		$soluong=$row_sanpham['soluong'] + 1;
		$sql_giohang="UPDATE tbl_giohang SET soluong='$soluong' WHERE  sanpham_id='$sanpham_id'";
		$query=mysqli_query($conn,$sql_giohang);

	}else {
		$sql_giohang=mysqli_query($conn,"INSERT INTO tbl_giohang(tensanpham,sanpham_id,giasanpham,hinhanh,soluong) VALUES('$tensanpham','$sanpham_id','$gia','$hinhanh','$soluong')");
		
	}
}
if(isset($_GET['xoa'])){
	$id=$_GET['xoa'];
	$sql_delete=mysqli_query($conn,"DELETE FROM tbl_giohang where giohang_id='$id'");
} elseif (isset($_POST['update'])) {
	for ($i = 0; $i < count($_POST['product_id']); $i++) {
		$sanpham_id = $_POST['product_id'][$i];
		$soluong = $_POST['soluong'][$i];
		if ($soluong <= 0)
			$sql_del = mysqli_query($conn, "DELETE FROM tbl_giohang where sanpham_id=$sanpham_id");
		else
			$sql_update = mysqli_query($conn, "UPDATE tbl_giohang SET soluong=$soluong where sanpham_id=$sanpham_id");

	}
}
elseif(isset($_POST['thanhtoan'])){
	$name=$_POST['name'];
	$phone=$_POST['phone'];
	$address=$_POST['address'];
	$note=$_POST['note'];
	$email=$_POST['email'];
	$giaohang=$_POST['giaohang'];
	$sql_khachhang=mysqli_query($conn,"INSERT INTO tbl_khachhang(name,phone,address,note,email,giaohang) VALUES('$name','$phone','$address','$note','$email','$giaohang')");
	if($sql_khachhang){
		$sql_select_khachhang=mysqli_query($conn,"SELECT *FROM tbl_khachhang ORDER BY khachhang_id DESC LIMIT 1");
		$mahang=rand(0,9999);

		$row_khachhang=mysqli_fetch_array($sql_select_khachhang);
		$khachhang_id=$row_khachhang['khachhang_id'];

		for($i=0;$i<count($_POST['thanhtoan_product_id']);$i++){
			$sanpham_id=$_POST['thanhtoan_product_id'][$i];
			$soluong=$_POST['thanhtoan_soluong'][$i];
			$sql_donhang=mysqli_query($conn,"INSERT INTO tbl_donhang(sanpham_id,khachhang_id,soluong,mahang) VALUES('$sanpham_id','$khachhang_id','$soluong',
				'$mahang')");

			$sql_delete_thanhtoan=mysqli_query($conn,"DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
			
		}

	}
}





?>
<!-- main -->


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
$sql_lay_giohang=mysqli_query($conn,"SELECT *FROM tbl_giohang ORDER BY giohang_id DESC");
?>
<div id="wrap-inner">
	<div id="list-cart">
		<h3>Giỏ hàng</h3>
		<form action="" method="post">
			<table class="table table-bordered .table-responsive text-center">
				<tr class="active">
					<td width="11.111%">Ảnh mô tả</td>
					<td width="22.222%">Tên sản phẩm</td>
					<td width="22.222%">Số lượng</td>
					<td width="16.6665%">Đơn giá</td>
					<td width="16.6665%">Thành tiền</td>
					<td width="11.112%">Xóa</td>
				</tr>
				<?php
				$total=0;
				while($row_fetch_giohang=mysqli_fetch_array($sql_lay_giohang)){
					$subtotal=$row_fetch_giohang['giasanpham']*$row_fetch_giohang['soluong']; 
					$total+=$subtotal;
					?>
					<tr>
						<td><img class="img-responsive" src="admin/img/<?php echo $row_fetch_giohang['hinhanh']  ?>"></td>
						<td>
							<?php echo	$row_fetch_giohang['tensanpham']  ?>
						</td>
						<td>
							<div class="form-group">
								<input class="form-control" name="soluong[]" type="number"
								value="<?php echo $row_fetch_giohang['soluong'] ?>">
								<input type="hidden" name="product_id[]"
								value="<?php echo $row_fetch_giohang['sanpham_id'] ?>">
							</div>
						</td>

						<td>
							<span class="price">
								<?php echo number_format($row_fetch_giohang['giasanpham'])  ?>
							</span>
						</td>
						<td>
							<span class="price">
								<?php echo number_format($subtotal ) ?>
							</span>
						</td>
						<td><a href="?xoa=<?php echo $row_fetch_giohang['giohang_id'] ?>">Xóa</a></td>


					</tr>
					<?php
				}
				?>
			</table>
			<div class="row" id="total-price">
				<div class="col-md-6 col-sm-12 col-xs-12">

					Tổng thanh toán: <span class="total-price">
						<?php echo number_format($total)  ?>
					</span>

				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<a href="#" class="my-btn btn">Mua tiếp</a>
					<input type="submit" class="my-btn btn" name="update" value="Cập nhật">
					<a href="#" class="my-btn btn">Xóa giỏ hàng</a>
				</div>
			</div>
		</form>
	</div>
	<div id="xac-nhan">
		<h3>Xác nhận mua hàng</h3>
		<form method="post">
			<div class="form-group">
				<label>Tên khách hàng</label>
				<input required type="text" class="form-control" name="name">
			</div>
			<div class="form-group">
				<label>Phone</label>
				<input required type="number" class="form-control" name="phone">
			</div>
			<div class="form-group">
				<label>Địa chỉ</label>
				<input required type="text" class="form-control" name="address">
			</div>
			<div class="form-group">
				<label>Ghi chú</label>
				<input type="text" class="form-control" id="add" name="note">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input required type="email" class="form-control" id="add" name="email">
			</div>
			<div class="form-group">
				<select name="giaohang" class="form-control" required="required">
					<option value="">Chọn hình thức giao hàng</option>
					<option value="0">Nhận hàng tại nhà</option>
					<option value="1">Qua thẻ</option>
				</select>

			</div>
			<?php
			$sql_lay_giohang=mysqli_query($conn,"SELECT *FROM tbl_giohang ORDER BY giohang_id DESC");
			while ($row_thanhtoan=mysqli_fetch_array($sql_lay_giohang)) {?>
				<input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $row_thanhtoan['sanpham_id'] ?>">
				<input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_thanhtoan['soluong'] ?>">

				<?php
			}
			?>
			<div class="form-group text-right">
				<button type="submit" class="btn btn-default" name="thanhtoan">Thực hiện đơn hàng</button>
			</div>
		</form>
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

</html>