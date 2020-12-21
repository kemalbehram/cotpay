<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\User;
use App\Models\Backend\Order\Order;
use App\Models\Backend\Rating;

class RatingController extends Controller
{
    public function getRatingForm($id)
    {
        $order = Order::find($id);

        $user_rated_id = (Auth::user()->id == $order->user_id) ? $order->user_id_receiver : $order->user_id;

        $user_rated = User::find($user_rated_id);

        $data['id_order'] = $id;
        $data['count_rate'] = count(Rating::where('user_host', $user_rated_id)->get());
        $data['_1sao'] = count(Rating::where('user_host', $user_rated_id)->where('star_rate',1)->get());
        $data['_2sao'] = count(Rating::where('user_host', $user_rated_id)->where('star_rate',2)->get());
        $data['_3sao'] = count(Rating::where('user_host', $user_rated_id)->where('star_rate',3)->get());
        $data['_4sao'] = count(Rating::where('user_host', $user_rated_id)->where('star_rate',4)->get());
        $data['_5sao'] = count(Rating::where('user_host', $user_rated_id)->where('star_rate',5)->get());
        $data['list_rating'] = Rating::where('user_host', $user_rated_id)->orderBy('star_rate', 'desc')->orderBy('created_at', 'desc')->paginate(6);

        $data['star_rate'] = $user_rated->star_rate;
        $data['name_rated'] = $user_rated->name_user;

        return view('Backend.Pages.FormRating', $data);
    }    

    public function postRatingForm(Request $Request, $id_order)
    {
        $title = $Request->title;
        $star_rate = $Request->star_rate;
        $content = $Request->content;
        
        $order = Order::find($id_order);

        $rating = new Rating;
        $rating->title = $title;
        $rating->star_rate = $star_rate;
        $rating->content = $content;
        $rating->id_order = $id_order;

        if (Auth::user()->id == $order->user_id) {
            $rating->user_host = $order->user_id_receiver;
            $rating->user_comment = $order->user_id;
            $rating->save();
            $rate = Rating::where('user_host', $order->user_id_receiver)->get();
            $user_host = User::find($order->user_id_receiver);
        } else {
            $rating->user_host = $order->user_id;
            $rating->user_comment = $order->user_id_receiver;
            $rating->save();
            $rate = Rating::where('user_host', $order->user_id)->get();
            $user_host = User::find($order->user_id);
        }
        $rating->save();

        // tính số sao trung bình 
        $total = 0;
        foreach ($rate as $value) {
            $total += $value->star_rate;
        }
        (count($rate)==0) ? $user_host->star_rate = $star_rate : $user_host->star_rate = $total/count($rate);
        $user_host->save();
        //_____________________________

        switch (User::find(Auth::id())->level) {
            case 1:
                $url = route('customer.index');
                break;
            case 2:
                $url = route('merchant.index');
                break;
            case 2:
                $url = route('business.index');
                break;
            default:
                $url = route('index');
                break;
        }
        
        return redirect($url)->with('success', 'Đánh giá thành công! ')->withInput();
    }
}
