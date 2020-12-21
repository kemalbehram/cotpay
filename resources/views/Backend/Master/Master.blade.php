<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="{{ asset('') }}">
    <title>@yield('title')</title>
    {{--  noty  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>
    <script src="{{ asset('asset/js/notify.js') }}"></script>
    <!-- Bootstrap Core CSS -->
    <link href="admin-template/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="admin-template/css/metisMenu.min.css" rel="stylesheet">
    <!-- Timeline CSS -->

    <link href="admin-template/css/timeline.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="admin-template/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="admin-template/css/dataTables/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="admin-template/css/startmin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="admin-template/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="admin-template/js/cotpat-free.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>   
    
    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

    <style>
        .star-rating {
            line-height:32px;
            font-size:1.25em;
        }
        .rating-num { 
            margin-top:0px;
            font-size: 54px; 
        }
        .glyphicon { 
            margin-right:5px;
        }
        .star-rating .glyphicon {
            color:orange;
            font-size: 32px;
        }
        .star-only { 
            margin-left: 5px;
            overflow: visible;
            clip: auto; 
        }
        textarea {
            resize: vertical; /* user can resize vertically, but width is fixed */
        }
        
        .review-block-name{
            font-size:12px;
            margin:10px 0;
        }
        .review-block-date{
            font-size:12px;
        }
        .review-block-rate{
            font-size:13px;
            margin-bottom:15px;
        }
        .review-block-title{
            font-size:15px;
            font-weight:700;
            margin-bottom:10px;
        }
        .review-block-description{
            font-size:13px;
        }
        .stars
        {
            margin: 20px 0;
            font-size: 24px;
            color: #d17581;
        }
        .progress { 
            margin-bottom: 5px;
        }
        .progress-bar { 
            text-align: left; 
        }
        .invoice-title h2, .invoice-title h3 {
            display: inline-block;
        }

        .table > tbody > tr > .no-line {
            border-top: none;
        }

        .table > thead > tr > .no-line {
            border-bottom: none;
        }

        .table > tbody > tr > .thick-line {
            border-top: 2px solid;
        }
    </style>
    
</head>

<body>
    @if (session('success'))
        <script>
            notify("<div style='font-size:15px'><i style='line-height: 20px'; class='fa fa-thumbs-up'><i/> {{ session('success') }} </div>",'success');
        </script>
    @endif

    @if (session('danger'))
        <script>
            notify("<div style='font-size:15px'><i style='line-height: 20px;' class='fa ffa fa-exclamation-circle'><i/> {{ session('danger') }} </div>",'error');
        </script>
    @endif
    @include('Backend.Master.Header')
            
    @include('Backend.Master.Sidebar')

    @yield('content')

    @include('Backend.Master.Footer')

    <!-- jQuery -->
    <script src="admin-template/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="admin-template/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="admin-template/js/metisMenu.min.js"></script>

      <!-- Morris Charts JavaScript -->
    <script src="admin-template/js/raphael.min.js"></script>
    {{-- <script src="admin-template/js/morris.min.js"></script> --}}
    {{-- <script src="admin-template/js/morris-data.js"></script> --}}
    <!-- DataTabladmin-template/JavaScript -->
    <script src="admin-template/js/dataTables/jquery.dataTables.min.js"></script>
    <script src="admin-template/js/dataTables/dataTables.bootstrap.min.js"></script>

    {{-- picker --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="admin-template/js/startmin.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    
    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true
            });
            
            var date = new Date();      
            var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            $('#start-date').val(moment(firstDay).format('YYYY-MM-DD'));
            $('#end-date').val(moment(lastDay).format('YYYY-MM-DD'));
        });


        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });

            $(".js-location").change(function (event) {
                event.preventDefault();
                let route = '{{route('ajax_get.location')}}';
                let $this = $(this);
                let type = $this.attr('data-type');
                let parentID = $this.val();
                $.ajax({
                    method: "GET",
                    url: route,
                    data: {
                        type: type,
                        parent: parentID
                    }
                })
                    .done(function (msg) {
                        if (msg.data) {
                            let html = '';
                            let element = '';
                            if (type == 'city') {
                                html = "<option>Chọn Quận/Huyện</option>";
                                element = '#district';
                            } else {
                                html = "<option>Chọn Xã/Phường</option>";
                                element = '#wards';
                            }

                            $.each(msg.data, function (index, value) {
                                html += "<option value='" + value.code + "'>" + value.name +
                                    "</option>"
                            })

                            $(element).html('').append(html);
                        }
                    });
            })
        })

        // $('#selectExcel').on('click', function() {
        //     $('#file-input').click(function () {
        //         var url = '{{ route('order.import.excel') }}';
        //         console.log(url);
        //     });
        // });

        // Chuyển trạng thái về string
        function statusToString(num, sellBuy , id) {
            var string;
            switch (num){
                case 1:
                    string = "Đơn yêu cầu<br><a href='pages/cancel_order/"+id+" style='font-size: 12px;color:red'>Hủy đơn</a>";
                    break
                case 2:
                    string = "Chờ lấy hàng";
                    if (sellBuy == 2) {
                        string += "<br><a href='pages/request_return_order'"+id+" style='font-size: 12px;color:red'>Đề nghị trả hàng</a>";
                    }
                    break
                case 3:
                    string = "Đã nhận";
                    if (sellBuy == 1) {
                        string += "<br><a href='pages/request_pay_order'"+id+" style='font-size: 12px;color:green'>Yêu cầu thanh toán</a>";
                    } else if (sellBuy == 2){
                        string += "<br><a href='pages/payment_order'"+id+" style='font-size: 12px;color:green'>Thanh toán</a>";
                    }
                    break
                case 4:
                    string = "Giao dịch hủy";
                    break
                case 5:
                    string = "Nhận lại hàng";
                    if (sellBuy == 1) {
                        string += "<br><a href='pages/agree_re_receive'"+id+" style='font-size: 12px;color:blue'>Đồng ý nhận lại</a>";
                    } else if (sellBuy == 2) {
                        string += "<br><a href='pages/request_return_money'"+id+" style='font-size: 12px;color:blue'>Đề nghị hoàn tiền</a>";
                    }
                    break
                case 6:
                    string = "Boom hàng";
                    break
                case 7:
                    string = "Đã nhận lại đơn";
                    break
                case 8: 
                    string = "Đang vận chuyển";
                    if (sellBuy == 2) {
                        string += "<br><a href='pages/request_return_order'"+id+" style='font-size: 12px;color:red'>Đề nghị trả hàng</a>";
                    }
                    break
                case 10:
                    string = "Đã từ chối";
                    break
                case 99:
                    string = "Thanh toán thành công";
                    break
            }
            return string;
        }
        // danh sách đơn hàng theo trạng thái và thời gian
        function orderByStatus(status, sell_buy) {
            var start = $('#start-date').val();
            var end = $('#end-date').val();

            if (start != "" && end != "") {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('order.by.status') }}",
                    data: {
                        start: start,
                        end: end,
                        sell_buy: sell_buy,
                        status: status,
                    },
                }).done(function (data) {
                    var all_orders = 0;
                    $('#tbody_data').html('');
                    renderHtml(data);
                }).fail(function (argument) {
                    console.log(argument);
                });
            }
        }
        // danh sách đơn hàng theo thời gian
        function filterOrder(sell_buy) {
            var start = $('#start-date').val();
            var end = $('#end-date').val();
            if (start != "" && end != "") {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('orders.by.date') }}",
                    data: {
                        start: start,
                        end: end,
                        sell_buy: sell_buy,
                    },
                }).done(function (data) {
                    var all_orders = 0;
                    $('#tbody_data').html('');
                    renderHtml(data);      
                    $('.request-deal').html('Đơn yêu cầu('+data.request_deal+')');
                    $('.pending').html('Chờ lấy hàng('+data.pending+')');
                    $('.delivery').html('Đang vận chuyển('+data.delivery+')');
                    $('.received').html('Đã nhận('+data.received+')');
                    $('.canceled').html('Giao dịch hủy('+data.canceled+')');
                    $('.re-receive').html('Nhận lại hàng('+data.re_receive+')');
                    $('.re-received').html('Đơn đã nhận lại('+data.re_received+')');
                    $('.payment-success').html('Thanh toán thành công('+data.payment_success+')');
                    $('.boom').html('Boom('+data.boom+')');
                    $('.declined').html('Đã từ chối('+data.declined+')');
                }).fail(function (Responsive){
                    console.log(Responsive);
                })
            }   
        }
        // đổ ra html
        function renderHtml(data) {
            $.each(data.orders, function (key, value) {
                $('#tbody_data').append(`<tr>
                    <td>${ key +1 }</td>
                    <td style="color:#007a6e">
                        <b>${ value.code_deal }</b><br>
                        <a style="font-size: 12px;" href="pages/order-detail/${ value.id }">Xem chi tiết</a>
                    </td>
                    
                    <td>
                        <b>${ value.name_receiver }</b><br>
                        ${ value.phone_receiver }
                    </td>
                    <td>${ value.content }</td>
                    
                    <td>${ moment(value.created_at).format('DD-MM-YYYY') }</td>
                    <td style="color:#007a6e">${ number_formats(value.money_value) }<sup>đ</sup></td>
                    <td style="color:#007a6e">${ number_formats(value.cotpay_fee) }<sup>đ</sup></td>
                    <td style="color:#007a6e">${ number_formats(value.ship_fee) }<sup>đ</sup></td>
                    <td>${ value.code_bill }</td>
                    <td>${ moment(value.date_ship_receive).format('DD-MM-YYYY') }</td>
                    <td>${ moment(value.date_ship_success).format('DD-MM-YYYY') }</td>
                    <td>
                        ${statusToString(value.status, value.sell_buy, value.id)}
                    </td>
                </tr>`)
                });
        }
        // xử lý nút xuất file excel 
        function exportExcel(sell_buy) {
            var start = $('#start-date').val();
            var end = $('#end-date').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('order.export.excel') }}",
                data: {
                    start: start,
                    end: end,
                    sell_buy: sell_buy,
                },
            }).done(function (data) {
                alert(data);
                console.log(data);
            }).fail(function (Responsive){
                console.log(Responsive);
            })
        }
    </script>
    
    @yield('script')

</body>

</html>
