<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PdfController;

/*************************
* 基本
**************************/
use App\Http\Controllers\Weborder\Forgetchk;


/*************************
* バスケット
**************************/
use App\Http\Controllers\Weborder\Basket\BasketConfirm;


/*************************
* Common
**************************/
use App\Http\Controllers\Weborder\Common\CommonInformation;
use App\Http\Controllers\Weborder\Common\CommonShoppingcart;

/*************************
* 顧客情報
**************************/
use App\Http\Controllers\Weborder\Custinfo\CustinfoInput;
use App\Http\Controllers\Weborder\Custinfo\CustinfoHandling;

/*************************
* デリバリ
**************************/
use App\Http\Controllers\Weborder\Delivery\DeliverySelect;
use App\Http\Controllers\Weborder\Delivery\DeliveryOther;
use App\Http\Controllers\Weborder\Delivery\DeliveryRegistdelivery;

/*************************
* Top
**************************/
use App\Http\Controllers\Weborder\Top\TopHome;
use App\Http\Controllers\Weborder\Top\TopCondition;
use App\Http\Controllers\Weborder\Top\TopHistory;
use App\Http\Controllers\Weborder\Top\TopRegistrationinfo;
use App\Http\Controllers\Weborder\Top\TopCustinfo;
use App\Http\Controllers\Weborder\Top\TopPassedit;
use App\Http\Controllers\Weborder\Top\TopOrdermethod;
use App\Http\Controllers\Weborder\Top\TopDelivery;
use App\Http\Controllers\Weborder\Top\TopExtramail;
use App\Http\Controllers\Weborder\Top\TopMailReceiving;


/*************************
* Itemselect
**************************/
use App\Http\Controllers\Weborder\Item\ItemSelect;

/*************************
* オーダー
**************************/
use App\Http\Controllers\Weborder\Order\OrderPrintview;
use App\Http\Controllers\Weborder\Order\OrderUpgradeprint;
use App\Http\Controllers\Weborder\Order\OrderDetailinput;
use App\Http\Controllers\Weborder\Order\OrderConfirm;
use App\Http\Controllers\Weborder\Order\OrderCompletion;

/*************************
* Recognize
**************************/
use App\Http\Controllers\Weborder\Recognize\RecognizeTop;
use App\Http\Controllers\Weborder\Recognize\RecognizeUpdate;

/*************************
* Zip
**************************/
use App\Http\Controllers\Weborder\Zip\ZipSearchzip;


/*********************************************************************************
* 認証前
*********************************************************************************/

	/*************************
	* Recognize
	**************************/
	Route::get('/recognize/top', [RecognizeTop::class, 'index'])->name('recognize.top');

	Route::get ('/recognize/check', [RecognizeTop::class, 'check'])->name('recognize.check');
	Route::post('/recognize/check', [RecognizeTop::class, 'check']);

	Route::get ('/recognize/do', [RecognizeTop::class, 'do'])->name('recognize.do');
	Route::post('/recognize/do', [RecognizeTop::class, 'do']);

	Route::get ('/recognize/result', function () { 
    	return view('weborder.recognize.result');
	})->name('recognize.result');

	Route::get ('/recognize/update', [RecognizeUpdate::class, 'index'])->name('recognize.update');
	Route::post('/recognize/update', [RecognizeUpdate::class, 'index']);

	Route::get ('/recognize/update/do', [RecognizeUpdate::class, 'updateDo'])->name('recognize.update.do');
	Route::post('/recognize/update/do', [RecognizeUpdate::class, 'updateDo']);

	// 利用規約および免責事項
	Route::get('/guide/kiyaku', function () { 
	    return view('weborder.guide.kiyaku');
	});



/*********************************************************************************
* 認証前
*********************************************************************************/
Route::middleware('guest')->group(function () {

	/*************************
	* 基本
	**************************/
//    Route::get ('register', [RegisteredUserController::class, 'create'])->name('register');
//    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get ('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

	// パスワード忘れ
    Route::get ('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

	// パスワード変更
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password',        [NewPasswordController::class, 'store'])->name('password.store');

	// ルート　ログイン/
	Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('users.login');

	// ログアウト
	Route::get('/logout', function () { 
	    return view('weborder.logout');
	});


	// 利用規約および免責事項
	Route::get('/guide/kiyaku', function () { 
	    return view('weborder.guide.kiyaku');
	});

	// インフォメーション
	Route::get('/information', function () { 
	    return view('weborder.information');
	});

	// ID忘れ
	Route::get('/forgetchk', [Forgetchk::class, 'index']);
	Route::post('/forgetchk', [Forgetchk::class, 'index']);

	Route::get('/sent/mail', function () { 
	    return view('weborder.forgetchk');
	});




	/*************************
	* Zip
	**************************/
	Route::get ('/zip/out/searchzip', [ZipSearchzip::class, 'index'])->name('zip.out.searchzip');
	Route::post('/zip/out/searchzip', [ZipSearchzip::class, 'index']);

});


/*********************************************************************************
* 認証済
*********************************************************************************/
Route::middleware('auth')->group(function () {

    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

});



/***************************************************************************
* Weborder 
****************************************************************************/

Route::middleware('auth:web')->group(function () {

	Route::get('/pdf', [PdfController::class, 'index']);


	/*************************
	* バスケット
	**************************/
	Route::get ('/basket/confirm', [BasketConfirm::class, 'index'])->name('basket.confirm');
	Route::post('/basket/confirm', [BasketConfirm::class, 'index']);

	/*************************
	* Common
	**************************/
	Route::get('/common/information', [CommonInformation::class, 'index'])->name('common.information');

	Route::get('/common/shoppingcart', [CommonShoppingcart::class, 'index'])->name('common.shoppingcart');


	/*************************
	* custinfo
	**************************/
	Route::get ('/custinfo/input', [CustinfoInput::class, 'index'])->name('custinfo.input');
	Route::post('/custinfo/input', [CustinfoInput::class, 'store']);

	Route::get('/custinfo/handling', [CustinfoHandling::class, 'index'])->name('custinfo.handling');


	/*************************
	* デリバリ
	**************************/
	Route::get ('/delivery/select', [DeliverySelect::class, 'index'])->name('delivery.select');
	Route::post('/delivery/select', [DeliverySelect::class, 'index']);

	Route::get ('/delivery/other', [DeliveryOther::class, 'index'])->name('delivery.other');
	Route::post('/delivery/other', [DeliveryOther::class, 'index']);

	Route::get ('/delivery/other/regist', [DeliveryOther::class, 'regist'])->name('delivery.other.regist');

	Route::get ('/delivery/other/store', [DeliveryOther::class, 'store'])->name('delivery.other.store');
	Route::post('/delivery/other/store', [DeliveryOther::class, 'store']);


	/*************************
	* Itemselect
	**************************/
	Route::get ('/item/select', [ItemSelect::class, 'index'])->name('item.select');
	Route::post('/item/select', [ItemSelect::class, 'index']);

	Route::get ('/item/detail', [ItemSelect::class, 'detail'])->name('item.detail');
	Route::post('/item/detail', [ItemSelect::class, 'detail']);

	Route::get ('/item/detail/regist', [ItemSelect::class, 'regist'])->name('item.detail.regist');
	Route::post('/item/detail/regist', [ItemSelect::class, 'regist']);


	/*************************
	* オーダー
	**************************/
	Route::get ('/order/printview', [OrderPrintview::class, 'viewer'])->name('order.list.detail.printview');
	Route::post('/order/printview', [OrderPrintview::class, 'viewer']);

	Route::get ('/order/upgradeprint', [OrderUpgradeprint::class, 'viewer'])->name('order.list.detail.printview');
	Route::post('/order/upgradeprint', [OrderUpgradeprint::class, 'viewer']);

	Route::get('/order/detailinput', [OrderDetailinput::class, 'index'])->name('order.detailinput');

	Route::get('/order/confirm', [OrderConfirm::class, 'index'])->name('order.confirm');

	Route::get ('/order/completion', function () { 
    	return view('weborder.order.completion');
	})->name('order.completion');
	Route::post('/order/completion', [OrderCompletion::class, 'store']);

	Route::get ('/order/notes', function () { 
    	return view('weborder.order.notes');
	})->name('order.notes');

	Route::get ('/order/syserror', function () { 
    	return view('weborder.order.completion');
	})->name('order.syserror');

	/*************************
	* Top
	**************************/
	// ホーム
	Route::get('/home', [TopHome::class, 'index'])->name('top.home');

	// お取引条件
	Route::get('/top/condition', [TopCondition::class, 'index'])->name('top.condition');

	// 注文履歴
	Route::get('/top/history', [TopHistory::class, 'index'])->name('top.history');

	// Webオーダー注文履歴
	Route::get ('/top/history/search', [TopHistory::class, 'search'])->name('top.history.search');
	Route::post('/top/history/search', [TopHistory::class, 'search']);

	// Webオーダー注文履歴 詳細
	Route::get ('/top/history/detail', [TopHistory::class, 'detail'])->name('top.history.detail');
	Route::post('/top/history/detail', [TopHistory::class, 'detail']);

	// メールアドレス変更
	Route::get ('/top/history/mail/change', [TopHistory::class, 'mail_change'])->name('top.history.mail.change');
	Route::post('/top/history/mail/change', [TopHistory::class, 'mail_change']);

	Route::get ('/top/history/mail/confirm', [TopHistory::class, 'mail_confirm'])->name('top.history.mail.confirm');
	Route::post('/top/history/mail/confirm', [TopHistory::class, 'mail_confirm']);

	Route::get ('/top/history/mail/do', [TopHistory::class, 'mail_do'])->name('top.history.mail.do');
	Route::post('/top/history/mail/do', [TopHistory::class, 'mail_do']);

	// Webオーダー注文履歴 詳細 削除
	Route::get ('/top/history/delete', [TopHistory::class, 'delete'])->name('top.history.delete');
	Route::post('/top/history/delete', [TopHistory::class, 'delete']);

	// ご登録情報
	Route::get ('/top/registrationinfo', function () { 
    	return view('weborder.top.registrationinfo');
	});

	// 貴社登録情報
	Route::get ('/top/custinfo', function () { 
    	return view('weborder.top.custinfo');
	});
	
	// パスワード修正
	Route::get ('/top/passedit', [TopPassedit::class, 'index'])->name('top.passedit');
	Route::post('/top/passedit/do', [TopPassedit::class, 'updatePassword'])->name('top.passedit.do');

	Route::get ('/top/passedit/complete', function () { 
    	return view('weborder.top.passeditComplete');
	});

	// 納品先　削除
	Route::get ('/top/delivery', [TopDelivery::class, 'index'])->name('top.delivery.select');
	Route::post('/top/delivery', [TopDelivery::class, 'index']);

	Route::get ('/top/delivery/detail', [TopDelivery::class, 'detail'])->name('top.delivery.detail');
	Route::post('/top/delivery/detail', [TopDelivery::class, 'detail']);

	Route::get ('/top/delivery/delete', [TopDelivery::class, 'delete'])->name('top.delivery.delete');
	Route::post('/top/delivery/delete', [TopDelivery::class, 'delete']);

	// メールアドレス追加設定
	Route::get ('/top/extramail', function () { 
    	return view('weborder.top.extramail');
	});

	Route::get ('/top/extramail/change', function () { 
    	return view('weborder.top.extramailchg');
	});

	Route::get ('/top/extramail/confirm', [TopExtramail::class, 'confirm'])->name('top.extramail.confirm');
	Route::post('/top/extramail/confirm', [TopExtramail::class, 'confirm']);

	Route::get ('/top/extramail/store', [TopExtramail::class, 'store'])->name('top.extramail.store');
	Route::post('/top/extramail/store', [TopExtramail::class, 'store']);

	Route::get('/top/extramail/complete', function () { 
    	return view('weborder.top.extramaildo');
	});

	// メール受信設定
	Route::get ('/top/mailreceiving', function () { 
    	return view('weborder.top.mailReceiving');
	});

	Route::get ('/top/mailreceiving/mod', function () { 
    	return view('weborder.top.mailReceivingMod');
	});

	Route::get ('/top/mailreceiving/confirm', [TopMailReceiving::class, 'confirm'])->name('top.mailreceiving.confirm');
	Route::post('/top/mailreceiving/confirm', [TopMailReceiving::class, 'confirm']);

	Route::get ('/top/mailreceiving/do', [TopMailReceiving::class, 'store'])->name('top.mailreceiving.store');
	Route::post('/top/mailreceiving/do', [TopMailReceiving::class, 'store']);

	Route::get('/top/mailreceiving/complete', function () { 
    	return view('weborder.top.mailReceivingComplete');
	});

	/*************************
	* Zip
	**************************/
	Route::get ('/zip/searchzip', [ZipSearchzip::class, 'index'])->name('zip.searchzip');
	Route::post('/zip/searchzip', [ZipSearchzip::class, 'index']);


	/*************************
	* Zip
	**************************/
	Route::get ('/zip/out/searchzip', [ZipSearchzip::class, 'index'])->name('zip.out.searchzip');
	Route::post('/zip/out/searchzip', [ZipSearchzip::class, 'index']);

	// ご注文の流れ PAPのみ
	Route::get('/top/ordermethod', function () { 
    	return view('weborder.top.ordermethod');
	});

});
