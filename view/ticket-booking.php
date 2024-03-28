<?php
	$array = array('item1','item2');
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idrap = isset($_POST['idrap']) ? $_POST['idrap'] : ""; 
	echo '<div>
              <iframe id="seat-sel-iframe"
                style="box-shadow: 0 14px 12px 0 var(--theme-border), 0 10px 50px 0 var(--theme-border); width: 800px; height: 550px; display: block; margin-left: auto; margin-right: auto;"
                src="seat_sel.php?id_phim=' . $_GET['id_phim'] . '&id_rap=' . $idrap . '"></iframe>
          </div>';
    exit();
}
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['receivedArray'])) {
    // Lấy dữ liệu từ AJAX
    $receivedArray = json_decode($_POST['receivedArray'], true);
	foreach ($receivedArray as $value) {
    $array[] = $value;
  }
	
    // Xử lý dữ liệu ở đây, ví dụ:
    // Trả về dữ liệu dưới dạng JSON
    echo json_encode($receivedArray);
    exit; // Kết thúc việc xử lý PHP
}
	include_once "../model/config.php"; 
	include_once "../model/quanlyphim.php"; 
	$id_phim = $_GET['id_phim'];
	$phim = get_phim_by_id($id_phim);
	
	$rap = pdo_query("select distinct c.id_rap, r.tenrap
FROM chitietsuatchieu c
INNER JOIN rap r ON c.id_rap = r.id_rap
WHERE c.id_phim = ".$id_phim.";");
	
	$ngaychieu = pdo_query("SELECT ngaychieu.id_ngaychieu,ngaychieu.thoigian, COUNT(*) as count 
FROM chitietsuatchieu 
INNER JOIN ngaychieu ON chitietsuatchieu.id_ngaychieu = ngaychieu.id_ngaychieu 
WHERE chitietsuatchieu.id_phim = ".$id_phim."
GROUP BY ngaychieu.id_ngaychieu;");
	
	

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ticket Booking</title>
  <link rel="stylesheet" type="text/css" href="../assets/css/style-starter.css">
  <link rel="stylesheet" href="https://npmcdn.com/flickity@2/dist/flickity.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/progress.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../assets/css/ticket-booking.css">
  <!-- ..............For progress-bar............... -->
  <link rel="stylesheet" type="text/css" href="../assets/css/e-ticket.css">

  <link rel="stylesheet" type="text/css" href="../assets/css/payment.css" />
  <link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,700" rel="stylesheet">
</head>

<body>
  <header id="site-header" class="w3l-header fixed-top">

    <!--/nav-->
    <nav class="navbar navbar-expand-lg navbar-light fill px-lg-0 py-0 px-3">
      <div class="container">
        <h1><a class="navbar-brand" href="../index.php"><span class="fa fa-play icon-log" aria-hidden="true"></span>
            MyShowz </a></h1>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        </div>

        <div class="Login_SignUp" id="login_s">
          <!-- style="font-size: 2rem ; display: inline-block; position: relative;" -->
          <!-- <li class="nav-item"> -->
          <a class="nav-link" href="sign_in.php"><i class="fa fa-user-circle-o"></i></a>
          <!-- </li> -->
        </div>
        <!-- toggle switch for light and dark theme -->
        <div class="mobile-position">
          <nav class="navigation">
            <div class="theme-switch-wrapper">
              <label class="theme-switch" for="checkbox">
                <input type="checkbox" id="checkbox">
                <div class="mode-container">
                  <i class="gg-sun"></i>
                  <i class="gg-moon"></i>
                </div>
              </label>
            </div>
          </nav>
        </div>
      </div>
    </nav>
  </header>

  <div class="container" id="progress-container-id">
    <div class="row">
      <div class="col">
        <div class="px-0 pt-4 pb-0 mt-3 mb-3">
          <form id="form">
            <ul id="progressbar" class="progressbar-class">
			<!--<div id="result"></div>-->
			
              <li class="active" id="step1">Chọn lịch</li>
              <li id="step2" class="not_active">Chọn ghế</li>
              <li id="step3" class="not_active">Thanh toán</li>
              <li id="step4" class="not_active">Vé trực tuyến</li>
            </ul>
            <br>
            <fieldset>
              <div id="screen-select-div">
                <h2>Chọn lịch</h2>
                <div class="carousel carousel-nav" data-flickity='{"contain": true, "pageDots": false }'>
				<?php
				$i = 0;
$daysOfWeek = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");

foreach ($ngaychieu as $nc) {
    $today = strtotime($nc['thoigian']);
    $date = date('d', $today);
    $dayOfWeek = $daysOfWeek[date('w', $today)]; // Lấy thứ từ mảng $daysOfWeek
    echo '<div class="carousel-cell" id="'.($i+1).'" onclick="myFunction(' . ($i + 1) . ')">
                <div class="date-numeric">' . $date . '</div>
                <div class="date-day">' . $dayOfWeek . '</div>
            </div>';
    $i++; // Tăng $i trong mỗi lần lặp
}
						?>
</div>
                <ul class="time-ul">
				
                  <li class="time-li">
					<?php
						foreach($rap as $r) {
							echo '<div class="screens">
                      Rạp '.$r['tenrap'].'
                    </div>';
					echo '<div class="time-li">';
					$xuatchieu = pdo_query("SELECT distinct xuatchieu.* 
                        FROM chitietsuatchieu
                        INNER JOIN xuatchieu ON chitietsuatchieu.id_xuatchieu = xuatchieu.id_xuat
                        WHERE chitietsuatchieu.id_phim = " . $id_phim . " AND chitietsuatchieu.id_rap = " . $r['id_rap']);
					foreach($xuatchieu as $xc) {
    // Convert the time string to AM/PM format
    $formattedTime = date("g:i A", strtotime($xc['xuatchieu']));

    // Output the formatted time within a button
    echo '
	
        <button class="screen-time" data-idrap="'.$r['id_rap'].'" data-idphim="'.$r['id_rap'].'" onclick="timeFunction(this)">
            '.$formattedTime.'
        </button>
					';}
					echo '</div></li>';
						}
					?>
                    <script>
    $(document).ready(function(){
        $(".screen-time").click(function(){
            var idrap = $(this).data("idrap");
			var name = <?php echo $id_phim; ?>;
			console.log("idrap: "+idrap);
			console.log("idphim: "+name);
            // Send data using AJAX
            $.post("ticket-booking.php?id_phim=<?php echo $id_phim ?>", { idrap: idrap, name: name }, function(response){
                $("#resultt").html(response);
            });
        });
    });
</script>
                  

                </ul>
              </div>
              <input id="screen-next-btn" type="button" name="next-step" class="next-step" value="Tiếp tục"
                disabled />
            </fieldset>
            <fieldset>
				
			<div id="resultt"></div>		
              <!--<div>
                <iframe id="seat-sel-iframe"
                  style="  box-shadow: 0 14px 12px 0 var(--theme-border), 0 10px 50px 0 var(--theme-border); width: 800px; height: 550px; display: block; margin-left: auto; margin-right: auto;"
                  src="seat_sel.php?id_phim=<?php echo $phim['id_phim']; ?>"></iframe>
              </div>-->
              <br>
              <input type="button" name="next-step" class="next-step" value="Thanh toán" />
              <input type="button" name="previous-step" class="previous-step" value="Trở lại" />
            </fieldset>
            <fieldset>
              <!-- Payment Page -->

              <div class="wrapper" style="display: none;">
                <div id="payment_div">
                  <div class="payment-row">
                    <div class="col-75">
                      <div class="payment-container">
                        <div class="payment-row">
                          <div class="col-50">
                            <h3 id="payment-h3">Payment</h3>
                            <div class="payment-row payment">
                              <div class="col-50 payment">
                                <label for="card" class="method card">
                                  <div class="icon-container">
                                    <i class="fa fa-cc-visa" style="color: navy"></i>
                                    <i class="fa fa-cc-amex" style="color: blue"></i>
                                    <i class="fa fa-cc-mastercard" style="color: red"></i>
                                    <i class="fa fa-cc-discover" style="color: orange"></i>
                                  </div>
                                  <div class="radio-input">
                                    <input type="radio" id="card" />
                                    Pay RS.200.00 with credit card
                                  </div>
                                </label>                          
                              </div>
                              <div class="col-50 payment">
                                
                                <label for="paypal" class="method paypal">
                                  <div class="icon-container">
                                    <i class="fa fa-paypal" style="color: navy"></i>
                                  </div>
                                  <div class="radio-input">
                                    <input id="paypal" type="radio" checked>
                                    Pay $30.00 with PayPal
                                  </div>
                                </label>  
                              </div>
                            </div>
                            <div class="payment-row">
                              <div class="col-50">
                                 <label for="cname">Cardholder's Name</label>
                                <input type="text" id="cname" name="cardname" placeholder="Firstname Lastname" required />                 
                              </div>
                              <div class="col-50">
                                 <label for="ccnum">Credit card number</label>
                                <input type="text" id="ccnum" name="cardnumber" placeholder="xxxx-xxxx-xxxx-xxxx"
                                  required />
                              </div>
                            </div>
                            <div class="payment-row">
                              <div class="col-50">
                                <label for="expmonth">Exp Month</label>
                                <input type="text" id="expmonth" name="expmonth" placeholder="September" required />
                              </div>
                              <div class="col-50">
                                <div class="payment-row">
                                  <div class="col-50">
                                    <label for="expyear">Exp Year</label>
                                    <input type="text" id="expyear" name="expyear" placeholder="yyyy" required />
                                  </div>
                                  <div class="col-50">
                                    <label for="cvv">CVV</label>
                                    <input type="text" id="cvv" name="cvv" placeholder="xxx" required />
                                  </div>
                                </div>
                              </div>
                            </div>  
                          </div>
                        </div>
                      </div>
                    </div>
                  </div> 
                </div>
              </div>
            

              <input type="button" name="next-step" class="next-step pay-btn" value="Xác nhận" />
              <input type="button" name="previous-step" class="cancel-pay-btn" value="Hủy"
                onclick="location.href='../index.html';" />
            </fieldset>
        
            <fieldset>
              <h2>E-Ticket</h2>
              <div class="ticket-body">
				<div id="test"></div>
				<!--
					<div class="ticket">
                  <div class="holes-top"></div>
                  <div class="title">
                    <p class="cinema">MyShowz Entertainment</p>
                    <p class="movie-title"><?php/* echo $phim['tenphim']; */?></p>
                  </div>
                  <div class="poster">
                    <img src="<?php /*echo '../assets/images/'.$phim['anh']*/?>"
                      alt="Movie: Only God Forgives" height="200px" />
                  </div>
                  <div class="info">
                    <table class="info-table ticket-table">
                      <tr>
                        <th>SCREEN</th>
                        <th>ROW</th>
                        <th>SEAT</th>
                      </tr>
                      <tr>
                        <td class="bigger">18</td>
                        <td class="bigger">H</td>
                        <td class="bigger">24</td>
                      </tr>
                    </table>
                    <table class="info-table ticket-table">
                      <tr>
                        <th>PRICE</th>
                        <th>DATE</th>
                        <th>TIME</th>
                      </tr>
                      <tr>
                        <td>RS.12.00</td>
                        <td>4/13/21</td>
                        <td>19:30</td>
                      </tr>
                    </table>
                  </div>
                  <div class="holes-lower"></div>
                  <div class="serial">
                    <table class="barcode ticket-table">
                      <tr>
                        <td style="background-color:black;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                        <td style="background-color:black;"></td>
                        <td style="background-color:white;"></td>
                      </tr>
                    </table>
                    <table class="numbers ticket-table">
                      <tr>
                        <td>9</td>
                        <td>1</td>
                        <td>7</td>
                        <td>3</td>
                        <td>7</td>
                        <td>5</td>
                        <td>4</td>
                        <td>4</td>
                        <td>4</td>
                        <td>5</td>
                        <td>4</td>
                        <td>1</td>
                        <td>4</td>
                        <td>7</td>
                        <td>8</td>
                        <td>7</td>
                        <td>3</td>
                        <td>4</td>
                        <td>1</td>
                        <td>4</td>
                        <td>5</td>
                        <td>2</td>
                      </tr>
                    </table>
                  </div>
                </div>
				-->
                
              <input type="button" name="previous-step" class="home-page-btn" value="Quay về trang chủ"
                onclick="location.href='../index.php';" />
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  let prevId = "1";

  window.onload = function () {
    document.getElementById("screen-next-btn").disabled = true;
  }
  function timeFunction(button) {
    document.getElementById("screen-next-btn").disabled = false;
	
	
  }

  function myFunction(id) {
    document.getElementById(prevId).style.background = "rgb(243, 235, 235)";
    document.getElementById(id).style.background = "#df0e62";
    prevId = id;
  }
  
  // Lắng nghe thông điệp từ iframe con
        window.addEventListener('message', function(event) {
            // Kiểm tra xem thông điệp có được gửi từ iframe con không
            if (event.source !== document.getElementById('seat-sel-iframe').contentWindow) {
                return;
            }

            // Xác nhận rằng dữ liệu được gửi là một mảng
            if (Array.isArray(event.data)) {
        var receivedArray = event.data;
		var html = receivedArray.map(function(item) {
        return `
            <div class="ticket">
                <div class="holes-top"></div>
                <div class="title">
                    <p class="cinema">MyShowz Entertainment</p>
                    <p class="movie-title"><?php echo $phim['tenphim']; ?></p>
                </div>
                <div class="poster">
                    <img src="<?php echo '../assets/images/'.$phim['anh']?>" alt="Movie: Only God Forgives" height="200px" />
                </div>
                <div class="info">
                    <table class="info-table ticket-table">
                        <tr>
                            <th>SCREEN</th>
                            <th>ROW</th>
                            <th>SEAT</th>
                        </tr>
                        <tr>
                            <td class="bigger">18</td>
                            <td class="bigger">`+item.row+`</td>
                            <td class="bigger">`+item.seat+`</td>
                        </tr>
                    </table>
                    <table class="info-table ticket-table">
                        <tr>
                            <th>PRICE</th>
                            <th>DATE</th>
                            <th>TIME</th>
                        </tr>
                        <tr>
                            <td>RS.<?php echo $phim['gia']; ?></td>
                            <td>4/13/21</td>
                            <td>19:30</td>
                        </tr>
                    </table>
                </div>
                <div class="holes-lower"></div>
                <div class="serial">
                    <table class="barcode ticket-table">
                        <tr>
                            <!-- Your barcode HTML here -->
                        </tr>
                    </table>
                    <table class="numbers ticket-table">
                        <tr>
                            <!-- Your numbers HTML here -->
                        </tr>
                    </table>
                </div>
            </div>
        `;
    }).join('');
    // Hiển thị chuỗi HTML lên giao diện người dùng
    document.getElementById('test').innerHTML = html;
		
		
        // Gửi dữ liệu đến tập tin PHP bằng cách sử dụng AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'ticket-booking.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Xử lý kết quả trả về từ AJAX
                var result = JSON.parse(xhr.responseText);
                // Hiển thị kết quả trên giao diện người dùng
                document.getElementById('result').innerHTML = JSON.stringify(result);
            }
        };
        xhr.send('receivedArray=' + JSON.stringify(receivedArray));
    }
        }, false);
</script>

<script src="https://npmcdn.com/flickity@2/dist/flickity.pkgd.js"></script>
<script type="text/javascript" src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'>
</script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src="../assets/js/theme-change.js"></script>

<script type="text/javascript" src="../assets/js/ticket-booking.js"></script>

</html>