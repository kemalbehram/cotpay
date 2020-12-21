<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Forgot Password</title>

        <!-- Bootstrap Core CSS -->
        <link href="admin-template/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="admin-template/css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="admin-template/css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="admin-template/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css">

         {{--  notyfy  --}}
         <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>
         <script src="{{ asset('asset/js/notify.js') }}"></script>
    </head>
    <body>
        @if (session('danger'))
            <script>
                notify("<div style='font-size:15px'><i style='line-height: 20px;' class='fa ffa fa-exclamation-circle'><i/>  {{ session('danger') }} </div>",'error');
            </script>
        @endif
        @if (session('success'))
            <script>
                notify("<div style='font-size:15px'><i style='line-height: 20px;' class='fa ffa fa-exclamation-circle'><i/>  {{ session('success') }} </div>",'success');
            </script>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Forgot Password</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                @csrf
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="E-mail" value="{{ old('email') }}" name="email" type="email" autofocus>
                                        @if($errors->has('email'))
                                            <div class="error-city">
                                                <p class="error-input">{{ $errors->first('email') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <div class="col-md-6" style="margin-bottom: 10px;">
                                        <button type="submit" class="btn btn-sm btn-success btn-block">Send mail</button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('index') }}"><button type="button" class="btn btn-sm btn-success btn-block">Trang chủ</button></a>    
                                    </div>
                                    
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="admin-template/js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="admin-template/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="admin-template/js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="admin-template/js/startmin.js"></script>

    </body>
</html>
