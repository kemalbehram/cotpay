<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Order\OrderRepositoryInterface;

use Illuminate\Http\Request;
use App\Models\Backend\Order\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Cities;

use App\Exports\ExportOrder;
use App\Imports\ImportOrder;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\Exportable;

class ManagementTransactionController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    //Chi tiết đơn hàng
    public function getListOrderDetail($id)
    {
        $order = Order::find($id);
        $city_user = Cities::where('code', $order->user->city)->first()['name'];
        $district_user = Cities::where('code', $order->user->district)->first()['name'];
        $ward_user = Cities::where('code', $order->user->ward)->first()['name'];
        return view('Backend.Pages.Order_Detail', compact('order', 'city_user', 'district_user', 'ward_user'));
    }
    
    // lấy danh sách các đề nghị mua hàng theo thời gian
    public function getListProposalOrdersByDate(Request $Request)
    {
        $start = $Request->start."";
        $end = $Request->end."";

        $orders = Order::where('status', 1)
                        ->where('user_id_receiver',Auth::user()->id)
                        ->whereDate('created_at','>=',$start)
                        ->whereDate('created_at','<=',$end)
                        ->get();
        return response()->json([
            'orders' => $orders,
        ]);
    }

    // lấy danh sách đơn hàng theo thời gian
    public function getListOrdersByDate(Request $Request)
    {
        $start = $Request->start."";
        $end = $Request->end."";
        $sellBuy = $Request->sell_buy;

        $orders = $this->orderRepository->getAllOrderByDate($start, $end, $sellBuy);

        $request_deal = $this->orderRepository->countOrderByStatusAndDate($sellBuy, 1, $start, $end);

        $pending = $this->orderRepository->countOrderByStatusAndDate($sellBuy, 2, $start, $end);

        $received = $this->orderRepository->countOrderByStatusAndDate($sellBuy, 3, $start, $end);
        
        $canceled = $this->orderRepository->countOrderByStatusAndDate($sellBuy, 4, $start, $end);
        
        $re_receive = $this->orderRepository->countOrderByStatusAndDate($sellBuy, 5, $start, $end);

        $boom = $this->orderRepository->countOrderByStatusAndDate($sellBuy, 6, $start, $end);

        $re_received = $this->orderRepository->countOrderByStatusAndDate($sellBuy, 7, $start, $end);

        $delivery = $this->orderRepository->countOrderByStatusAndDate($sellBuy, 8, $start, $end);

        $payment_success = $this->orderRepository->countOrderByStatusAndDate( $sellBuy, 99, $start, $end);

        $declined = $this->orderRepository->countOrderByStatusAndDate($sellBuy, 10, $start, $end);

        return response()->json([
            'orders' => $orders,
            'request_deal' => $request_deal,
            'received' => $received,
            'delivery' => $delivery,
            'canceled' => $canceled,
            're_receive' => $re_receive,
            're_received' => $re_received,
            'boom' => $boom,
            'payment_success' => $payment_success,
            'pending' => $pending,
            'declined' => $declined,
        ]);
    }

    use Exportable;
    // xuất file excel
    public function export(Request $Request) 
    {
        $start = $Request->start."";
        $end = $Request->end."";
        $sell_buy = $Request->sell_buy;
        $sellBuyToString = ($sell_buy == 1) ? 'Sell' : 'Buy';
        $nameFile = "Order".$sellBuyToString."_".$start."_".$end."_".date('Hms');

        $export = new ExportOrder(Auth::user()->id, $start, $end, $sell_buy);
        Excel::store($export, $nameFile.'.xlsx');
        return "Xuất file thành công";
    }

    public function export2(Request $Request) 
    {
        $start = $Request->start."";
        $end = $Request->end."";
        $sellBuy = $Request->sellBuy;
        $month = date('m');
        $sellBuyToString = ($sellBuy == 1) ? 'Sell' : 'Buy';
        if($start != '' && $end != ''){
            $nameFile = "Order".$sellBuyToString."_".$start."_".$end."_".date('Hms');
            $export = new ExportOrder(Auth::user()->id, $start, $end, $sellBuy);
           
        }else{
          
            $nameFile = "Order".$sellBuyToString."_".$month."_".date('Hms');
            $export = new ExportOrder(Auth::user()->id, $month, $sellBuy);
            
        }
        return Excel::download($export, $nameFile.'.xlsx');
       
       
    }

    // nhập file excel
    public function import() 
    {
        // Excel::import(new ImportOrder, storage_path('test.xlsx'));
        $import = Excel::import(new ImportOrder, 'test.xlsx');

        // $import = Excel::import(new UserImport, request()->file('user_file'));

        return redirect()->back()->with('success', 'Nhập excel thành công')->withInput();
    }

}
