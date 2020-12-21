@extends('Backend.Master.Master')
@section('title','Đánh giá')
@section('content')
	<div class="row" style="margin-top: 50px;">
        <div class="col-xs-12 col-md-6">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-xs-12 col-md-6 text-center">
                    	<h5>Đánh giá {{ $name_rated }}</h5>
                        <h1 class="rating-num">
                            {{ $star_rate }}</h1>
                        <div class="star-rating">
                        	@for($i = 1; $i <= 5; $i++)
                        		@if($i <= $star_rate )
		                            <span class="glyphicon glyphicon-star"></span>
		                        @else
		                            <span class="glyphicon glyphicon-star-empty"></span>
		                        @endif
                            @endfor
                        </div>
                        <div>
                            <span class="glyphicon glyphicon-user"></span>{{ $count_rate }} đánh giá
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="row rating-desc">
                            <div class="col-xs-3 col-md-3 text-right">
                                <span class="glyphicon glyphicon-star"></span>5
                            </div>
                            <div class="col-xs-8 col-md-9">
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
                                        aria-valuemin="0" aria-valuemax="100" style="width: {{ ($count_rate==0) ? 0 : ($_5sao/$count_rate)*100 }}%">
                                        <span class="sr-only star-only">{{ $_5sao }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 5 -->
                            <div class="col-xs-3 col-md-3 text-right">
                                <span class="glyphicon glyphicon-star"></span>4
                            </div>
                            <div class="col-xs-8 col-md-9">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
                                        aria-valuemin="0" aria-valuemax="100" style="width: {{ ($count_rate==0) ? 0 : ($_4sao/$count_rate)*100 }}%">
                                        <span class="sr-only star-only">{{ $_4sao }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 4 -->
                            <div class="col-xs-3 col-md-3 text-right">
                                <span class="glyphicon glyphicon-star"></span>3
                            </div>
                            <div class="col-xs-8 col-md-9">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20"
                                        aria-valuemin="0" aria-valuemax="100" style="width: {{ ($count_rate==0) ? 0 : ($_3sao/$count_rate)*100 }}%">
                                        <span class="sr-only star-only">{{ $_3sao }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 3 -->
                            <div class="col-xs-3 col-md-3 text-right">
                                <span class="glyphicon glyphicon-star"></span>2
                            </div>
                            <div class="col-xs-8 col-md-9">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20"
                                        aria-valuemin="0" aria-valuemax="100" style="width: {{ ($count_rate==0) ? 0 : ($_2sao/$count_rate)*100 }}%">
                                        <span class="sr-only star-only">{{ $_2sao }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 2 -->
                            <div class="col-xs-3 col-md-3 text-right">
                                <span class="glyphicon glyphicon-star"></span>1
                            </div>
                            <div class="col-xs-8 col-md-9">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80"
                                        aria-valuemin="0" aria-valuemax="100" style="width: {{ ($count_rate==0) ? 0 : ($_1sao/$count_rate)*100 }}%">
                                        <span class="sr-only star-only">{{ $_1sao }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 1 -->
                        </div>
                        <!-- end row -->
                    </div>
                </div>
                <hr>
                <div class="row">
	                <div class="col-md-12">
	                    <form accept-charset="UTF-8" action="{{ route('post.rating', $id_order) }}" method="post">
	                    	@csrf
	                    	<input type="text" name="title" class="form-control" placeholder="Tiêu đề đánh giá">
	                    	<br>
	                        <textarea class="form-control" cols="50" id="new-review" name="content" placeholder="Nhập đánh giá của bạn ở đây...." rows="5"></textarea>
	        
	                        <div class="text-right star-form">
	                        	<div class="star-rating">
									<span class="glyphicon glyphicon-star" data-rating="1"></span>
									<span class="glyphicon glyphicon-star" data-rating="2"></span>
									<span class="glyphicon glyphicon-star" data-rating="3"></span>
									<span class="glyphicon glyphicon-star-empty" data-rating="4"></span>
									<span class="glyphicon glyphicon-star-empty" data-rating="5"></span>
									<input name="star_rate" class="rating-value" value="3" type="hidden">
								</div>
	                            <div class="stars starrr" data-rating="3"></div>
	                            <button class="btn btn-success btn-lg" type="submit">Đánh giá</button>
	                        </div>
	                    </form>
	                </div>
	            </div>
            </div>
        </div>
        <div class="col-md-6">
			<div class="review-block">
				@foreach ($list_rating as $key =>$item)
					<div class="row">
						<div class="col-sm-3">
							<img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded">
							<div class="review-block-name"><b>{{ $item->user_buy}}</b></div>
							<div class="review-block-date">{{ $item->created_at }}<br/>1 day ago</div>
						</div>
						<div class="col-sm-9">
							<div class="review-block-rate star-rating">
								@for($i = 1; $i <= 5; $i++)
	                        		@if($i <= $item->star_rate )
			                            <span class="glyphicon glyphicon-star"></span>
			                        @else
			                            <span class="glyphicon glyphicon-star-empty"></span>
			                        @endif
	                            @endfor
							</div>
							<div class="review-block-title">{{ $item->title }}</div>
							<div class="review-block-description">{{ $item->content }}</div>
						</div>
					</div>
					<hr>
				@endforeach
			</div>
		</div>
    </div>
@endsection
@section('script')
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script>
		$(function(){
	    	var $star_rating = $('.star-form .star-rating .glyphicon');

			var SetRatingStar = function() {
			  return $star_rating.each(function() {
			    if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
			      return $(this).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
			    } else {
			      return $(this).removeClass('glyphicon-star-empty').addClass('glyphicon-star-empty');
			    }
			  });
			};

			$star_rating.on('click', function() {
			  $star_rating.siblings('input.rating-value').val($(this).data('rating'));
			  return SetRatingStar();
			});

			SetRatingStar();

			var ratingsField = $('#ratings-hidden');

			$('.starrr').on('starrr:change', function(e, value){
				ratingsField.val(value);
			});
		});
    </script>
@endsection