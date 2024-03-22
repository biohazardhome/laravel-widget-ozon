<style>

    .ozon-widget {
        position: relative;
        top: 0;
        left: 0;
    }

    .widget-seller-rating {
        position: absolute;
        top: 0;
        left: 0;
        font-size: 14px;
        font-weight: bold;
        background-color: rgb(0 48 120 / 15%);
        padding: 0 3px;
    }

    .widget-seller-rating:hover {
        background-color: rgb(0 48 120 / 75%);
    }

    .widget-seller-rating > span:first-child {
        color: orange;
        font-size: 16px;
    }

    .widget-products {
        display: flex;
/*        justify-content: center;*/
        gap: 1rem;
    }

    .widget-product {
        width: 150px;
        margin-bottom: 16px;
    }

    .widget-product-image {
        width: 150px;
        height: 150px;
        object-fit: contain;
    }

    .widget-product-price > span:first-child {
        font-size: 16px;
        font-weight: 700;
        letter-spacing: .4px;
        line-height: 24px;
        color: #10c44c;
    }

    .widget-product-price > span:last-child {
        font-size: 12px;
        font-weight: 500;
        letter-spacing: .2px;
        line-height: 20px;
        color: #99a3ae;
        text-decoration: line-through;
    }

    .widget-product-name a {
        font-size: 14px;
        font-weight: 400;
        letter-spacing: .2px;
        line-height: 18px;
        color: #070707;
        text-decoration: none;
    }
</style>

<div class="ozon-widget">
    <div class="widget-seller-rating" title="Рейтинг продовца">
        <span>&#9733;</span>
        {{ $rating->current_value }}
    </div>
    <div class="widget-products">
        @foreach($products as $product)
            <?php
                $title = str($product->name)->limit(30);
            ?>
            <div class="widget-product">
                <a href="{{ $product->url }}" title="{{ $title }}">
                    <img class="widget-product-image" src="{{ $product->primary_image }}" alt="" title="{{ $title }}" loading="lazy">
                </a>

                <div class="widget-product-price">
                    <span>{{ $product->marketing_price }} ₽</span> 
                    <span>{{ $product->old_price }} ₽</span>
                </div>

                <div class="widget-product-name">
                    <a href="{{ $product->url }}" title="{{ $title }}">
                        {{ str($product->name)->limit(50) }}
                    </a>
                </div>
            </div>
        @endforeach 
    </div>
</div>
