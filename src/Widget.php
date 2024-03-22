<?php

namespace Biohazard;

use App\Http\OzonApi;
use stdClass;

class Widget {

	const
		LIMIT = 5,
		PRODUCTS = ['403482751', '403636472', '403505713', '403510966', '403617123'], // product ids
		CACHE_TIME = 500,
		VISIBLE = 'VISIBLE'; // ALL, VISIBLE, TO_SUPPLY, IN_SALE, OVERPRICED

	public
		$api = null,
		$products = [];

	public function __construct() {
		$this->api = app(OzonApi::class);		
	}

	public function init() {

		$products = cache()->remember('ozon-widget-products', static::CACHE_TIME, function () {
            return $this->products();
        });

        $rating = cache()->remember('ozon-widget-rating', static::CACHE_TIME, function () {
        	return $this->rating();
        });

		return view('widget', compact('products', 'rating'));
	}

	public function products() {
		$filter = new stdClass;
		$filter->product_id = static::PRODUCTS;
		$filter->visibility = static::VISIBLE;
		$list = $this->api->productList($filter, static::LIMIT);
        
        $products = [];
        foreach($list['items'] as $item) {
            $item = (object) $item;
            $product = (object) $this->api->productInfo($item->product_id, $item->offer_id);

            $this->productPrepare($product);

            $products[] = $product;
        }
        $this->products = $products;

        return $products;
	}

	public function rating() {
		$groups = $this->api->ratingSummary();
		foreach($groups as $group) {
			if ($group['group_name'] === 'Оценка продавца') {
				break;
			}
		}

		return (object) $group['items'][0]/*['current_value']*/;
	}

	public function getProducts():array {
		return $this->products;
	}

	public function productPrepare(object $product):object {
        $product->url = 'https://www.ozon.ru/product/'. $product->sku;
        $product->marketing_price = $this->productPrice($product->marketing_price);
        $product->old_price = $this->productPrice($product->old_price);

        return $product;
    }

    public function productPrice(string $price):string {
        return number_format((float) $price, 0, null, ' ');
    }

}