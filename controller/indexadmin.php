<?php
    include_once "../model/config.php"; 
    include_once "../model/quanlyphim.php"; 
    include_once "../model/ghe.php"; 
    include_once "../model/rap.php"; 
    include_once "../model/hoadon.php"; 
    include_once "../model/nguoidung.php";
    include "../viewadmin/header.php";

    if (isset($_GET['c'])) {
      
        switch ($_GET['c']) {
            case 'qlfilm':
                include "../viewadmin/qlphim.php";
                break;
            case 'qlghe':
                include "../viewadmin/qlghe.php";
                break;
            case 'qlrap':
                include "../viewadmin/qlrap.php";
                break;
            case 'logout':
                include "../view/logout.php";
                break;
                case 'qlhoadon':
                    include "../viewadmin/qlhoadon.php";
                    break;    
                case 'inhoadon':
                    include "../viewadmin/inhoadon.php";
                    break;
                case 'qlnguoidung':
                    include "../viewadmin/qlnguoidung.php";
                    break;    
            default:
                include "../viewadmin/qlphim.php";
                break;
        }
    } else {
        include "../viewadmin/qlphim.php";
    }

    include "../viewadmin/footer.php";

?>