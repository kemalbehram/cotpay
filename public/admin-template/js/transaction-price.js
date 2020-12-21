$(document).ready(function () {

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
                        $('#name_kh').val(data.data.name);
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
                        $('#address_kh').val(data.data.address);
                        $('#ward_kh').val(data.ward.name)
                        $('#district_kh').val(data.district.name);
                        $('#city_kh').val(data.city.name);
                        $('#phone_kh').val(data.data.phone);
                        $('.infoCustomer').removeClass('hide');
                        $('#error-input').addClass('hide');

                    } else {
                        $('.infoCustomer').addClass('hide');
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
                    console.log(data.cot === 'Giá trị giao dịch phải lớn hơn 0')
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

    // $('#money_value').keyup(function(){

    //     });

    //tính phí vận chuyển khi nhập trọng lượng
    $('#weight').keyup(function () { //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
        var query = $(this).val(); //lấy gía trị ng dùng gõ
        var service = $('#service').val();
        $('#weight').val(number_format($(this).val()));
        if (query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
        {
            var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
            $.ajax({
                url: "{{ route('price.ship.fee') }}",
                method: "POST", // phương thức gửi dữ liệu.
                data: {
                    query: query,
                    _token: _token,
                    service: service
                },
                success: function (data) { //dữ liệu nhận về
                    console.log(data.ship_fee)
                    $('#ship_fee').val(number_formats(data.ship_fee));
                }
            });
        }
    });

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