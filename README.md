# demo-convert-ucd

[UCD (Unicode Character Database) Convert Demo](https://samwhelp.github.io/demo-convert-ucd/)

## 相關討論

* [#32 回覆: Unicode9.0字元一覽有感](https://www.ubuntu-tw.org/modules/newbb/viewtopic.php?post_id=356294#forumpost356294)
* [#22 回覆: Unicode9.0字元一覽有感](https://www.ubuntu-tw.org/modules/newbb/viewtopic.php?post_id=356294#forumpost356294)


## 前置作業

以下以「Xubuntu 16.04」當作執行環境。

### 下載安裝「composer」

執行下面指令下載安裝「composer」

``` sh
mkdir -p ~/bin
wget -c https://getcomposer.org/composer.phar -O ~/bin/composer
chmod u+x ~/bin/composer
composer self-update
```

然後執行下面指令

``` sh
$ composer install
```

上面指令，會根據「[composer.json](composer.json)」的設定。

然後產生「vendor」資料夾，和一些檔案。

### 下載 UCD

執行

``` sh
$ make asset
```

會下載一些檔案和解開，放到「asset/unicode」這個資料夾。

詳細的執行動作可以參考「[bin/asset.sh](bin/asset.sh)」

## 主要操作

執行

``` sh
$ make
```

顯示

```
Usage: make [command]

Ex:
$ make source

$ make xml
$ make html
$ make json
```

需要先執行

``` sh
$ make source
```

就會產生「var/source」這個資料夾，和裡面的檔案。

接下來才可以執行「make xml」或「make html」或「make json」。

就會產生「var/xml」或「var/html」或「var/json」這幾資料夾。
