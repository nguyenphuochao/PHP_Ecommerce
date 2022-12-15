<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard | Vietpro shop</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<script src="js/lumino.glyphs.js"></script>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>

<body>
	<!--/.sidebar-->
	<?php 
		require_once('db/config.php');
		include('inc/header.php');
   ?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Sản phẩm</h1>
			</div>
		</div>
		<!--/.row-->

		<?php  

$id = $_GET['id'];
$sql_update = mysqli_query($conn, "SELECT *FROM tbl_sanpham where sanpham_id=$id");
$row_update = mysqli_fetch_array($sql_update);
$cate_select = $row_update['category_id'];
?>
		<?php
if(isset($_POST['sua'])){
	$category_id=$_POST['category_id'];
	$sanpham_name=$_POST['sanpham_name'];
	$sanpham_gia=$_POST['sanpham_gia'];
	$sanpham_giakhuyenmai=$_POST['sanpham_giakhuyenmai'];
	$sanpham_active=$_POST['sanpham_active'];
	$sanpham_hot=$_POST['sanpham_hot'];
	$sanpham_soluong=$_POST['sanpham_soluong'];

	if ($_FILES['img']['name'] == '')
		$sanpham_image = $row_update['sanpham_image'];
	else {
		$sanpham_image = $_FILES['sanpham_image']['name'];
		$sanpham_image_tmp = $_FILES['sanpham_image']['sanpham_image_tmp'];
		move_uploaded_file($sanpham_image_tmp,'img/'.$sanpham_image);
	}
		


	$sanpham_mota=$_POST['sanpham_mota'];
	$baohanh=$_POST['baohanh'];
	$phukien=$_POST['phukien'];
	$tinhtrang=$_POST['tinhtrang'];
	$trangthai=$_POST['trangthai'];



$sql=mysqli_query($conn,"UPDATE tbl_sanpham SET category_id='$category_id',sanpham_name='$sanpham_name',sanpham_gia='$sanpham_gia',sanpham_giakhuyenmai='$sanpham_giakhuyenmai',sanpham_active='$sanpham_active',sanpham_hot='$sanpham_hot',sanpham_soluong='$sanpham_soluong',sanpham_image='$sanpham_image',sanpham_mota='$sanpham_mota',baohanh='$baohanh',phukien='$phukien',tinhtrang='$tinhtrang',trangthai='$trangthai' where sanpham_id=$id");

header('location: product.php');
	}



?>
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">

				<div class="panel panel-primary">
					<div class="panel-heading">Sửa sản phẩm</div>
					<div class="panel-body">
						<form action="" method="post" enctype="multipart/form-data">
							<div class="row" style="margin-bottom:40px">
								<div class="col-xs-8">
									<div class="form-group">
										<label>Tên sản phẩm</label>
										<input required type="text" name="sanpham_name" class="form-control"
											value="<?php echo $row_update['sanpham_name']  ?>">
									</div>
									<div class="form-group">
										<label>Giá sản phẩm</label>
										<input required type="number" name="sanpham_gia" class="form-control"
											value="<?php echo $row_update['sanpham_gia']  ?>">
									</div>
									<div class="form-group">
										<label>Ảnh sản phẩm</label>
										<input required id="img" type="file" name="sanpham_image"
											class="form-control hidden" onchange="changeImg(this)">
										<img id="avatar" class="thumbnail" width="300px"
											src="img/<?php echo $row_update['sanpham_image'] ?>">
									</div>
									<div class="form-group">
										<label>Phụ kiện</label>
										<input required type="text" name="phukien" class="form-control"
											value="<?php echo $row_update['phukien']  ?>">
									</div>
									<div class="form-group">
										<label>Bảo hành</label>
										<input required type="text" name="baohanh" class="form-control"
											value="<?php echo $row_update['baohanh']  ?>">
									</div>
									<div class="form-group">
										<label>Khuyến mãi</label>
										<input required type="text" name="sanpham_giakhuyenmai" class="form-control"
											value="<?php echo $row_update['sanpham_giakhuyenmai']  ?>">
									</div>
									<div class="form-group">
										<label>Tình trạng</label>
										<input required type="text" name="tinhtrang" class="form-control"
											value="<?php echo $row_update['tinhtrang']  ?>">
									</div>
									<div class="form-group">
										<label>Trạng thái</label>
										<select required name="trangthai" class="form-control">
											<option value="1">Còn hàng</option>
											<option value="0">Hết hàng</option>
										</select>
									</div>
									<div class="form-group">
										<label>Số lượng</label>
										<input required type="text" name="sanpham_soluong" class="form-control"
											value="<?php echo $row_update['sanpham_soluong']  ?>">
									</div>
									<div class="form-group">
										<label>Mô tả</label>
										<textarea
											name="sanpham_mota"><?php echo $row_update['sanpham_mota']  ?></textarea>
									</div>
									<div class="form-group">
										<label>Danh mục</label>
										<select required name="category_id" class="form-control">

											<?php
											$sql=mysqli_query($conn,"SELECT *FROM tbl_category ORDER BY category_id");
                                            while ($row_cate = mysqli_fetch_array($sql)) {
	                                          
	                                            if ($cate_select == $row_cate['category_id']) {
                                            ?>

											<option selected value="<?php echo $row_cate['category_id'] ?>">
												<?php echo $row_cate['category_name'] ?>
											</option>
											<?php } else { ?>
											<option value="<?php echo $row_cate['category_id'] ?>">
												<?php echo $row_cate['category_name'] ?>
											</option>
											<?php
	                                            }
                                            }
                                            ?>


										</select>
									</div>

									<div class="form-group">
										<label>Sản phẩm nổi bật</label><br>
										Có: <input type="radio" name="sanpham_hot" value="1" checked>
										Không: <input type="radio" name="sanpham_hot" value="0">
									</div>
									<div class="form-group">
										<label>Sản phẩm active</label><br>
										Có: <input type="radio" name="sanpham_active" value="1" checked>
										Không: <input type="radio" name="sanpham_active" value="0">
									</div>
									<button type="submit" name="sua">Sửa</button>
									<a href="product.php" class="btn btn-danger">Hủy bỏ</a>
								</div>
							</div>
						</form>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
		<!--/.row-->
	</div>
	<!--/.main-->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		$('#calendar').datepicker({
		});
		!function ($) {
			$(document).on("click", "ul.nav li.parent > a > span.icon", function () {
				$(this).find('em:first').toggleClass("glyphicon-minus");
			});
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
			if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
			if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		});
		function changeImg(input) {
			//Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				//Sự kiện file đã được load vào website
				reader.onload = function (e) {
					//Thay đổi đường dẫn ảnh
					$('#avatar').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		$(document).ready(function () {
			$('#avatar').click(function () {
				$('#img').click();
			});
		});
	</script>
</body>

</html>