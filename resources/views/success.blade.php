<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Admin - Thế giới điện thoại</title>
    <link rel="shortcut icon" href="img/favicon.ico" />

    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
          crossorigin="anonymous">

    <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

    <!-- Our files -->
    <link rel="stylesheet" href="css/admin/style.css">
    <link rel="stylesheet" href="css/admin/progress.css">

    <script src="data/products.js"></script>
    <script src="js/classes.js"></script>
    <script src="js/dungchung.js"></script>
    <script src="js/admin.js"></script>
</head>

<body>
<div class="donhang">
    <table class="table-header">
        <tr>
            <!-- Theo độ rộng của table content -->
            <th title="Sắp xếp" style="width: 5%" onclick="sortDonHangTable('stt')">Stt <i class="fa fa-sort"></i></th>
            <th title="Sắp xếp" style="width: 13%" onclick="sortDonHangTable('madon')">Mã đơn <i class="fa fa-sort"></i></th>
            <th title="Sắp xếp" style="width: 7%" onclick="sortDonHangTable('khach')">Khách <i class="fa fa-sort"></i></th>
            <th title="Sắp xếp" style="width: 20%" onclick="sortDonHangTable('sanpham')">Sản phẩm <i class="fa fa-sort"></i></th>
            <th title="Sắp xếp" style="width: 15%" onclick="sortDonHangTable('tongtien')">Tổng tiền <i class="fa fa-sort"></i></th>
            <th title="Sắp xếp" style="width: 10%" onclick="sortDonHangTable('ngaygio')">Ngày giờ <i class="fa fa-sort"></i></th>
            <th title="Sắp xếp" style="width: 10%" onclick="sortDonHangTable('trangthai')">Trạng thái <i class="fa fa-sort"></i></th>
            <th style="width: 10%">Hành động</th>
        </tr>
    </table>

    <div class="table-content">
    </div>

    <div class="table-footer">
        <div class="timTheoNgay">
            Từ ngày: <input type="date" id="fromDate">
            Đến ngày: <input type="date" id="toDate">

            <button onclick="locDonHangTheoKhoangNgay()"><i class="fa fa-search"></i> Tìm</button>
        </div>

        <select name="kieuTimDonHang">
            <option value="ma">Tìm theo mã đơn</option>
            <option value="khachhang">Tìm theo tên khách hàng</option>
            <option value="trangThai">Tìm theo trạng thái</option>
        </select>
        <input type="text" placeholder="Tìm kiếm..." onkeyup="timKiemDonHang(this)">
    </div>

</div>
</body>

</html>
