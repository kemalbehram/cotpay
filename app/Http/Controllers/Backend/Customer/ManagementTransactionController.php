<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\Controller;
use App\Repositories\Order\OrderRepositoryInterface;

use App\Models\Backend\Rating;

class ManagementTransactionController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    //danh sách tất cả đơn hàng đơn hàng bán
    function getListOrderSell(){
        $data['orders'] = $this->orderRepository->getListOrder(1);
        
        $data['status_request_deal'] = $this->orderRepository->countOrderByStatus(1,1);

        $data['status_pending'] = $this->orderRepository->countOrderByStatus(2,1);

        $data['status_received'] = $this->orderRepository->countOrderByStatus(3,1);

        $data['status_cenceled'] = $this->orderRepository->countOrderByStatus(4,1);

        $data['status_re_receive'] = $this->orderRepository->countOrderByStatus(5,1);

        $data['status_boom'] = $this->orderRepository->countOrderByStatus(6,1);

        $data['status_re_received'] = $this->orderRepository->countOrderByStatus(7,1);

        $data['status_delivery'] = $this->orderRepository->countOrderByStatus(8,1);

        $data['status_declined'] = $this->orderRepository->countOrderByStatus(10,1);

        $data['status_payment_success'] = $this->orderRepository->countOrderByStatus(99,1);

        $data['rating'] = Rating::all();

        return view('Backend.Customer.Management-Sell',$data);
    }

    // danh sách tất cả đơn hàng mua
    public function getListOrderBuy()
    {
       $data['orders'] = $this->orderRepository->getListOrder(2);
        
        $data['status_request_deal'] = $this->orderRepository->countOrderByStatus(1,2);

        $data['status_pending'] = $this->orderRepository->countOrderByStatus(2,2);

        $data['status_received'] = $this->orderRepository->countOrderByStatus(3,2);

        $data['status_cenceled'] = $this->orderRepository->countOrderByStatus(4,2);

        $data['status_re_receive'] = $this->orderRepository->countOrderByStatus(5,2);

        $data['status_boom'] = $this->orderRepository->countOrderByStatus(6,2);

        $data['status_re_received'] = $this->orderRepository->countOrderByStatus(7,2);

        $data['status_delivery'] = $this->orderRepository->countOrderByStatus(8,2);

        $data['status_declined'] = $this->orderRepository->countOrderByStatus(10,2);

        $data['status_payment_success'] = $this->orderRepository->countOrderByStatus(99,2);

        $data['rating'] = Rating::all();

        return view('Backend.Customer.Management-Buy', $data);
    }
}
