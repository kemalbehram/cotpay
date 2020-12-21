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


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>
    <script src="{{ asset('asset/js/notify.js') }}"></script>
    <!-- Bootstrap Core CSS -->
    <link href="admin-template/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="admin-template/css/metisMenu.min.css" rel="stylesheet">
  {{--   <link href="asset/js/dist/metisMenu.min.css" rel="stylesheet"> --}}
    <!-- Timeline CSS -->

    <link href="admin-template/css/timeline.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="admin-template/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="admin-template/css/dataTables/dataTables.responsive.css" rel="stylesheet">

    {{-- <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css"> --}}
    <!-- Custom CSS -->
    <link href="admin-template/css/startmin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="admin-template/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    {{-- bs multi select cdn --}}
 
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
    @include('Backend.Admin.Master.Header')
            
    @include('Backend.Admin.Master.Sidebar')

    @yield('content')

    @include('Backend.Admin.Master.Footer')

    <!-- jQuery -->
    <script src="admin-template/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="admin-template/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="admin-template/js/metisMenu.min.js"></script>
    {{-- multi select js --}}

    {{-- metisMenu.js --}}
    <script src="asset/js/dist/metisMenu.min.js"> </script>
  

      <!-- Morris Charts JavaScript -->
    <script src="admin-template/js/raphael.min.js"></script>
    {{-- <script src="admin-template/js/morris.min.js"></script> --}}
    {{-- <script src="admin-template/js/morris-data.js"></script> --}}
    <!-- DataTabladmin-template/JavaScript -->
    <script src="admin-template/js/dataTables/jquery.dataTables.min.js"></script>
    <script src="admin-template/js/dataTables/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="admin-template/js/startmin.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });

        var date = new Date();      
        var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

        $('#start-date').val(moment(firstDay).format('YYYY-MM-DD'));
        $('#end-date').val(moment(lastDay).format('YYYY-MM-DD'));

    </script>
    
    @yield('script')
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
