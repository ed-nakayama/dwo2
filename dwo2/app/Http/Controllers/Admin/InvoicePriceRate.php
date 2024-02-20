namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\MItem;
use App\Models\TCcOrderDtlWeb;

/**
 * 仕切率クラス
 */
class InvoicePriceRate  extends Controller
{
	
	private $agent = null;
	private $product = null;
	private $distList = null;
	
	public function __construct($agent, $product) {
		$this->agent = $agent;
		$this->product = $product;
		$this->distList = $this->getDistributionView();
	} 
	
	/**
	 * 仕切り率を取得します。
	 * @return 仕切り率(100分率) 
	 */
	public function getRate() {
		
		$rate = false;
		$rate = $this->getPrimayRate();
		
		if ($rate === false) {
			$rate = $this->getSecondaryRate();
		}
		
		if ($rate === false) {
			$rate = 100;
		}
		
		return $rate;
				
	}
	
	private function getPrimayRate() {
		
		for ($i = 0; $i < $this->distList->size(); $i++) {
			
			$dist = $this->distList->get($i);
						
			if (
				($dist->cust_class_small == $this->agent["smallCode"]) &&
				($dist->item_class_large == $this->product->item_class_large) &&
			    ($dist->item_class_medium == $this->product->item_class_medium) &&
			    ($dist->item_class_small == $this->product->item_class_small)
			    )
			{
				return $dist->standard_rate;
			}
			
		}
		
		return false;
		
	}
	
	private function getSecondaryRate() {
		
		for ($i=0; $i < $this->distList->size(); $i++) {
			
			$dist = $this->distList->get($i);
			
			if (
				($dist->cust_class_small == 0) &&
				($dist->item_class_large == $this->product->item_class_large) &&
			    ($dist->item_class_medium == $this->product->item_class_medium) &&
			    ($dist->item_class_small == $this->product->item_class_small)
			    )
			{
				return $dist->standard_rate;
			}
			
		}
		
		return false;
		
	}
	
	
	private function getDistributionView() {
		
		// 基幹仕切りマスタのデータ取得
		$distributionviewdao = new DistributionViewDAO();
		
		return $distributionviewdao->find(
										$this->agent["largeCode"],
										$this->agent["midCode"],
										$this->product->item_class_large,
										$this->product->item_class_medium,
										$this->product->item_class_small
										);
																	
	}
	
}
?>
