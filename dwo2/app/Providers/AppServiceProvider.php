<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

use App\Models\AgentLevel;
use App\Models\ProductStatusMt;
use App\Models\BigCategoryMt;
use App\Models\MiddleCategoryMt;
use App\Models\OrderStatusMt;
use App\Models\MComment;
use App\Models\PriceClassView;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
		// 管理画面用のクッキー
        if (request()->is('admin*')) {
            config(['session.cookie' => config('session.cookie_admin')]);
        }
        

		view()->composer('*', function($view) {

			if (Auth::check()) {
				if (Auth::guard('admin')->check()) {
					view()->share('priceClassView', PriceClassView::orderBy('class_large')->orderBy('class_medium')->orderBy('class_small')->get());
					view()->share('agentLevel',     AgentLevel::orderBy('agent_level_code')->where('agent_level_del','0')->get());
					view()->share('bigCategoryAll', BigCategoryMt::orderBy('big_category_code')->get());

				} else {
				}

				view()->share('productStatus',  ProductStatusMt::orderBy('prod_status_id')->where('prod_status_del','0')->get());
				view()->share('bigCategory',    BigCategoryMt::orderBy('big_category_code')->where('big_category_del','0')->get());
				view()->share('middleCategory', MiddleCategoryMt::orderBy('middle_big_category_code')->orderBy('middle_category_code')->where('middle_category_del','0')->get());
				view()->share('orderStatus',    OrderStatusMt::orderBy('order_sort_num')->orderBy('order_status_id')->where('order_status_del','0')->get());
			}

			view()->share('prefList',       MComment::orderBy('comment_cd')->selectRaw('comment_cd as pref_cd, comment_content as pref_name ')->where('comment_type','05')->get());
		});

    }


}
