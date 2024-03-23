<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<link rel="stylesheet" href="{{ asset('css/widget/index.css'); }}">

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('js/widget/index.js'); }}"></script>
    
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
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach($product->images as $image)
                            <div class="swiper-slide">
                                <a href="{{ $product->url }}" title="{{ $title }}">
                                    <img class="widget-product-image" src="{{ $image }}" alt="" title="{{ $title }}" loading="lazy">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

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
