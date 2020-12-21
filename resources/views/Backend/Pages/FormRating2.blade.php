<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Đánh giá</title>

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    	body {
			padding-top: 70px;
		}
		textarea {
			resize: vertical; /* user can resize vertically, but width is fixed */
		}
		.review-block{
			background-color:#FAFAFA;
			border:1px solid #EFEFEF;
			padding:15px;
			border-radius:3px;
			margin-bottom:15px;
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
		
		.glyphicon { 
			margin-right:5px;
		}
		.rating .glyphicon {
			color:orange;
			font-size: 22px;
		}
		.rating-num { 
			margin-top:0px;
			font-size: 54px; 
		}
		.progress { margin-bottom: 5px;}
		.progress-bar { text-align: left; }
		.rating-desc .col-md-3 {padding-right: 0px;}
		.sr-only { margin-left: 5px;overflow: visible;clip: auto; }
    </style>
  </head>

  <body>
    <div class="container">
    			
		<div class="row">
	        <div class="col-xs-12 col-md-6">
	            <div class="well well-sm">
	                <div class="row">
	                    <div class="col-xs-12 col-md-6 text-center">
	                    	<h5>Đánh giá {{ $name_buy }}</h5>
	                        <h1 class="rating-num">
	                            {{ $star_rate }}</h1>
	                        <div class="rating">
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
	                                        <span class="sr-only">{{ $_5sao }}</span>
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
	                                        <span class="sr-only">{{ $_4sao }}</span>
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
	                                        <span class="sr-only">{{ $_3sao }}</span>
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
	                                        <span class="sr-only">{{ $_2sao }}</span>
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
	                                        <span class="sr-only">{{ $_1sao }}</span>
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
		                    <form accept-charset="UTF-8" action="{{ route('post.rating.sell', $id_order) }}" method="post">
		                    	@csrf
		                    	<input type="text" name="title" class="form-control" placeholder="Tiêu đề đánh giá">
		                    	<br>
		                        <input id="ratings-hidden" name="star_rate" type="hidden" value="3" required> 
		                        <textarea class="form-control" cols="50" id="new-review" name="content" placeholder="Nhập dánh giá của bạn ở đây...." rows="5"></textarea>
		        
		                        <div class="text-right">
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
								<div class="review-block-rate rating">
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
    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript">
    	(function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);

	var __slice=[].slice;(function(e,t){var n;n=function(){function t(t,n){var r,i,s,o=this;this.options=e.extend({},this.defaults,n);this.$el=t;s=this.defaults;for(r in s){i=s[r];if(this.$el.data(r)!=null){this.options[r]=this.$el.data(r)}}this.createStars();this.syncRating();this.$el.on("mouseover.starrr","span",function(e){return o.syncRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("mouseout.starrr",function(){return o.syncRating()});this.$el.on("click.starrr","span",function(e){return o.setRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("starrr:change",this.options.change)}t.prototype.defaults={rating:void 0,numStars:5,change:function(e,t){}};t.prototype.createStars=function(){var e,t,n;n=[];for(e=1,t=this.options.numStars;1<=t?e<=t:e>=t;1<=t?e++:e--){n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))}return n};t.prototype.setRating=function(e){if(this.options.rating===e){e=void 0}this.options.rating=e;this.syncRating();return this.$el.trigger("starrr:change",e)};t.prototype.syncRating=function(e){var t,n,r,i;e||(e=this.options.rating);if(e){for(t=n=0,i=e-1;0<=i?n<=i:n>=i;t=0<=i?++n:--n){this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")}}if(e&&e<5){for(t=r=e;e<=4?r<=4:r>=4;t=e<=4?++r:--r){this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")}}if(!e){return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")}};return t}();return e.fn.extend({starrr:function(){var t,r;r=arguments[0],t=2<=arguments.length?__slice.call(arguments,1):[];return this.each(function(){var i;i=e(this).data("star-rating");if(!i){e(this).data("star-rating",i=new n(e(this),r))}if(typeof r==="string"){return i[r].apply(i,t)}})}})})(window.jQuery,window);$(function(){return $(".starrr").starrr()})

	$(function(){

		$('#new-review').autosize({append: "\n"});

		var newReview = $('#new-review');
		var ratingsField = $('#ratings-hidden');

		$('.starrr').on('starrr:change', function(e, value){
			ratingsField.val(value);
		});
	});
    </script>
  </body>
</html>
