# 添付ファイル送信サンプル
## 概要
Laravelを利用し、SalesforceのRestAPI経由で、添付ファイルオブジェクトにレコードを作成するサンプル。

Salesforce側のRestAPIのコードは以下のリポジトリを参照。


## 検証環境

* [Vagrant (Scotch Box 3.0)](https://box.scotch.io/)
* PHP 7.0
* Laravel 5.4.32

## 追加したLarvelパッケージ

* [`"laravelcollective/html": "^5.4.0"`](https://laravelcollective.com/)
* [`"omniphx/forrest": "2.*"`](https://github.com/omniphx/forrest)

## 追加ファイル

```
app/Http/Controllers/
	GetAttachController.php
	PostAttachController.php
resources/views/
	getfile.blade.php
	postfile.blade.php	
routes/
	web.php	
```

## ファイルサイズ制限について

送信する際のファイルサイズの制限は、PHP側の制限とSF側の制限が存在する。

PHPの設定に関しては`php.ini`での設定となるので変更が可能。  
(下の表ではScotchboxのデフォルト設定)  
しかし、SF側の設定はガバナ制限となるため、変更は不可。  
よって、実質、5MBまでの制限となる。

| 種類 | 項目 | 容量 |
| :-- | :-- | :-- |
| PHP | `post_max_size` | 2M |
|  | `upload_max_filesize` | 8M |
| SF | ヒープ制限 | 6MB |

* [ファイルのアップロード（１）ファイルのサイズの制限：制限なしでも制限ある](http://www.larajapan.com/2016/03/26/%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E3%81%AE%E3%82%A2%E3%83%83%E3%83%97%E3%83%AD%E3%83%BC%E3%83%89%EF%BC%88%EF%BC%91%EF%BC%89%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E3%81%AE%E3%82%B5%E3%82%A4%E3%82%BA/)
* [ガバナ制限](https://developer.salesforce.com/docs/atlas.ja-jp.salesforce_app_limits_cheatsheet.meta/salesforce_app_limits_cheatsheet/salesforce_app_limits_platform_apexgov.htm)
* [【Salesforce】System.LimitException: Apex heap size too large:](http://www.subnetwork.jp/blog/?p=710)

