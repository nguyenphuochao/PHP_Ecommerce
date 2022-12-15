<?php
require_once('db/config.php');
include('inc/header.php');
?>
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
</head>
<body>
	
<!--/.sidebar-->
<?php
		if(isset($_GET['xoa'])){
			$id=$_GET['xoa'];
		$sql_del=mysqli_query($conn,"DELETE FROM tbl_sanpham where sanpham_id=$id");
		}

?>	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Sản phẩm</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">
				
				<div class="panel panel-primary">
					<div class="panel-heading">Danh sách sản phẩm</div>
					<div class="panel-body">
						<div class="bootstrap-table">
							<div class="table-responsive">
								<a href="addproduct.php" class="btn btn-primary">Thêm sản phẩm</a>
								<table class="table table-bordered" style="margin-top:20px;">				
									<thead>
										<tr class="bg-primary">
											<th>ID</th>
											<th>Mã sản phẩm</th>
											<th width="30%">Tên Sản phẩm</th>
											<th>Giá sản phẩm</th>
											<th width="15%">Ảnh sản phẩm</th>
											<th>Danh mục</th>
											<th>Tùy chọn</th>
										</tr>
									</thead>
									<tbody>
									<?php 
								$i=1;
								$sql_pro=mysqli_query($conn,"SELECT *FROM tbl_sanpham inner join tbl_category on tbl_sanpham.category_id=tbl_category.category_id ORDER BY sanpham_id DESC");
								while($row=mysqli_fetch_array($sql_pro)){?>

										<tr>
											<td><?php echo $i++  ?></td>
											<td><?php echo $row['sanpham_id']  ?></td>
											<td><?php echo $row['sanpham_name']  ?></td>
											<td><?php echo number_format($row['sanpham_gia'])."VNĐ" ?></td>
											<td>
												<img width="100px" src="img/<?php echo $row['sanpham_image']  ?>" class="thumbnail">
											</td>
											<td><?php echo $row['category_name']  ?></td>
											<td>
												<a href="editproduct.php?id=<?php echo $row['sanpham_id'] ?>" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
												<a href="?xoa=<?php echo $row['sanpham_id'] ?>" onclick="return confirm('Bạn chắc xóa chú??')"  class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true" onclick="return(confirm('Bạn chắc xóa chứ?'))"></i> Xóa</a>
											</td>
										</tr>
										<?php
								}
										?>
	
									</tbody>
								</table>							
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
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
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
