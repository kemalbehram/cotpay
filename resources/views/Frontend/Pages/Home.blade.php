@extends('Frontend.Layouts.Master')
@section('title')
    Trang chủ
@endsection
@section('content')
<div class="container mt-5">
    <h1 class="title-search"><img src="asset/images/anh.jpg" width="170" height="160" alt=""></h1>
    <div class="search mt-5" style="margin-top: 0px !important;">
        <div class="box-search">
            <div class="form">
                @csrf
                <input type="text" id="search-content" class="form-control" placeholder="Nhập mã vận đơn hoặc mã đơn hàng" />
                <i class="fa fa-search" aria-hidden="true"></i>
                <div id="list"></div>
            </div>                
        </div>
        <div class="scan">
            <a href="#" type="button" id="search" title>Tìm</a>
        </div>
        <div id="search-result"></div>
        <div class="img-slider mt-5 mb-5">
            <div class="item">
                <a href="#" title>
                    <img src="asset/images/img-slider.png">
                </a>
            </div>
            <div class="item">
                <a href="#" title>
                    <img src="asset/images/img-slider.png">
                </a>
            </div>
            <div class="item">
                <a href="#" title>
                    <img src="asset/images/img-slider.png">
                </a>
            </div>
        </div>


        <div class="spacer"></div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#search').click(function () {
            var code = $('#search-content').val();
            var _token = $('input[name="_token"]').val();
            if(code != ''){
                $.ajax({
                    url: "{{ route('search.action') }}",
                    type: "POST",
                    data: {
                        _token:_token,
                        content: code,
                    },
                }).done(function (data) {
                    var html = `<div class="table-responsive" style="margin-top:20px">
                                    <h3 align="center"><span>Có ${data.length} kết quả được tìm thấy</span></h3>
                                    <table class="table table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>Mã đơn hàng</th>
                                                <th>Mã giao vận</th>
                                                <th>Người gửi</th>
                                                <th>Người nhận</th>
                                                <th>Sđt người nhận</th>
                                                <th>Địa chỉ người nhận</th>
                                                <th>Trọng lượng đơn</th>
                                            </tr>
                                        </thead>
                                        <tbody>`;
                    $.each(data, function (key, value) {
                        html += `<tr>
                            <td>${value.code_deal}</td>
                            <td>${value.code_bill}</td>
                            <td>${value.name_sender}</td>
                            <td>${value.name_receiver}</td>
                            <td>${value.phone_receiver}</td>
                            <td>${value.address_receiver}</td>
                            <td>${value.weight}</td>
                        </tr>`
                    })
                    html += `</tbody>
                        </table>
                    </div>`;
                    $('#search-result').html(html);
                }).fail(function (Responsive){
                    console.log(Responsive);
                })
            }
        })
    });

</script>

@endsection
