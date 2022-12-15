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

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Chi tiết đơn hàng</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <?php
                $id = $_GET['id'];
                $sql = mysqli_query($conn, "SELECT *FROM tbl_khachhang where khachhang_id=$id" );
                $row = mysqli_fetch_array($sql);



                $sql_donhang = mysqli_query($conn, "SELECT *FROM tbl_donhang inner join tbl_sanpham on tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id where khachhang_id=$id");

                if(isset($_POST['xuly'])){
                    $status = $_POST['status'];
                    $sql_xuly = mysqli_query($conn, "UPDATE tbl_khachhang SET giaohang=$status where khachhang_id=$id");
                    header('location:donhang.php');

                }

                ?>
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="container123  col-md-6" style="">
                                        <h4></h4>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="col-md-4">Thông tin khách hàng</th>
                                                    <th class="col-md-6"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Thông tin người đặt hàng</td>
                                                    <td>
                                                        <?php echo $row['name']  ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Ngày đặt hàng</td>
                                                    <td>
                                                        <?php echo $row['created_at']  ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Số điện thoại</td>
                                                    <td>
                                                        <?php echo $row['phone']  ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Địa chỉ</td>
                                                    <td>
                                                        <?php echo $row['address']  ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td>
                                                        <?php echo $row['email']  ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Ghi chú</td>
                                                    <td>
                                                        <?php echo $row['note']  ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <table id="myTable" class="table table-bordered table-hover dataTable" role="grid"
                                    aria-describedby="example2_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting col-md-1">STT</th>
                                            <th class="sorting_asc col-md-4">Tên sản phẩm</th>
                                            <th class="sorting col-md-2">Số lượng</th>
                                            <th class="sorting col-md-2">Giá tiền</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;

                                            while($row_donhang = mysqli_fetch_array($sql_donhang)){
                                                $subtotal = $row_donhang['sanpham_gia'] * $row_donhang['soluong'];
                                                $total += $subtotal;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $i++ ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row_donhang['sanpham_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row_donhang['soluong'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($subtotal) ?>
                                                    </td>

                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="3"><b>Tổng tiền</b></td>
                                                <td colspan="1"><b class="text-red" style="color: red;">
                                                    <?php echo number_format($total). " VNĐ" ?>
                                                </b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <form action="" method="POST">
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="col-md-8"></div>
                                    <div class="col-md-4">
                                        <div class="form-inline">
                                            <label>Trạng thái giao hàng: </label>
                                            <select name="status" class="form-control input-inline"
                                            style="width: 150px">
                                            <option value="0">Chưa giao</option>
                                            <option value="1">Đang giao</option>
                                            <option value="2">Đã giao</option>
                                            <option value="3">Đã hủy đơn</option>
                                        </select>

                                        <input type="submit" value="Xử lý" class="btn btn-primary" name="xuly">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

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
    })
</script>
</body>

</html>