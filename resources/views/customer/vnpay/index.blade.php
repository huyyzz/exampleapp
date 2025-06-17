<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Tạo mới đơn hàng</title>
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('vnpay/assets/bootstrap.min.css') }}" rel="stylesheet" />

        <!-- Custom styles -->
        <link href="{{ asset('vnpay/assets/jumbotron-narrow.css') }}" rel="stylesheet" />

        <!-- jQuery -->
        <script src="{{ asset('vnpay/assets/jquery-1.11.3.min.js') }}"></script>
    </head>

    <body>
    <div class="table">
        <form>
            @csrf
            <div class="form-group">
                <!-- Form group -->
                 <label for="order_id">Mã hóa đơn</label>
                 <input type="text" class="form-control" id="order_id" name="order_id" value="{{ $orderId }}">
            </div>
            <div class="form-group">
                <!-- Form group -->
                 <label for="subtotal">Tổng số tiền</label>
            </div>
            <div class="form-group">
                <label for="description">Nội dung thanh toán</label>
                <textarea class="form-control" cols="20" id="description" name="description" rows="2" placeholder="Nội dung thanh toán" required></textarea>
            </div>
            <select name="bank_code" id="bank_code" class="form-control">
                <option value="">Không chọn</option>
                <option value="NCB">Ngân hàng NCB</option>
                <option value="AGRIBANK">Ngân hàng Agribank</option>
                <option value="SCB">Ngân hàng SCB</option>
                <option value="SACOMBANK">Ngân hàng Sacombank</option>
                <option value="EXIMBANK">Ngân hàng Eximbank</option>
                <option value="MSBANK">Ngân hàng MSBANK</option>
                <option value="NAMABANK">Ngân hàng NamABank</option>
                <option value="VNMART">Ví điện tử VnMart</option>
                <option value="VIETINBANK">Ngân hàng Vietinbank</option>
                <option value="VIETCOMBANK">Ngân hàng VCB</option>
                <option value="HDBANK">Ngân hàng HDBank</option>
                <option value="DONGABANK">Ngân hàng Dong A</option>
                <option value="TPBANK">Ngân hàng TPBank</option>
                <option value="OJB">Ngân hàng OceanBank</option>
                <option value="BIDV">Ngân hàng BIDV</option>
                <option value="TECHCOMBANK">Ngân hàng Techcombank</option>
                <option value="VPBANK">Ngân hàng VPBank</option>
                <option value="MBBANK">Ngân hàng MBBank</option>
                <option value="ACB">Ngân hàng ACB</option>
                <option value="OCB">Ngân hàng OCB</option>
                <option value="IVB">Ngân hàng IVB</option>
                <option value="VISA">Thanh toán qua VISA/MasterCard</option>
            </select>
            <button type="submit" class="btn btn-primary" id="btnPopup">Xác nhận thanh toán</button>
            <button type="button" class="btn btn-primary" onclick="history.back()">Quay trở lại</button>
        </form>


    </div>
    <div class="container">
           <div class="header clearfix">

                <h3 class="text-muted">VNPAY DEMO</h3>
            </div>
                <div class="form-group">
                    <button onclick="pay()">Giao dịch thanh toán</button><br>
                </div>
                <div class="form-group">
                    <button onclick="querydr()">API truy vấn kết quả thanh toán</button><br>
                </div>
                <div class="form-group">
                    <button onclick="refund()">API hoàn tiền giao dịch</button><br>
                </div>
            <p>
                &nbsp;
            </p>
            <footer class="footer">
                   <p>&copy; VNPAY <?php echo date('Y')?></p>
            </footer>
        </div> 
        <script>
             function pay() {
              window.location.href = "/vnpay_php/vnpay_pay.php";
            }
            function querydr() {
              window.location.href = "/vnpay_php/vnpay_querydr.php";
            }
             function refund() {
              window.location.href = "/vnpay_php/vnpay_refund.php";
            }
        </script>
    </body>
</html>
