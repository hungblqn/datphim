
<main>
        <h2>Quản lý Hóa đơn</h2>
            <?php
            $hoadons = show_hoadon_all();
            if ($hoadons) {
                echo '<div class="product-table">';
                echo '<h2>Danh sách hóa đơn</h2>';
                echo '<table>';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Mã Hóa dơn</th>';
                echo '<th>Tên phim</th>';
                echo '<th>Ghế</th>';
                echo '<th>Rạp</th>';
                echo '<th>Thành tiền</th>';
                echo'<th>Thời gian ra về</th>';
                echo'<th>In hóa đơn</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                foreach ($hoadons as $hoadon) {
                    echo '<tr>';
                    echo '<td>' . $hoadon['id_hoadon'] . '</td>';

                    $phim = get_phim_by_id($hoadon['id_phim']);
                        echo '<td>' . $phim['tenphim'] . '</td>';
                    
                    $ghe = get_ghe_by_id($hoadon['id_ghe']);
                        echo '<td>' . $ghe['Hang'].$ghe['Cot'] . '</td>';
                    
                    $rap= get_rap_by_id($hoadon['id_rap']);
                        echo '<td>' . $rap['tenrap'] . '</td>';

                    echo '<td>' . $hoadon['thanhtien'] . '</td>';
                    echo '<td>' . $hoadon['thoigian_rave'] . '</td>';
                    echo '<td style="text-align: center;"><a  href="../controller/indexadmin.php?c=inhoadon&id_hoadon=' . $hoadon['id_hoadon'].'">In hóa đơn</a></td>';                    echo '<td>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo 'No products found.';
            }
            ?>

        </div>
        </div>
    </main>