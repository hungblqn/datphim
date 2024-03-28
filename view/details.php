
<head>
    <style>
        /* CSS for main content */
.maincontent {
    margin: 20px auto;
    width: 80%;
}

/* CSS for product details */
.product-details {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border: 1px solid #ccc;
    padding: 20px;
    margin-bottom: 20px;
}

/* CSS for product image */
.product-image {
    flex: 0 0 30%;
}

.product-image img {
    max-width: 100%;
    height: auto;
}

/* CSS for product info */
.product-info {
    flex: 0 0 65%;
    text-align: left;
}

.product-info h3 {
    font-size: 24px;
    margin-bottom: 10px;
}

.giasp {
    font-size: 18px;
    margin-bottom: 10px;
}

.buy {
    margin-top: 20px;
}

.buy button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
}

.buy button:hover {
    background-color: #0056b3;
}

        </style>
</head>
<br>
<section class="w3l-grids">
        <div class="grids-main py-5">
            <div class="container py-lg-3">
<?php
if (isset ($_GET['id_phim'])) {
    $id_sp_temp = $_GET['id_phim'];
    // Assuming you have a function to retrieve product details by ID
    $products = show_film_all();
    if ($product) {
        echo '
            <div class="maincontent">                       
                <div class="product-details">
                    <div class="product-image"><center>
                    <img src="../assets/images/' . $product['anh'] . '" alt="' . $product['tenphim'] . '">
                    </div></center>
                    <div class="product-info">
                       <center> <h3>' . $product['tenphim'] . '</h3>
                        <div class="giasp"><span>' . number_format($product['gia'], 0, ',', '.') . ' VNĐ</span></div>
                        <p><b>Mô tả:</b> ' . $product['mota'] . '</p></center></center>
                        <div class="buy">
                            <form method="POST" action="">
                                <input type="hidden" name="id_phim" value="' . $id_phim . '"/>
                                <input type="hidden" name="anh" value="' . ($product['anh'] ?? '') . '"/>
                                <input type="hidden" name="tenphim" value="' . $product['tenphim'] . '"/>
                                <input type="hidden" name="gia" value="' . $product['gia'] . '"/>
                                <div class="bookbtn">
                                <button type="button" class="btn btn-success"
                                    onclick="location.href=`../view/ticket-booking.php?id_phim='. $id_phim.'`;">Book</button>
                            </div>                            </form>
                        </div>
                    </div>
                </div>
            </div>';
    } else {
        echo '<span>Không có sản phẩm</span>';
    }
}
?>
            </div></div></section>
