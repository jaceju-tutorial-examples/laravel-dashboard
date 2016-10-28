# Laravel Dashboard 範例

簡報： [使用 Laravel 與 Vue.js 打造即時資訊看板](https://goo.gl/4tIOa1)

## 需求

* PHP 7
* Redis 3.x
* Node.js 5.x
* Facebook Yarn 0.x
* Laravel Valet 1.x
* 任一類型 Laravel 支援的資料庫系統

## 安裝

```bash
$ git clone https://github.com/jaceju-tutorial-examples/laravel-dashboard.git example-dashboard
$ cd example-dashboard
$ composer install
$ yarn install
$ valet link
$ cp .env .env.example
# 編輯 .env 以符合你的環境
$ php artisan migrate
$ gulp
```

## 新增測試使用者

```
$ php artisan tinker
```

然後建立測試用帳號：

```
>>> factory(App\User::class)->create([
  'email' => 'user@example.com',
  'password' => bcrypt('123456'),
]);
```

## 執行

```
$ ./testing.sh start
$ open http://example-dashboard.dev
# 帳號密碼即 user@example.com / 123456
```

## License

MIT