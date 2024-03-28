<?php
    include_once "../model/config.php"; 
    include_once "../model/quanlyphim.php"; 
    include_once "../model/check_login.php"; 
    include_once "../model/nguoidung.php"; 

    include "../view/header.php";
    
    if (isset($_GET['c'])) {
        switch ($_GET['c']) {
            case 'login':
                include "../view/sign_in.php";
                break;
            case 'logout':
                include "../view/logout.php";
                break;
            case 'userinfo':
                include "../view/userinfo.php";
                include "../view/footer.php";

                break;
            case 'details':
                if (isset($_GET['id_phim'])) {
                    $id_phim = $_GET['id_phim'];
                    $product = get_phim_by_id($id_phim);
                    include "../view/details.php";
                    include "../view/footer.php";
                    break;
                } else {
                    echo '<span>Không có sản phẩm</span>';
                }
                break;
            case 'book':
                include "../view/ticket-booking.php";
                include "../view/footer.php";

                break;
            case 'lichsudonhang':
                include "../view/lsdatve.php";
                include "../view/footer.php";

                break;
                case 'seatsel':
                    include "../view/seat_sel.php";
                    break;
            default:
                include "../view/index.php";
                include "../view/footer.php";
                break;
        }
    } else {
        include "../view/index.php";
        include "../view/footer.php";

    }

?>