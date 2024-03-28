<?php
	include_once "../model/config.php"; 
	include_once "../model/quanlyphim.php"; 
	$id_phim = $_GET['id_phim'];
	$id_rap = $_GET['id_rap'];
	$phim = get_phim_by_id($id_phim);
	$ghe = pdo_query('select * from ghe where id_rap='.$id_rap);
	$ghetronghoadon = pdo_query('select * from hoadon inner join ghe on hoadon.id_ghe = ghe.id_ghe and hoadon.id_rap = '.$id_rap);
	
    
    // Kiểm tra xem có dữ liệu được gửi từ AJAX không
	if(isset($_POST['selectedSeat'])) {
		// Gán dữ liệu từ AJAX vào biến $selectedSeat
		$selectedSeat = $_POST['selectedSeat'];
		
		// Lưu trữ dữ liệu trong session
		$_SESSION['selectedSeat'] = $selectedSeat;
		
		// In ra dữ liệu để kiểm tra
		var_dump($_SESSION['selectedSeat']);
	}

	// Kiểm tra xem biến $selectedSeat đã được khởi tạo hay chưa
	if(isset($selectedSeat)) {
		echo json_encode($selectedSeat);
		exit; // Kết thúc việc xử lý mã PHP ở đây
	}
	// Lặp qua từng ghế trong biến $ghe
foreach ($ghe as $g) {
    // Kiểm tra nếu hàng chưa được khởi tạo trong map thì khởi tạo nó
    if (!isset($seatMap[$g['Hang']])) {
        $seatMap[$g['Hang']] = str_repeat('_', 10); // Mặc định hàng sẽ có 10 ghế và đều trống
    }
    
    // Đặt ký tự 'a' cho ghế tồn tại
    $seatMap[$g['Hang']][$g['Cot'] - 1] = 'a';
}

// Tạo map ghế từ dữ liệu đã xử lý
$mapString = "[\n";
foreach ($seatMap as $row) {
    $mapString .= "'" . $row . "',\n";
}
$mapString .= "]";
	
?>
<!DOCTYPE html>
<html>

<head>
	<title>Movie Ticket Booking Widget Flat Responsive Widget Template :: w3layouts</title>
	<!-- for-mobile-apps -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords"
		content="Movie Ticket Booking Widget Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<link href="../view/css/style.css" rel="stylesheet" type="text/css" media="all" />
	<script src="js/jquery-1.11.0.min.js"></script>
	<script src="js/jquery.seat-charts.js"></script>
</head>

<body>
<div class="content">
	<h2>Đặt vé</h2>
	<div class="main">
		<div class="demo">
			<div id="seat-map">
				<div class="front">RẠP</div>					
			</div>
			<div class="booking-details">
				<ul class="book-left">
					<li>Movie </li>
					<li>Time </li>
					<li>Tickets</li>
					<li>Total</li>
					<li>Selected Seats</li>
				</ul>
				<ul class="book-right">
					<li>: <?php echo $phim['tenphim']; ?></li>
					<li>: April 12, 22:00</li>
					<li>: <span id="counter">0</span></li>
					<li>: <b><i>RS.</i><span id="total">0</span></b></li>
				</ul>
				<div class="clear"></div>
				<ul id="selected-seats" class="scrollbar scrollbar1"></ul>
			
						
				<div id="legend"></div>
			</div>
			<input type="hidden" id="name" name="name">
			<script type="text/javascript">
				var price = <?php echo $phim['gia']; ?>; //price
				var selectedSeats = [];
				$(document).ready(function () {
					
					
					var $cart = $('#selected-seats'), //Sitting Area
						$counter = $('#counter'), //Votes
						$total = $('#total'); //Total money
					var sc = $('#seat-map').seatCharts({
						map: <?php echo $mapString; ?>,
						naming: {
							top: false,
							getLabel: function (character, row, column) {
								return column;
							}
						},
						legend: { //Definition legend
							node: $('#legend'),
							items: [
								['a', 'available', 'Available'],
								['a', 'unavailable', 'Sold'],
								['a', 'selected', 'Selected']
							]
						},
						click: function () { //Click event
							if (this.status() == 'available') { //optional seat
								$('<li>R-' + (this.settings.row + 1) + '	S-' + this.settings.label + '</li>')
									.attr('id', 'cart-item-' + this.settings.id)
									.data('seatId', this.settings.id)
									.appendTo($cart);

								$counter.text(sc.find('selected').length + 1);
								$total.text(recalculateTotal(sc) + price);
								
								// Lấy thông tin về ghế được chọn
								var selectedSeat = {
									row: this.settings.row + 1,
									seat: this.settings.label
								};
								selectedSeats.push(selectedSeat);
								window.parent.postMessage(selectedSeats, '*');
								
								return 'selected';
							} else if (this.status() == 'selected') { //Checked
								//Update Number
								$counter.text(sc.find('selected').length - 1);
								//update totalnum
								$total.text(recalculateTotal(sc) - price);

								//Delete reservation
								$('#cart-item-' + this.settings.id).remove();
								//optional
								selectedSeats.splice(selectedSeats.findIndex(seat => seat.row === this.settings.row + 1 && seat.seat === this.settings.label), 1);
								window.parent.postMessage(selectedSeats, '*');

								return 'available';
							} else if (this.status() == 'unavailable') { //sold
								return 'unavailable';
							} else {
								return this.style();
							}
						}
					});
					//sold seat
					sc.get([<?php foreach($ghetronghoadon as $g) { echo "'".$g['Hang'].'_'.$g['Cot']."',";} ?>]).status(
						'unavailable');

				});
				//sum total money
				function recalculateTotal(sc) {
					var total = 0;
					sc.find('selected').each(function () {
						total += price;
					});

					return total;
				}

				
			</script>
		</div>
	</div>
	<script type="text/javascript" src="js/theme-change-seat-sel.js"></script>
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
</body>

</html>