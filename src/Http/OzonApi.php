<?php

namespace Biohazard\Http;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Carbon\Carbon;
use stdClass;

class OzonApi
{

    protected $response = null;

    public function __construct()
    {

    }

    public function get(string $url, array $query = []): object
    {
        $response = Http::connection()->get($url, $query);
        $this->response = $response;
        
        if ($response->successful()) {
            return $response->object();
        } else {
            $response->throw();
        }
    }

    public function post(string $url, array|object $query = []): object
    {
        $response = Http::connection()->post($url, $query);
        $this->response = $response;

        if ($response->successful()) {
            $result = $response->object();
            return $result;
        } else {
            $response->throw();
        }
    }

    public function getResponse(): Response {
        return $this->response;
    }

    public function productList(object $filter = new stdClass, int $limit = 1000, string $lastId = null): object {
        return $this->post('/v2/product/list', [
            'filter' => $filter,
            'last_id' => $lastId,
            'limit' => $limit,
        ])->result;
    }

    public function productInfo(int $product_id, string $offer_id = null, int $sku = null): object {
        return $this->post('/v2/product/info', [
            'product_id' => $product_id,
            'offer_id' => $offer_id,
            'sku' => $sku,
        ])->result;
    }

    public function ratingSummary(): array {
        return $this->post('/v1/rating/summary', new stdClass)->groups;
    }

}