<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <base href="{{asset('')}}">
    <link rel="stylesheet" type="text/css" href="asset/css/stylehd.css">
    <link rel="stylesheet" type="text/css" href="asset/css/style.css">
    <link rel="stylesheet" type="text/css" href="asset/css/stylehd.css">
    <link rel="stylesheet" type="text/css" href="asset/css/style-update.css">
    <link rel="stylesheet" href="asset/css/style1.css">
    <link rel="stylesheet" type="text/css" href="asset/css/choose-wallet.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="asset/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="asset/css/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>
    <script src="{{ asset('asset/js/notify.js') }}"></script>
    <script
            src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous">
    </script>
</head>
<body>
    @if (session('success'))
    <script>
        notify("<div style='font-size:15px'><i class='fa fa-check'></i> {{ session('success') }} </div>",'success');
    </script>
    @endif

    @if (session('danger'))
        <script>
            notify("<div style='font-size:15px'><i style='line-height: 20px;' class='fa ffa fa-exclamation-circle'><i/> {{ session('danger') }} </div>",'error');
        </script>
    @endif
    @include('Frontend.Layouts.Header')
    @yield('content')
    @include('Frontend.Layouts.Footer')

    @yield('script')

    <script src="asset/js/jquery.min.js" defer></script>
    <script src="asset/bootstrap/js/bootstrap.min.js" defer></script>
    <script src="asset/js/slick.min.js" defer></script>
    <script src="asset/js/script.js" defer></script>
    <script type="text/javascript">
        function openNav() {
            document.getElementById("mySidepanel").style.width = "220px";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }

        // menu2
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function () {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>

    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

    </script>
    </body>
</html>
