<?php 
require_once('db/config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Vietpro Shop - Home</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/home.css">
	<link rel="stylesheet" href="css/cart.css">
	<link rel="stylesheet" href="css/category.css">
	<link rel="stylesheet" href="css/complete.css">
	<link rel="stylesheet" href="css/details.css">
	<link rel="stylesheet" href="css/email.css">
	<link rel="stylesheet" href="css/home.css">
	<link rel="stylesheet" href="css/search.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<style>
		
		ul.menu{
		display: flex;
		margin: 0;
		padding: 0;
		background-color: grey;
		font-weight: bold;
		}
		ul.menu>li{
			list-style-type: none;
			padding: 15px 23px;
			
			
		}
		ul.menu>li>a{
			color: white;
		}
		ul.menu>li:nth-child(1){
			margin-left: 180px;
		}
		@media screen and (max-width:600px){
			ul.menu{
				flex-direction: column;
			}
			ul.menu>li:nth-child(1){
				margin: 0;
			}
		}
	</style>
	<script type="text/javascript">
		$(function() {
			var pull        = $('#pull');
			menu        = $('nav ul');
			menuHeight  = menu.height();

			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});
		});

		$(window).resize(function(){
			var w = $(window).width();
			if(w > 320 && menu.is(':hidden')) {
				menu.removeAttr('style');
			}
		});
	</script>
</head>
<body>    
	<!-- header -->
	<header id="header">
		<div class="container">
			<div class="row">
				<div id="logo" class="col-md-3 col-sm-12 col-xs-12">
					<h1>
						<a href="index.php"><img src="img/home/logo.png"></a>						
						<nav><a id="pull" class="btn btn-danger" href="">
							<i class="fa fa-bars"></i>
						</a></nav>			
					</h1>
				</div>
				<div id="search" class="col-md-7 col-sm-12 col-xs-12">
					<input type="text" name="text" value="Nhập từ khóa ...">
					<input type="submit" name="submit" value="Tìm Kiếm">
				</div>
				
				<div id="cart" class="col-md-2 col-sm-12 col-xs-12">
					<a class="display" href="cart.php">Giỏ hàng</a>
					<a href="cart.php"></a>				    
				</div>
			</div>			
		</div>
	</header><!-- /header -->
	<!-- endheader -->
<div class="section">
	<ul class="menu">
		<li><a href="index.php">Trang chủ</a></li>
		<li><a href="">Tin tức</a></li>
		<li><a href="">Liên hệ</a></li>
		<li><a href="">About</a></li>
		<li><a href="admin">Quản trị</a></li>
	</ul>
</div>
	<!-- main -->
	<section id="body">
		<div class="container">
			<div class="row">
				<div id="sidebar" class="col-md-3">
					<nav id="menu">
						<ul>
							<li class="menu-item">danh mục sản phẩm</li>
							<?php
							$sql_category="SELECT *FROM tbl_category ORDER BY category_id DESC";
							$query_category=mysqli_query($conn,$sql_category);
							while($row=mysqli_fetch_assoc($query_category)){
							?>
							<li class="menu-item"><a href="category.php?id=<?php echo $row['category_id'] ?>" title=""><?php echo $row['category_name'];   ?></a></li>
							<?php
							}
							?>	
						</ul>
						<!-- <a href="#" id="pull">Danh mục</a> -->
					</nav>

					<div id="banner-l" class="text-center">
						<div class="banner-l-item">
							<a href="#"><img src="img/home/banner-l-1.png" alt="" class="img-thumbnail"></a>
						</div>
						<div class="banner-l-item">
							<a href="#"><img src="img/home/banner-l-2.png" alt="" class="img-thumbnail"></a>
						</div>
						<div class="banner-l-item">
							<a href="#"><img src="img/home/banner-l-3.png" alt="" class="img-thumbnail"></a>
						</div>
						<div class="banner-l-item">
							<a href="#"><img src="img/home/banner-l-4.png" alt="" class="img-thumbnail"></a>
						</div>
						<div class="banner-l-item">
							<a href="#"><img src="img/home/banner-l-5.png" alt="" class="img-thumbnail"></a>
						</div>
						<div class="banner-l-item">
							<a href="#"><img src="img/home/banner-l-6.png" alt="" class="img-thumbnail"></a>
						</div>
						<div class="banner-l-item">
							<a href="#"><img src="img/home/banner-l-7.png" alt="" class="img-thumbnail"></a>
						</div>
					</div>
				</div>

				<div id="main" class="col-md-9">
					<!-- main -->
					<!-- phan slide la cac hieu ung chuyen dong su dung jquey -->
					<div id="slider">
						<div id="demo" class="carousel slide" data-ride="carousel">

							<!-- Indicators -->
							<ul class="carousel-indicators">
								<li data-target="#demo" data-slide-to="0" class="active"></li>
								<li data-target="#demo" data-slide-to="1"></li>
								<li data-target="#demo" data-slide-to="2"></li>
							</ul>
							
							<!-- The slideshow -->
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img src="img/home/slide-1.png" alt="Los Angeles" >
								</div>
							<?php
							$sql_slider="SELECT *FROM tbl_slider where slider_active=1 ORDER BY slider_id DESC";
							$query_slider=mysqli_query($conn,$sql_slider);
							while($row=mysqli_fetch_assoc($query_slider)){
							?>
							<div class="carousel-item">
								<img src="img/home/<?php echo $row['slider_image'];  ?>" alt="Los Angeles" >
							</div>
								<?php

							}
							?>
							</div>

							<!-- Left and right controls -->
							<a class="carousel-control-prev" href="#demo" data-slide="prev">
								<span class="carousel-control-prev-icon"></span>
							</a>
							<a class="carousel-control-next" href="#demo" data-slide="next">
								<span class="carousel-control-next-icon"></span>
							</a>
						</div>
					</div>
