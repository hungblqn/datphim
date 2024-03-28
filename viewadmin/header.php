<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang admin</title>
    <link rel="stylesheet" href="../viewadmin/css/admin.css">
</head>
<body>

<div class="wrapper">
    <header class="header">
        <h1>TRANG ADMIN</h1>
    </header>
    <nav class="navigation">
       <a href="../controller/indexadmin.php?c=qlfilm">Quản lý phim</a>
       <a href="../controller/indexadmin.php?c=qlghe">Quản lý ghế</a>
       <a href="../controller/indexadmin.php?c=qlrap">Quản lý rạp</a>
       <a href="../controller/indexadmin.php?c=qlhoadon">Quản lý hóa đơn</a>
       <a href="../controller/indexadmin.php?c=qlnguoidung">Quản lý người dùng</a>
    </nav>
   
    <section class="content">
        <h2>Xin chào <?php if(isset($_SESSION['name'])){ echo $_SESSION['name']; echo '  <a href="../controller/indexadmin.php?c=logout">(Logout)</a>';}else{ header("location: ../controller/index.php?act=login");} ?>, Chào mừng đến trang Quản Lý</h2>
        <!-- Your content goes here -->
    </section>