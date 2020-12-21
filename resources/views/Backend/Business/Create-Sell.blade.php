@extends('Backend.Master.Master')
@section('title','Create-Sell')
@section('sell','active')
@section('in','in')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Tạo giao dịch bán</h3>
    </div>
</div>

<div class="row" style="margin-top: 10px;">
    <div class="col-xs-12 col-md-12 col-lg-12" style="margin-bottom: 15px;">
        <form action="{{ route('post.business.sell') }}" method="POST">
            @csrf
            <p class="error-input" id="error-input"></p>
            {!! showErrors($errors,'phone_receiver') !!}
            {!! showErrors($errors,'name_receiver') !!}
            {!! showErrors($errors,'name_user') !!}
            {!! showErrors($errors,'address_receiver') !!}
            {!! showErrors($errors,'city') !!}
            {!! showErrors($errors,'district') !!}
            {!! showErrors($errors,'ward') !!}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Mã khách hàng</label>
                    <input name="code_user" id="code_user" class="form-control" placeholder="Nhập mã khách hàng"
                        value="">
                        {!! showErrors($errors,'code_user') !!}
                </div>

                <div class="infobusiness hide">
                    <div class="row">
                        <div class="col-md-6" id="id-phone">
                            <div class="form-group">
                                <label for="">Điện thoại</label>
                                <input name="phone_receiver" id="phone_receiver"  class="form-control"
                                    placeholder="" value="{{ old('phone_receiver') }}">
                            </div>
                        </div>

                        <input type="hidden" name="email_receiver" id="email_receiver">

                        <div class="col-md-6">
                            <div class="form-group code_tax hide">
                                <label for="">Mã số thuế</label>
                                <input name="code_tax" id="code_tax" disabled="disabled" class="form-control"
                                    placeholder="" value="{{ old('code_tax') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Họ tên</label>
                                <input name="name_receiver" id="name_receiver"  class="form-control"
                                    placeholder="" value="{{ old('name_receiver') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tên Shop/Tên công ty</label>
                                <input name="name_user" id="name_user"  class="form-control"
                                    placeholder="" value="{{ old('name_user') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Đánh giá</label>
                                        <p id="star-rating"><span class="glyphicon glyphicon-star"></span> __ </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tỉ lệ hoàn đơn</label>
                                        <p id="percent-returned"> __ <span class="fa fa-percent"></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Địa chỉ</label>
                                <input name="address_receiver" id="address_receiver" class="form-control"
                                    placeholder="" value="{{ old('address_receiver') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tỉnh/Thành phố</label>
                                <select class="form-control js-location @error('city') has-error @enderror"
                                    id="input-city" data-type="city" name="city">
                                    <option id="option-city" selected value="">Tỉnh/Thành phố</option>
                                    @foreach($cities as $city)
                                    <option value="{{$city->code}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('city'))
                                <div class="error-city">
                                    <p class="error-input">{{ $errors->first('city') }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Quận/Huyện</label>
                                <select class="form-control js-location @error('district') has-error @enderror"
                                    name="district" id="district" data-type="district">
                                    <option id="option-district" selected value="">Quận/Huyện</option>
                                </select>
                                @if($errors->has('district'))
                                <div class="error-district">
                                    <p class="error-input">{{ $errors->first('district') }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Xã/Phường</label>
                                <select class="form-control @error('ward') has-error @enderror" id="wards" name="ward"
                                    data-type="wards">
                                    <option id="option-ward" value="">Xã/Phường</option>
                                </select>
                                @if($errors->has('ward'))
                                <div class="error-ward">
                                    <p class="error-input">{{ $errors->first('ward') }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Giá trị giao dịch</label>
                            <div class="form-group input-group">
                                <input name="money_value" id="money_value" type="text" value="{{ old('money_value') }}" placeholder="Giá trị giao dịch"
                                    class="form-control">
                                <span class="input-group-addon">VNĐ</span>
                               
                            </div>
                            {!! showErrors($errors,'money_value') !!}
                        </div>
                    </div>
                    {{-- <div class="col-md-2"></div> --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Phí COT</label>
                            <div class="form-group input-group">
                                <input name="cotpay_fee" id="cotpay_fee" type="text" value="{{ old('cotpay_fee') }}" placeholder="Phí COT"
                                    class="form-control">
                                <span class="input-group-addon">VNĐ</span>
                               
                            </div>
                            {!! showErrors($errors,'cotpay_fee') !!}
                        </div>
                    </div>
                    <p class="error-input" id="error-p"></p>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nội dung hàng</label>
                            <input name="content" class="form-control" placeholder="Nội dung giao dich"
                                value="{{ old('content') }}">
                                {!! showErrors($errors,'content') !!}
                        </div>
                    </div>
                    {{--  <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Số Lượng</label>
                            <input name="qty" class="form-control" placeholder="Số Lượng"
                                value="{{ old('qty') }}">
                                {!! showErrors($errors,'qty') !!}
                        </div>
                    </div>  --}}
                </div>



                <label for="">Ví</label>
                <div class="form-group">
                    <select name="wallet" class="form-control mt-3"  style="margin-bottom:15px">                   
                        {!! getWallet($wallets,5) !!}

                    </select>
                </div>
            </div>

            <div class="col-md-6">

                <div class="form-group">
                    <label for="">Chọn đơn vị giao nhận</label>
                    <select name="shipping_unit" onchange="change(this.value)" id="shipping_unit"  class="form-control mt-3" style="margin-bottom:15px">
                        {!! getShipingUnit($shipping_unit,1) !!}
                        <option value="6" id="giaohang">Tự giao hàng</option>

                    </select>
                </div>
                <div class="form-group " id="self_shipping" style="" >
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Chiều dài</label>
                                <input name="long" class="form-control" placeholder="Dài(cm)" value="{{ old('long') }}">
                                {!! showErrors($errors,'long') !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Chiều rộng</label>
                                <input name="wide" class="form-control" placeholder="Rộng(cm)" value="{{ old('wide') }}">
                                {!! showErrors($errors,'wide') !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Chiều cao</label>
                                <input name="height" class="form-control" placeholder="Cao(cm)" value="{{ old('height') }}">
                                {!! showErrors($errors,'height') !!}
                            </div>
                        </div>

                    </div >

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Thu hộ</label>
                                <select id="collection" name="collection" class="form-control mt-3"
                                    style="margin-bottom:15px">
                                    <option value="1">Người gửi trả cước</option>
                                    <option value="2">Người nhận trả cước</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Dịch vụ</label>
                                <select id="service" name="service" class="form-control mt-3" style="margin-bottom:15px">
                                    <option value="1">Giao thường</option>
                                    <option value="2">Giao nhanh</option>
                                    <option value="3">Hỏa tốc</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Trọng lượng</label>
                                <div class="form-group input-group">
                                    <input name="weight" id="weight" type="text" value="{{ old('weight') }}" placeholder="Trọng lượng"
                                        class="form-control">
                                    <span class="input-group-addon">GRAM</span>
                                   
                                </div>
                                {!! showErrors($errors,'weight') !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Phí ship</label>
                                <div class="form-group input-group">
                                    <input name="ship_fee" id="ship_fee" class="form-control" value="{{ old('ship_fee') }}" placeholder="Phí ship"
                                        value="">
                                    <span class="input-group-addon">VNĐ</span>
                                   
                                </div>
                                {!! showErrors($errors,'ship_fee') !!}
                            </div>
                        </div>
                    </div>
                    <label for="">Ghi chú</label>
                    <textarea class="form-control" placeholder="Ghi chú" name="note" aria-valuemax="{{ old('note') }}" style="width: 100%;margin-top: 15px;"
                        rows="5"></textarea>
                </div>
            </div>
    </div>
    <div style="margin-top:15px" class="menu-setting-btn mb-5 text-center">
        <button type="submit" class="btn btn-primary mt-3">Đề nghị xác nhận giao dịch</button>
    </div>
    </form>
</div>


<!--end main-->

@endsection
@section('script')
<script>
        function maKhachHang() {
                $('.infobusiness').removeClass('hide');
            }
        $(document).ready(function(){
        //tìm kiếm khách hàng
        $('#code_user').keyup(function () { //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
            var query = $(this).val(); //lấy gía trị ng dùng gõ
            if (query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
            {
                var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
                $.ajax({
                    url: "{{ route('search_user') }}",
                    method: "POST", // phương thức gửi dữ liệu.
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function (data) { //dữ liệu nhận về
                        if (data.data) {
                            $('#code_user').val(data.data.code_user);
                            $('#name_receiver').val(data.data.name);
                            $('#name_user').val(data.data.name_user);
                            if (data.data.level == 3) {
                                $('#id-phone').addClass('col-md-6')
                                $('#code_tax').val(data.data.code_tax);
                                $('.code_tax').removeClass('hide');
                            } else {
                                $('#id-phone').removeClass('col-md-6')
                                $('#id-phone').addClass('col-md-12')
                                $('.code_tax').addClass('hide')
                            }
                            $('#address_receiver').val(data.data.address);
                            $('#option-ward').text(data.ward.name)
                            $('#option-ward').val(data.ward.name)
                            $('#option-district').text(data.district.name);
                            $('#option-district').val(data.district.name);
                            $('#option-city').text(data.city.name);
                            $('#option-city').val(data.city.name);
                            $('#phone_receiver').val(data.data.phone);
                            $('#email_receiver').val(data.data.email);
                            $('#star-rating').html(data.data.star_rate+'<span class="glyphicon glyphicon-star"></span>');
                            $('#percent-returned').html(data.data.percent_returned+'<span class="fa fa-percent"></span>');


                            $('.infobusiness').removeClass('hide');
                            $('#error-input').addClass('hide');

                        } else {
                            $('.infobusiness').addClass('hide');
                            $('#error-input').text(data.danger);
                            $('#error-input').removeClass('hide');
                        }
                    }
                });
            }
        });
        //tính phí cot
        $('#money_value').keyup(function () { //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
            var query = $(this).val(); //lấy gía trị ng dùng gõ
            $('#money_value').val(number_format($(this).val()));
            if (query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
            {
                var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
                $.ajax({
                    url: "{{ route('price.cot') }}",
                    method: "POST", // phương thức gửi dữ liệu.
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function (data) { //dữ liệu nhận về

                        if (data.cot === 'Giá trị giao dịch phải lớn hơn 0') {
                            $('#error-p').text(data.cot);
                        } else {
                            $('#cotpay_fee').val(number_formats(data.cot));
                            $('#error-p').addClass('hide');
                        }
                    }
                });
            }
        });

        // $('#weight').focus(function(){
        // //  var  $a = $('#money_value').val();
        // //  var  $b = $('#ship_fee').val();
        // //  var  $c = a - b;
        //  $('#money_value').val($('#money_value').val() - $('#ship_fee').val());
        // //  console.log($c);
        // });



        //tính phí vận chuyển khi nhập trọng lượng
        $('#weight').keyup(function () { //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
            var query = $(this).val(); //lấy gía trị ng dùng gõ
            var service = $('#service').val();
            if (query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
            {
                var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
                $.ajax({
                    url: "{{ route('price.ship.fee') }}",
                    method: "POST", // phương thức gửi dữ liệu.
                    data: {
                        query: query,
                        _token: _token,
                        service: service,
                    },
                    success: function (data) { //dữ liệu nhận về
                        $('#ship_fee').val(number_formats(data.ship_fee));
                    }
                });
            }
        });


        //sự kiện khi click chọn dịch vụ
        $('#service').change(function () { //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
            var service = $(this).val(); //lấy gía trị ng dùng gõ
            var query = $('#weight').val();
            if (query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
            {
                var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
                $.ajax({
                    url: "{{ route('price.service') }}",
                    method: "POST", // phương thức gửi dữ liệu.
                    data: {
                        query: query,
                        _token: _token,
                        service: service
                    },
                    success: function (data) { //dữ liệu nhận về
                        $('#ship_fee').val(number_formats(data.ship_fee));
                    }
                });
            }
        });

    });


    function change(){
        var state = document.getElementById("shipping_unit").value;
        if(state == 6){
            document.getElementById("self_shipping").style.visibility='hidden';
        }else{
            document.getElementById("self_shipping").style.visibility ='visible';
        }
    }

    
</script>
@endsection
