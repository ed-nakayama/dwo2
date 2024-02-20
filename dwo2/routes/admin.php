<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;

/*************************
* 商品系
**************************/
use App\Http\Controllers\Admin\Product\ProductList;
use App\Http\Controllers\Admin\Product\ProductBig;
use App\Http\Controllers\Admin\Product\ProductMiddle;
use App\Http\Controllers\Admin\Product\ProductCategory;
use App\Http\Controllers\Admin\Product\ProductStatus;
use App\Http\Controllers\Admin\Product\ProductPrice;

/*************************
* 得意先系
**************************/
use App\Http\Controllers\Admin\Cust\CustList;

/*************************
* オーダー系
**************************/
use App\Http\Controllers\Admin\Order\OrderDelivery;
use App\Http\Controllers\Admin\Order\OrderStatus;
use App\Http\Controllers\Admin\Order\OrderList2;
use App\Http\Controllers\Admin\Order\OrderSearchHistory;
use App\Http\Controllers\Admin\Order\OrderList;

use App\Http\Controllers\Weborder\Order\OrderPrintview;
use App\Http\Controllers\Weborder\Order\OrderUpgradeprint;

/*************************
* 郵便番号系
**************************/
use App\Http\Controllers\Admin\Zipdata\ZipdataUpdate;

/*************************
* バッチ系
**************************/
use App\Http\Controllers\Admin\Batch\BatchConf;

/*************************
* テスト系
**************************/
use App\Http\Controllers\Admin\Test\TestShipping;

/*************************
* お知らせ系
**************************/
use App\Http\Controllers\Admin\Info;

/*************************
* 管理者系
**************************/
use App\Http\Controllers\Admin\Operator\OperatorDetail;


/*********************************************************************************
* 認証前
*********************************************************************************/
/*************************
* ルート　ログイン
**************************/
Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');


/*************************
* 基本
**************************/
//Route::get ('/register', [RegisteredUserController::class, 'create'])->name('register');
//Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get ('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// パスワード忘れ
Route::get ('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

Route::get ('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.store');

Route::get('/verify-email', EmailVerificationPromptController::class)->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('auth', 'throttle:6,1')
                ->name('verification.send');

Route::get ('/confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']);

Route::put('password', [PasswordController::class, 'update'])->name('password.update');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


// リモートバッチ
Route::get('/closing',  [BatchConf::class, 'closing']);


/*********************************************************************************
* 認証済
*********************************************************************************/
Route::middleware('auth:admin')->group(function () {

	/*************************
	* パスワード変更
	**************************/
//	Route::get('/password/edit', [PasswordController::class, 'edit'])->name('password.edit');

	Route::get ('/password/edit', function () { 
		return view('admin.password.edit');
	})->name('password.edit');

	Route::post('/password/update', [PasswordController::class, 'updatePassword'])->name('password.update');

	/*************************
	* 商品サブマスタ
	**************************/
	Route::get('/product/list', [ProductList::class, 'index'])->name('product.list');

	Route::get ('/product/list/search', [ProductList::class, 'search_list'])->name('product.list.search');
	Route::post('/product/list/search', [ProductList::class, 'search_list']);

	Route::get ('/product/list/store', [ProductList::class, 'store'])->name('product.list.store');
	Route::post('/product/list/store', [ProductList::class, 'store']);

	Route::get('/product/price', [ProductPrice::class, 'index'])->name('product.price');

	Route::get ('/product/price/regist', [ProductPrice::class, 'regist'])->name('product.price.regist');
	Route::post('/product/price/regist', [ProductPrice::class, 'regist']);

	Route::get ('/product/price/store', [ProductPrice::class, 'store'])->name('product.price.store');
	Route::post('/product/price/store', [ProductPrice::class, 'store']);


	/*************************
	* 商品大分類マスタ
	**************************/
	Route::get('/product/big', [ProductBig::class, 'index'])->name('product.big');

	Route::get ('/product/big/regist', [ProductBig::class, 'regist'])->name('product.big.regist');
	Route::post('/product/big/regist', [ProductBig::class, 'regist']);

	Route::get ('/product/big/search', [ProductBig::class, 'search'])->name('product.big.search');
	Route::post('/product/big/search', [ProductBig::class, 'search']);

	Route::get ('/product/big/store', [ProductBig::class, 'store'])->name('product.big.store');
	Route::post('/product/big/store', [ProductBig::class, 'store']);


	/*************************
	* 商品中分類マスタ
	**************************/
	Route::get('/product/middle', [ProductMiddle::class, 'index'])->name('product.middle');

	Route::get ('/product/middle/regist', [ProductMiddle::class, 'regist'])->name('product.middle.regist');
	Route::post('/product/middle/regist', [ProductMiddle::class, 'regist']);

	Route::get ('/product/middle/search', [ProductMiddle::class, 'search'])->name('product.middle.search');
	Route::post('/product/middle/search', [ProductMiddle::class, 'search']);

	Route::get ('/product/middle/store', [ProductMiddle::class, 'store'])->name('product.middle.store');
	Route::post('/product/middle/store', [ProductMiddle::class, 'store']);


	/*************************
	* 商品分類登録マスタ
	**************************/
	Route::get('/product/category/list', [ProductCategory::class, 'index'])->name('product.category.list');

	Route::get ('/product/category', [ProductCategory::class, 'detail'])->name('product.category');
	Route::post('/product/category', [ProductCategory::class, 'detail']);

	Route::get ('/product/category/regist', [ProductCategory::class, 'regist'])->name('product.category.regist');
	Route::post('/product/category/regist', [ProductCategory::class, 'regist']);

	Route::get ('/product/category/store', [ProductCategory::class, 'store'])->name('product.category.store');
	Route::post('/product/category/store', [ProductCategory::class, 'store']);


	/*************************
	* 商品ステータスマスタ
	**************************/
	Route::get('/product/status', [ProductStatus::class, 'index'])->name('product.status');

	Route::get ('/product/status/regist', [ProductStatus::class, 'regist'])->name('product.status.regist');
	Route::post('/product/status/regist', [ProductStatus::class, 'regist']);

	Route::get ('/product/status/store', [ProductStatus::class, 'store'])->name('product.status.store');
	Route::post('/product/status/store', [ProductStatus::class, 'store']);


	/*************************
	* 得意先サブマスタ
	**************************/
	Route::get('/cust/list', [CustList::class, 'findNew'])->name('cust.list');

	Route::get ('/cust/search', [CustList::class, 'findList'])->name('cust.search');
	Route::post('/cust/search', [CustList::class, 'findList']);

	Route::get ('/cust/detail', [CustList::class, 'find'])->name('cust.detail');
	Route::post('/cust/detail', [CustList::class, 'find']);

	Route::get ('/cust/detail/store', [CustList::class, 'store'])->name('cust.detail.store');
	Route::post('/cust/detail/store', [CustList::class, 'store']);


	/*************************
	* 管理ユーザマスタ
	**************************/
	Route::get('/operator/detail', [OperatorDetail::class, 'index'])->name('operator.list');

	Route::get ('/operator/detail/regist', [OperatorDetail::class, 'regist'])->name('operator.store');
	Route::post('/operator/detail/regist', [OperatorDetail::class, 'regist']);

	Route::get ('/operator/detail/store', [OperatorDetail::class, 'store'])->name('operator.store');
	Route::post('/operator/detail/store', [OperatorDetail::class, 'store']);


	/*************************
	* 納品先マスタ
	**************************/
	Route::get ('/order/delivery/list', function () { 
		return view('admin.order.deliveryList');
	})->name('order.deliveryList');

	Route::get ('/order/delivery/search', [OrderDelivery::class, 'search'])->name('order_delivery.search');
	Route::post('/order/delivery/search', [OrderDelivery::class, 'search']);

	Route::get ('/order/delivery/store', [OrderDelivery::class, 'store'])->name('order_delivery.store');
	Route::post('/order/delivery/store', [OrderDelivery::class, 'store']);


	/*************************
	* 受注ステータスマスタ
	**************************/
	Route::get('/order/status', [OrderStatus::class, 'index'])->name('order.status');

	Route::get ('/order/status/regist', [OrderStatus::class, 'regist'])->name('order.status.regist');
	Route::post('/order/status/regist', [OrderStatus::class, 'regist']);

	Route::get ('/order/status/store', [OrderStatus::class, 'store'])->name('order.status.store');
	Route::post('/order/status/store', [OrderStatus::class, 'store']);


	/*************************
	* 受付編集
	**************************/
	Route::get ('/order/list2', [OrderList2::class, 'index'])->name('.order.list2');
	Route::post('/order/list2', [OrderList2::class, 'index']);

	Route::get ('/order/list2/detail', [OrderList2::class, 'detail'])->name('order.list2.detail');
	Route::post('/order/list2/detail', [OrderList2::class, 'detail']);

	Route::get ('/order/list2/store', [OrderList2::class, 'store'])->name('order.list2.store');
	Route::post('/order/list2/store', [OrderList2::class, 'store']);

	Route::get ('/order/list2/search/prod', [OrderList2::class, 'searchProd'])->name('order.list2.searchprod');
	Route::post('/order/list2/search/prod', [OrderList2::class, 'searchProd']);


	/*************************
	* 受付状況確認
	**************************/
	Route::get('/order/list', [OrderList::class, 'index'])->name('order.list');

	Route::get ('/order/list/search', [OrderList::class, 'list'])->name('order.list.search');
	Route::post('/order/list/search', [OrderList::class, 'list']);


	Route::get ('/order/list/print', [OrderList::class, 'print'])->name('order.list.search');
	Route::post('/order/list/print', [OrderList::class, 'print']);

	Route::get ('/order/list/detail', [OrderList::class, 'detail'])->name('order.list.detail');
	Route::post('/order/list/detail', [OrderList::class, 'detail']);

	Route::get ('/order/list/detail/store', [OrderList::class, 'store'])->name('order.list.detail.store');
	Route::post('/order/list/detail/store', [OrderList::class, 'store']);

	Route::get ('/order/list/detail/printview', [OrderPrintview::class, 'viewer'])->name('order.list.detail.printview');
	Route::post('/order/list/detail/printview', [OrderPrintview::class, 'viewer']);

	Route::get ('/order/list/detail/upgradeprint', [OrderUpgradeprint::class, 'viewer'])->name('order.list.detail.upgradeprint');
	Route::post('/order/list/detail/upgradeprint', [OrderUpgradeprint::class, 'viewer']);

	/*************************
	* 受注履歴照会
	**************************/
	Route::get('/order/search/history', [OrderSearchHistory::class, 'index'])->name('order.search.history');

	Route::get ('/order/search/history/search', [OrderSearchHistory::class, 'search'])->name('order.search.history.search');
	Route::post('/order/search/history/search', [OrderSearchHistory::class, 'search']);


	/*************************
	* 郵便番号辞書更新
	**************************/
	Route::get ('/zipdata/update/form', function () { 
		return view('admin.zipdata.updateForm');
	});

	Route::get ('/zipdata/update/result', [ZipdataUpdate::class, 'update_result'])->name('zipdata.update_result');
	Route::post('/zipdata/update/result', [ZipdataUpdate::class, 'update_result']);


	/*************************
	* バッチ設定
	**************************/
	Route::get('/batch/conf', [BatchConf::class, 'index'])->name('batch.conf');

	Route::get ('/batch/conf/store', [BatchConf::class, 'store'])->name('batch.conf.store');
	Route::post('/batch/conf/store', [BatchConf::class, 'store']);


	/*************************
	* お知らせ
	**************************/
	Route::get('/info', [Info::class, 'index'])->name('admin.info');

	Route::get ('/info/store', [Info::class, 'store'])->name('info.store');
	Route::post('/info/store', [Info::class, 'store']);


	/*************************
	* テスト
	**************************/
	Route::get('/test/shipping/form', [TestShipping::class, 'index'])->name('test.shipping');

	Route::get ('/test/shipping/result', [TestShipping::class, 'result'])->name('test.shipping.result');
	Route::post('/test/shipping/result', [TestShipping::class, 'result']);

});
