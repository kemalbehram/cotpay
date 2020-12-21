<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;



//-----------------------------------------------begin frontend------------------------------------------------------

Route::get('/set-lang/{lang}', function ($lang) {
    \Session::put('locale', $lang);
    return redirect()->back();
})->name('set.lang');

// Route::get('/', function () {
//     return view('Frontend.Pages.Home');
// })->name('index');
Route::get('/','Frontend\PageController@index')->name('index');
Route::post('search','Frontend\PageController@search')->name('search.action');

//------ đăng kí tài khoản
Route::group(['prefix' => 'register'], function () {
    Route::get('/', 'Frontend\PageController@getAccountSteps')->name('register');

    Route::get('customer', 'Frontend\PageController@getCustomerAccount')->name('register.customer.get');
    Route::post('customer', 'Frontend\PageController@postCustomerAccount')->name('register.customer.post');

    Route::get('merchant', 'Frontend\PageController@getMerchantAccount')->name('register.merchant.get');
    Route::post('merchant', 'Frontend\PageController@postMerchantAccount')->name('register.merchant.post');

    Route::get('business', 'Frontend\PageController@getBusinessAccount')->name('register.business.get');
    Route::post('business', 'Frontend\PageController@postBusinessAccount')->name('register.business.post');
});


//---xác nhận tài khoản-----------
Route::get('verify_account', 'Backend\AccountController@getVerifyAccount')->name('get.verify.account');

//-----quên mật khẩu-----
Route::post('forgot-passwor', 'Backend\AccountController@postForgotPasswordUser')->name('post.forgot.password.user');
Route::get('password/reset', 'Backend\AccountController@resetPassword')->name('link.reset.password');
Route::post('password/reset', 'Backend\AccountController@postResetPassword')->name('post.reset.password');




//---------login--------------------
Route::get('login', 'Backend\LoginController@getLogin')->name('get.login')->middleware('CheckLogout');
Route::post('login', 'Backend\LoginController@postLogin')->name('post.login');




Route::get('/contact', function () {
    return view('Frontend.Pages.Contact');
});

Route::get('/about','Frontend\AboutController@show' );


Route::get('contact','Frontend\PageController@getContact')->name('get.contact');
Route::post('contact','Frontend\PageController@postContact')->name('post.contact');


// load quan huyen
Route::get('ajax', 'Frontend\PageController@getLocation')->name('ajax_get.location');
//----------------------------------------------end frontend------------------------------------------------------






//-------------------------------------------------begin backend-----------------------------------------------

Route::group(['prefix' => 'pages', 'middleware' => 'CheckLogin'], function () {

    //đăng xuất
    Route::get('logout','Backend\LoginController@getLogOut')->name('get.logout');

    //thông tin tài khoản
    Route::get('info/{id}', 'Backend\AccountController@getInfoAccount')->name('get.info.account');
    Route::post('info/{id}', 'Backend\AccountController@postInfoAccount')->name('post.info.account');



    //tìm khách hàng khi tạo đơn
    Route::post('search-user', 'Backend\TransactionPriceController@postSearchUser')->name('search_user');
    //tính phí cot khi tạo đơn
    Route::post('price-cot', 'Backend\TransactionPriceController@postPriceCot')->name('price.cot');
    //tính cước chuyển phát khi nhập trọng lương
    Route::post('price-ship-fee', 'Backend\TransactionPriceController@postPriceShipFee')->name('price.ship.fee');
    //tính cước khi chọn dịch vụ
    Route::post('price-service', 'Backend\TransactionPriceController@postPriceService')->name('price.service');

    //Chi tiết đơn hàng
    Route::get('order-detail/{id}', 'Backend\ManagementTransactionController@getListOrderDetail')->name('order.detail');


    //đổi mật khẩu
    Route::get('change-password', 'Backend\AccountController@getChangePassword')->name('get.change.password');
    Route::post('change-password', 'Backend\AccountController@postChangePassword')->name('post.change.password');

    // xác nhận đơn hàng
    Route::get('verify-order-sell/{id}', 'Backend\PurchaseProposalController@verifyOrder')->name('verify.order');
    // từ chối đơn hàng
    Route::get('refuse-order-sell/{id}', 'Backend\PurchaseProposalController@refuseOrder')->name('refuse.order');

    //-----Các đơn hàng theo trạng thái------
    Route::post('order_by_status','Backend\StatusController@getOrderByStatus')->name('order.by.status');
    //----các đề nghị mua hàng theo ngày tháng
    Route::post('proposal_by_date', "Backend\ManagementTransactionController@getListProposalOrdersByDate")->name('order.proposal.date');
    //----các giao dịch theo ngày tháng
    Route::post('orders_by_date', "Backend\ManagementTransactionController@getListOrdersByDate")->name('orders.by.date');
    
    // giao dịch đã xác nhận theo ngày tháng 
    // Route::post('confirmed_date','Backend\ManagementTransactionController@getListComfirmedOrdersByDate')->name('order.confirmed.date');
    // Route::post('confirmed_by_status','Backend\StatusController@getConfirmedOrderByStatus')->name('order.confirmed.by.status');

    // nút hủy đơn
    Route::get('cancel_order/{id}','Backend\StatusController@canceledOrder')->name('button.order.canceled');
    // nut đồng ý nhận lại đơn
    Route::get('agree_re_receive{id}','Backend\StatusController@agreeReReceive')->name('button.order.agree_re_receive');
    // nút yêu cầu thanh toán
    Route::get('request_pay_order/{id}','Backend\StatusController@requestPay')->name('button.order.request_pay');
    // nút đề nghị hoàn đơn
    Route::get('request_return_order/{id}','Backend\StatusController@requestReturnOrder')->name('button.status.request_return_order');
    // nút đề nghị hoàn tiền
    Route::get('request_return_money/{id}','Backend\StatusController@requestReturnMoney')->name('button.status.request_return_money');
    // nút thanh toán
    Route::get('payment_order/{id}', 'Backend\StatusController@paymentOrder')->name('button.status.payment');

    //xuất file excel 
    Route::post('export_excel', 'Backend\ManagementTransactionController@export')->name('order.export.excel');
    //xuất file excel 
    Route::post('export_excel2', 'Backend\ManagementTransactionController@export2')->name('order.export.excel2');
    //xuất file excel 
    Route::get('import_excel', 'Backend\ManagementTransactionController@import')->name('order.import.excel');

    //Form đánh giá ng ban
    Route::get('rating/{id_order}', 'Backend\RatingController@getRatingorder.export.excelorm')->name('get.rating');
    Route::post('rating/{id_order}', 'Backend\RatingController@postRatingForm')->name('post.rating');

    //--------------------shop--------------------------------

    Route::group(['prefix'=>'merchant'], function (){

        Route::get('/','Backend\Merchant\MerchantController@getIndexMerchant')->name('merchant.index');

        //-----các đề nghị mua hàng---------------
        Route::get('shopping_proposal', 'Backend\Merchant\PurchaseProposalController@getListProposal')->name('merchant.shopping.proposal');

        //-----tạo giao dịch bán------------
        Route::get('sell', 'Backend\Merchant\TransactionController@getMerchantSell')->name('merchant.sell');
        Route::post('sell', 'Backend\Merchant\TransactionController@postMerchantSell')->name('post.merchant.sell');

        //------tạo giao dịch mua-----------
        Route::get('buy','Backend\Merchant\TransactionController@getMerchantBuy')->name('merchant.buy');
        Route::post('buy','Backend\Merchant\TransactionController@postMerchantBuy')->name('post.merchant.buy');

        //----quản lý giao dịch bán---
        Route::get('management-sell','Backend\Merchant\ManagementTransactionController@getListOrderSell')->name('merchant.management.sell');

        //----quản lý giao dịch mua---
        Route::get('management-buy', 'Backend\Merchant\ManagementTransactionController@getListOrderBuy')->name('merchant.management.buy');

        //-----quản lý nạp tiền bonus----
        Route::get('recharge','Backend\Merchant\ManagementMoneyController@getRecharge')->name('merchant.recharge');
        Route::post('recharge','Backend\Merchant\ManagementMoneyController@postRecharge')->name('post.merchant.recharge');

        //-----quản lý rút tiền bonus----
        Route::get('withdraw', function (){
            return view('Backend.Merchant.Withdraw');
        })->name('merchant.withdraw');


    });

//--------------------end shop--------------------------------



//--------------------------begin customer-------------------------

    Route::group(['prefix' => 'customer'], function () {

        Route::get('/','Backend\Customer\CustomerController@getIndexCustomer')->name('customer.index');

        //-----các đề nghị mua hàng---------------
        Route::get('shopping_proposal', 'Backend\Customer\PurchaseProposalController@getListProposal')->name('customer.shopping.proposal');

        //---tạo giao dịch bán----
        Route::get('sell','Backend\Customer\TransactionController@getCustomerSell' )->name('customer.sell');
        Route::post('sell','Backend\Customer\TransactionController@postCustomerSell' )->name('post.customer.sell');

        //----tạo giao dịch mmua----
        Route::get('buy', 'Backend\Customer\TransactionController@getCustomerBuy')->name('customer.buy');
        Route::post('buy', 'Backend\Customer\TransactionController@postCustomerBuy')->name('post.customer.buy');

        //---quản lý giao dịch mua---
        Route::get('management-buy','Backend\Customer\ManagementTransactionController@getListOrderBuy')->name('customer.management.buy');

        //---quản lý giao dịch bán---
        Route::get('management-sell','Backend\Customer\ManagementTransactionController@getListOrderSell')->name('customer.management.sell');
        
        //---nạp tiền ví bonus------
        Route::get('recharge', function (){
            return view('Backend.Customer.Recharge');
        })->name('customer.recharge');

        //---rút tiền ví bonus------
        Route::get('withdraw', function (){
            return view('Backend.Customer.Withdraw');
        })->name('customer.withdraw');

    });

//--------------------------end user-------------------



//----------------------begin bussiness------------------

    Route::group(['prefix' => 'business'], function () {

        Route::get('/','Backend\Business\BusinessController@getIndexBusiness')->name('business.index');

        //-----các đề nghị mua hàng---------------
        Route::get('shopping_proposal', 'Backend\Business\PurchaseProposalController@getListProposal')->name('business.shopping.proposal');

        //----quản lý giao dịch bán---
        Route::get('management-sell','Backend\Business\ManagementTransactionController@getListOrderSell')->name('business.management.sell');
        //----quản lý giao dịch mua---
        Route::get('management-buy', 'Backend\Business\ManagementTransactionController@order.proposal.dateBuy')->name('business.management.buy');

        //---tạo giao dịch bán----
        Route::get('sell','Backend\Business\TransactionController@getBusinessSell' )->name('business.sell');
        Route::post('sell','Backend\Business\TransactionController@postBusinessSell' )->name('post.business.sell');

        //----tạo giao dịch mmua----
        Route::get('buy', 'Backend\Business\TransactionController@getBusinessBuy')->name('business.buy');
        Route::post('buy', 'Backend\Business\TransactionController@postBusinessBuy')->name('post.business.buy');

        //---nạp tiền ví bonus------
        Route::get('recharge', function (){
            return view('Backend.Business.Recharge');
        })->name('business.recharge');

        //---rút tiền ví bonus------
        Route::get('withdraw', function (){
            return view('Backend.Business.Withdraw');
        })->name('business.withdraw');

    });

});
//--------------------------end bussiness-------------------



//-------------------------------begin admin ----------------------------




//quên mật khẩu admin
Route::get('forgot-password','Backend\Admin\ForgotPasswordController@getFogotPassword')->name('get.forgot.password');
Route::post('forgot-password','Backend\Admin\ForgotPasswordController@postFogotPassword')->name('post.forgot.password');

Route::get('password-reset', 'Backend\Admin\ForgotPasswordController@resetPasswordAdmin')->name('link.reset.password.admin');
Route::post('password-reset', 'Backend\Admin\ForgotPasswordController@postResetPasswordAdmin')->name('post.reset.password.admin');


//đăng nhập
Route::get('login-admin','Backend\Admin\LoginController@getLoginAdmin')->middleware('CheckLogoutAdmin')->name('get.login.admin');
Route::post('login-admin','Backend\Admin\LoginController@postLoginAdmin')->name('post.login.admin');

Route::group(['prefix' => 'admin', 'middleware' => 'CheckLoginAdmin'], function () {

    Route::get('','Backend\Admin\IndexController@getIndex')->name('index.admin');

    // ví bonus
    Route::get('bonus','Backend\Admin\IndexController@getBonus')->name('get.bonus')->middleware('auth:admin' ,'permission:C15');

    //quản lý ví
    Route::group(['prefix' => 'wallet', 'middleware' => ['auth:admin' ,'permission:C16']], function() {
        //
        Route::get('wallet','Backend\Admin\WalletController@getWallet')->name('get.wallet');
        Route::get('getLockWallet/{id}','Backend\Admin\WalletController@getLockWallet')->name('get.lock.wallet');
        Route::get('getUnlockWallet/{id}','Backend\Admin\WalletController@getUnlockWallet')->name('get.unlock.wallet');
    });
    //Quản lý đơn vị giao nhận
    Route::get('ship','Backend\Admin\DeliveryUnitController@getDeliveryUnit')->name('get.delivery.unit');
    Route::get('getLockShip/{id}','Backend\Admin\DeliveryUnitController@getLockShip')->name('get.lock.ship');
    Route::get('getUnlockShip/{id}','Backend\Admin\DeliveryUnitController@getUnlockShip')->name('get.unlock.ship');
    

    // Đơn hàng vận chuyển
    Route::get('order','Backend\Admin\OrderController@getOrder')->name('admin.get.order');
    // nút khách nhận đơn
    Route::get('receive_order/{id}','Backend\Admin\OrderController@receiveOrder')->name('admin.order.receive');
    // nút bom hàng
    Route::get('boom_order/{id}','Backend\Admin\OrderController@bomOrder')->name('admin.order.boom');
    // nút hoàn đơn
    Route::get('return_order/{id}','Backend\Admin\OrderController@returnOrder')->name('admin.order.re_order');
    // nút ship nhận hàng từ shop
    Route::get('users/{id}', 'Backend\Admin\OrderController@deliveryOrder')->name('admin.order.delivery');


    // đăng xuất
    Route::get('logout','Backend\Admin\LoginController@getLogoutAdmin')->name('get.logout.admin');

    //đổi mật khẩu
    Route::get('change-password','Backend\Admin\LoginController@getChangePassword')->name('get.changer.password.admin');
    Route::post('change-password','Backend\Admin\LoginController@postChangePassword')->name('post.changer.password.admin');

    //phân quyền
    Route::group(['prefix' => 'role', 'middleware' => ['auth:admin' ,'role:supper-admin']], function () {
         //danh sách roles
        Route::get('','Backend\Admin\PermissionController@getListRole')->name('get.list.role');
        // thêm role
        Route::get('add','Backend\Admin\PermissionController@getAddRole')->name('get.add.role');
        Route::post('add','Backend\Admin\PermissionController@postAddRole')->name('post.add.role');
        //Sửa vai trò
        Route::get('edit/{id}','Backend\Admin\PermissionController@getEditRole')->name('get.edit.role');
        Route::post('edit/{id}','Backend\Admin\PermissionController@postEditRole')->name('get.post.role');
        //xóa vai trò
        Route::get('delete/{id}','Backend\Admin\PermissionController@deleteRole')->name('del.role');

    });
    // About
    Route::get('about','Backend\About\AboutController@getAbout' );
    Route::get('about/edit/{id}','Backend\About\AboutController@getedit' );
    Route::post('about/edit/{id}','Backend\About\AboutController@postedit' );

    //Liên hệ
    route::get('list-contact','Backend\Admin\ContactController@getlistContact')->name('list.contact');
    route::get('process/{id}','Backend\Admin\ContactController@postlistContact')->name('post.list.contact');
    route::get('list-processed','Backend\Admin\ContactController@listprocessed')->name('list.processed.contact');

    //Quản lý giao dịch
    route::get('list-deal-than-10t','Backend\Admin\DealManagerController@getlistThan')->name('list.deal.than.10t')->middleware('auth:admin' ,'permission:C13|C00');
    route::get('list-deal-under-10t','Backend\Admin\DealManagerController@getlistUnder')->name('list.deal.under.10t')->middleware('auth:admin' ,'permission:C12|C00');
    route::get('list-detail/{id}','Backend\Admin\DealManagerController@getlistDetail')->name('list.detail');
    route::get('list-wallet','Backend\Admin\DealManagerController@listWallet')->name('list.wallet');
    route::get('list-business','Backend\Admin\DealManagerController@listBusiness')->name('list.business')->middleware('auth:admin' ,'permission:C14|C00');


    //tài khoản admin
    Route::group(['prefix' => 'account'], function () {

        //danh sách tài khoản customer
        Route::get('customer','Backend\Admin\AccountController@getListAccountCustomer')->name('list.account.customer')->middleware('auth:admin' ,'permission:C11');
        //danh sách tài khoản merchant
        Route::get('merchant','Backend\Admin\AccountController@getListAccountMerchant')->name('list.account.merchant')->middleware('auth:admin' ,'permission:C11');
        //danh sách tài khoản business
        Route::get('business','Backend\Admin\AccountController@getListAccountBusiness')->name('list.account.business')->middleware('auth:admin' ,'permission:C11');
        //khóa tài khoản người dùng
        Route::get('lock-account/{id}','Backend\Admin\AccountController@getLockAccountUser')->name('lock.account.user')->middleware('auth:admin' ,'permission:C11');
        //mở khóa tài khoản người dùng
        Route::get('unlock-account/{id}','Backend\Admin\AccountController@getUnlockAccountUser')->name('unlock.account.user')->middleware('auth:admin' ,'permission:C11');

        //danh sách tài khoản admin
        Route::get('','Backend\Admin\AccountController@getListAccount')->name('list.account.admin')->middleware('auth:admin' ,'role_or_permission:supper-admin|C18');
        //thêm tài khoản admin
        Route::get('add','Backend\Admin\AccountController@getAddAccountAdmin')->name('get.add.account.admin')->middleware('auth:admin' ,'role:supper-admin');
        Route::post('add','Backend\Admin\AccountController@postAddAccountAdmin')->name('post.add.account.admin')->middleware('auth:admin' ,'role:supper-admin');
        //sửa tài khoản admin
        Route::get('edit/{id}','Backend\Admin\AccountController@getEditAccountAdmin')->name('get.edit.account.admin')->middleware('auth:admin' ,'role:supper-admin');
        Route::post('edit/{id}','Backend\Admin\AccountController@postEditAccountAdmin')->name('get.post.account.admin')->middleware('auth:admin' ,'role:supper-admin');
        //xóa tài khoản admin
        Route::get('delete/{id}','Backend\Admin\AccountController@getDeleteAccountAdmin')->name('get.delete.account.admin')->middleware('auth:admin' ,'role:supper-admin');
    });

    //thông tin tài khoản
    Route::get('info/{id}','Backend\Admin\AccountController@getInfoAccountAdmin')->name('info.account.admin');
    Route::post('info/{id}','Backend\Admin\AccountController@postInfoAccountAdmin')->name('post.info.account.admin');




});


//--------------------------------end admin -----------------------------
