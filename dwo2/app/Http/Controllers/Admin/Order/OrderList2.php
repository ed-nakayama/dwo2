<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Classes\OrderHeaderViewDAO;
use App\Http\Controllers\Classes\OrderDetailViewDAO;
use App\Http\Controllers\Classes\WebOrderHeaderDAO;
use App\Http\Controllers\Classes\WebOrderDetailDAO;
use App\Http\Controllers\Classes\ProfileDAO;
use App\Http\Controllers\Classes\ProductlistViewDAO;
use App\Http\Controllers\Classes\AgentViewDAO;

use App\Models\AgentView;

use App\Mail\MaintInfoUpdate;

class OrderList2 extends Controller
{

/*************************************
* 受付編集
**************************************/
	public function index(Request $request)
	{
		$param['orderNum']       = !empty($request->orderNum)       ? $request->orderNum       : null;
		$param['custNum']        = !empty($request->custNum)        ? $request->custNum        : null;
		$param['orderStartDate'] = !empty($request->orderStartDate) ? $request->orderStartDate : null;
		$param['orderEndDate']   = !empty($request->orderEndDate)   ? $request->orderEndDate   : null;
		$param['custName']       = !empty($request->custName)       ? $request->custName       : null;
		$param['custNameKana']   = !empty($request->custNameKana)   ? $request->custNameKana   : null;
		$param['prefList']       = !empty($request->prefList)       ? $request->prefList       : null;
		$param['searchTel']      = !empty($request->searchTel)      ? $request->searchTel      : null;
		$param['deliveryType']   = isset($request->deliveryType)   ? $request->deliveryType   : null;
		$param['deliveryName']   = !empty($request->deliveryName)   ? $request->deliveryName   : null;
		$param['nameOfCharge']   = !empty($request->nameOfCharge)   ? $request->nameOfCharge   : null;
		$param['statusId']       = isset($request->statusId)      ? $request->statusId        : null;

		$orderHeaderViewDAO = new OrderHeaderViewDAO();
		$dataList = $orderHeaderViewDAO->find2($param ,"DESC");

		$dataList->appends($param);

		return view('admin.order.list2' ,
			[
			'dataList'       => $dataList,
			'param'          => $param,
		]);
	}


/*************************************
* 受付編集　詳細
**************************************/
	public function detail(Request $request)
	{
		$validated = $request->validate([
			'order_num' => ['required'],
		]);


		$orderHeaderViewDAO = new OrderHeaderViewDAO();

		$headerView = $orderHeaderViewDAO->findById($request->input('order_num'));

		$secondaryCustNum  = "";
		$secondaryCustName = "";

		// ２次店顧客番号から顧客情報を取得(オリコン、TMの場合)
		if (!empty($headerView->secondary_cust_num) ) {
			$agentviewDAO = new AgentViewDAO();
			$agentView = $agentviewDAO->findById($headerView->secondary_cust_num);

			$secondaryCustNum  = $agentView->cust_num;
			$secondaryCustName = $agentView->name1 . $agentView->name2;
		}

		$orderDetailViewDAO = new OrderDetailViewDAO();
		$detailViewList = $orderDetailViewDAO->findById($request->input('order_num'));

		return view('admin.order.detail2' ,
			[
			'headerView'        => $headerView,
			'detailViewList'    => $detailViewList,
			'secondaryCustNum'  => $secondaryCustNum,
			'secondaryCustName' => $secondaryCustName,
		]);
	}


/*************************************
* 受付編集　詳細　保存
**************************************/
	public function store(Request $request)
	{
		$validated = $request->validate([
			'orderNum'           => ['required'],
			'orderDate'          => ['nullable'],
			'shippingDate'       => ['nullable'],
			'orderPersonName'    => ['nullable'],
			'doublePackageType'  => ['nullable'],
			'deliveryDateType'   => ['nullable'],
			'deliveryDate'       => ['nullable'],
			'deliveryTimeType'   => ['nullable'],
			'destName1'          => ['nullable'],
			'destPost'           => ['nullable', 'max:8'],
			'destPrefCd'         => ['nullable'],
			'destAddress1'       => ['nullable'],
			'destAddress2'       => ['nullable'],
			'destAddress3'       => ['nullable'],
			'destContactName1'   => ['nullable'],
			'destTel'            => ['nullable', 'max:20'],
			'destFax'            => ['nullable', 'max:20'],
			'directDeliveryType' => ['nullable'],
			'deliverMemo'        => ['nullable'],
			'custDelType'        => ['nullable'],
			'operatorDelType'    => ['nullable'],
			'orderAmt'           => ['nullable'],
			'taxRate'            => ['nullable'],
			'tax'                => ['nullable'],
			'totalAmt'           => ['nullable'],
		]);

		$validated2 = $request->validate([
			'orderNum'          => ['required'],
			'orderLineNum.*'    => ['nullable'],
			'custOrderNum.*'    => ['nullable'],
			'itemCd.*'          => ['nullable'],
			'itemPrice.*'       => ['nullable'],
			'itemVol.*'         => ['required'],
			'itemAmt.*'         => ['nullable'],
			'itemTaxRate.*'     => ['nullable'],
			'itemTax.*'         => ['nullable'],
			'itemDel.*'         => ['nullable'],
		]);

		$validated2['itemTaxRateMixed'] = $validated2['itemTaxRate'];


		$loginUser = Auth::user();


		$orderDetailViewDAO = new OrderDetailViewDAO();

		// 明細の更新  受注内容区分(contents_type) 40:販売店通し  81:PAP通し  82:PAP通し 
		if ($request->input('contentsType') == "40" || $request->input('contentsType') == "81" || $request->input('contentsType') == "82") {
			$orderDetailViewDAO->update($loginUser->operator_id, $validated2);
		}

		// ヘッダの更新
		$orderHeaderViewDAO = new OrderHeaderViewDAO();
		$orderHeaderViewDAO->update($loginUser->operator_id, $validated);


		if (!empty($request->input('updateMail')) ) {
			//print("メール送信する");
			// メール送信

			// WEB受注基本テーブル検索
			$webOrderHeaderDAO = new WebOrderHeaderDAO();
			$webOrderHeader = $webOrderHeaderDAO->find($request->input('orderNum'));

			// WEB受注詳細テーブル検索
			$webOrderDetailDAO = new WebOrderDetailDAO();
			$webOrderDetailList = $webOrderDetailDAO->findNamePlus($request->input('orderNum'));

			$agentViewDAO = new AgentViewDAO();
			$agentView = $agentViewDAO->findById($webOrderHeader->cust_num);

			// profile情報検索
			$profileDAO = new ProfileDAO();
			$profile = $profileDAO->find($webOrderHeader->cust_num);

			 Mail::send(new MaintInfoUpdate($profile, $agentView, $webOrderHeader, $webOrderDetailList ));
		}

		return redirect()->route('admin.order.list2.detail', 
			[
			'order_num' => $request->input('orderNum'),
			])
			->with('status', 'success-store');

	}


/*************************************
* 商品検索
**************************************/
	public function searchProd(Request $request)
	{
		$validatedData = $request->validate([
			'prodCode' => ['required'],
		]);

		$agentView = AgentView::where('CUST_NUM' ,$request->input('custNum'))
			->selectRaw(
				' agent_view.cust_num, agent_view.name1, agent_view.name2, agent_view.search_name, agent_view.search_name_kana, ' . 
				' agent_view.post, agent_view.address1, agent_view.address2, agent_view.address3,' .
				' agent_view.tel, agent_view.search_tel, agent_view.fax, agent_view.search_fax,' .
				' agent_view.close_date1, agent_view.pay_cycle1, agent_view.pay_date1, agent_view.credit_limit, agent_view.tran_status_type,   ' . 
				' agent_view.cust_class_large, agent_view.cust_class_medium, agent_view.cust_class_small, '.
				' agent_view.class_large_name,   agent_view.class_medium_name, agent_view.class_small_name,' .
				' agent_view.account_num, agent_view.support_seq_num,' . 
				' agent_view.contact_department, agent_view.contact_title, agent_view.contact_name1, agent_view.mail_address, agent_view.pref_cd,' . 
				' agent_view.pap_treat_type, agent_view.pref, agent_view.cust_group1, agent_view.cust_group2'
			)
			->first();

		$productlistviewDAO = new ProductlistViewDAO();
		$prodList = $productlistviewDAO->searchProdList($request->custNum ,$request->prodCode ,$agentView);

		return view('admin.order.searchProd' ,
			[
			'agentView' => $agentView,
			'prodList'  => $prodList,
			'num'       => $request->input('num'),
			'custNum'   => $request->input('custNum'),
			'prodCode'  => $request->input('prodCode'),
		]);
	}

}
