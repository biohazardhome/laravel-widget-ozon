# Озон Виджет для сайта на Laravel
Виджет для вывода списка продуктов определенного продовца с сайта Ozon. В левом верхнем углу выводится рейтинг продавца.


## Установка пакета
```
composer require biohazard/laravel-widget-ozon
php artisan vendor:publish --tag=widget - Создать файлы представления и assets
```

В .env файл добавить с вашими данными
```
OZON_CLIENT_ID=""
OZON_API_KEY=""
OZON_BASE_URL=""
```

```
Widget::VISIBLE = Какие товары выводить [ALL, VISIBLE, TO_SUPPLY, IN_SALE, OVERPRICED] [Ozon Api Seller](https://docs.ozon.ru/api/seller/#operation/ProductAPI_GetProductList)
Widget::LIMIT = Количество продуктов, которое будет выводить виджет
Widget::PRODUCTS = Индификаторы продуктов, которые будут выводится в виджете
Widget::CACHE_TIME = Количество секунд на которое кэшируется виджет
```