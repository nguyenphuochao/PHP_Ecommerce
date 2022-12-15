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
		$sql_khachhang=mysqli_query($conn,"DELETE FROM tbl_khachhang where khachhang_id=$id");
		}


                    
        
                            

?>	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Đơn hàng</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">
				
				<div class="panel panel-primary">
					<div class="panel-heading">Danh sách khách hàng</div>
					<div class="panel-body">
						<div class="bootstrap-table">
							<div class="table-responsive">
								<table class="table table-bordered">				
									<thead>
										<tr class="bg-primary">
											<th>ID</th>
											<th>Tên khách hàng</th>
											<th width="10%">Số điện thoại</th>
											<th>Địa chỉ</th>
											<th width="15%">Email</th>
                                            <th >Trang thái</th>
                                            <th width="5%">Ngày đặt hàng</th>
											<th>Tùy chọn</th>
										</tr>
									</thead>
									<tbody>
									<?php 
								$i=1;
								$sql_khachhang=mysqli_query($conn,"SELECT *FROM tbl_khachhang  ORDER BY khachhang_id DESC");
								while($row=mysqli_fetch_array($sql_khachhang)){?>

										<tr>
											<td><?php echo $i++  ?></td>
											<td><?php echo $row['name']  ?></td>
											<td><?php echo "0".$row['phone']  ?></td>
                                            <td><?php echo $row['address']  ?></td>
                                            <td><?php echo $row['email']  ?></td>
                                            <td><?php
                                        if ($row['giaohang'] == 0)
                                            echo "Chưa giao";
                                        else if ($row['giaohang'] == 1)
                                            echo "Đang giao";
                                        else if ($row['giaohang'] == 2)
                                            echo "Đã giao";
                                        else if ($row['giaohang'] == 3)
                                            echo "Đã hủy";
                                              ?></td>
                                            <td><?php echo $row['created_at']  ?></td>
										
											<td>
												<a href="chitiet.php?id=<?php echo $row['khachhang_id'] ?>" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Chi tiết</a>
												<a href="?xoa=<?php echo $row['khachhang_id'] ?>" onclick="return(confirm('Bạn chắc xóa chứ?'))"  class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true" ></i> Xóa</a>
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
