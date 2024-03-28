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
    </nav>
    <section class="content">
        <h2>Welcome to the Admin Panel</h2>
        <!-- Your content goes here -->
    </section>

    <footer class="footer">
        &copy; <?php echo date("Y"); ?> TRANG ADMIN
    </footer>
</div>
</body>
</html>