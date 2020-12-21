@extends('Frontend.Layouts.Master')
@section('title')
    About
@endsection
@section('content')
    <div class="row row_css">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="text-center introduce">
                <div class="title-introduce">
                    <h1>Vài điều về chúng tôi</h1>
                </div>
                <div class="cotpay">
                    <h1>COTPAY</h1>
                </div>
                <div class="text-center">
                    <div class="hr text-center"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>

    <div class="row row_css">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="text-center content-introduce">
                <p>
                    
                        {{$about->content}}
                    
                </p>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="row row_css">
        <div class="mission">
            <div class="row row_css">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="text-center introduce">
                        <div class="title-introduce cotpay">
                            <h1>Nhiệm vụ của chúng tôi</h1>
                        </div>
                        <div class="text-center">
                            <div class="hr_mission text-center"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>


            <div class="row row_css mt-3">
                <div class="col-md-2"></div>
                @foreach ($about2 as $item)
                    
                
                <div class="col-md-2">
                    <div class="mission-category">
                        <div class="mission-icon text-center">
                            
                        </div>
                        <h2 class="text-center">{{$item->name}}</h2>
                        <p class="text-center">{{$item->content}}</p>
                    </div>
                </div>

                    @endforeach
                
               
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>

    <div class="row row_css">
        <div class="partner">
            <div class="row row_css">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="text-center introduce">
                        <div class="title-introduce cotpay">
                            <h1>Chúng tôi đã hợp tác với</h1>
                        </div>
                        <div class="text-center">
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row row_css">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="hr_mission text-center"></div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="partner-img text-center">
                                <img src="asset/images/ebay.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="partner-img text-center">
                                <img src="asset/images/viettel.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="partner-img text-center">
                                <img src="asset/images/zalo.png" alt="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="partner-img text-center">
                                <img src="asset/images/air.png" alt="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="partner-img text-center">
                                <img src="asset/images/momo.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="partner-img text-center">
                                <img src="asset/images/vn.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>

            </div>

            <div class="row row_css">
                <div class="partner-content">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="partner-p">
                                <p class="text-center">{{$about6->content}} </p>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row_css">
        <div class="solution-title">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="hr_mission text-center"></div>
                    <div class="solution-title-h1">
                        <h1>Bạn là doanh nghiệp/khách hàng bán hàng? Bạn đang
                            tìm kiếm giải pháp thanh toán an toàn, tiết kiệm, nhanh gọn?
                            Chúng tôi cung cấp nền tảng. Bạn đem về lợi nhuận</h1>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <div class="row row_css">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="solution-button text-center">
                    <button type="button">Giải pháp thanh toán COT</button>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

    <div class="register-now">
        <div class="row row_css register_now">
            <div class="register_now-title">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="register_now-h1">
                            <h1>Hình thức thanh toán COT tiện lợi hiện nay</h1>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
        <div class="row row_css">
            <div class="register_now-button text-center">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                    <a href="/register">    <button  type="button">Đăng ký ngay</button></a>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
