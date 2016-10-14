#!/usr/bin/env bash

THE_BASE_DIR_PATH=$(cd -P -- "$(dirname -- "$0")" && pwd -P)

# http://www.unicode.org/reports/tr44/
# http://www.unicode.org/Public/9.0.0/ucdxml/
# http://www.unicode.org/Public/9.0.0/ucd/
# http://www.unicode.org/Public/zipped/9.0.0/

THE_ASSET_DIR_PATH=$THE_BASE_DIR_PATH/../asset
THE_UNICODE_DIR_PATH=$THE_ASSET_DIR_PATH/unicode
THE_UNICODE_UCD_DIR_PATH=$THE_UNICODE_DIR_PATH/ucd
THE_UNICODE_UCDXML_DIR_PATH=$THE_UNICODE_DIR_PATH/ucdxml
THE_UNICODE_CHARTS_DIR_PATH=$THE_UNICODE_DIR_PATH/charts


## mkdir

mkdir $THE_UNICODE_UCD_DIR_PATH -p
mkdir $THE_UNICODE_UCDXML_DIR_PATH -p
mkdir $THE_UNICODE_CHARTS_DIR_PATH -p

## unicode

cd $THE_UNICODE_DIR_PATH

wget -c http://www.unicode.org/Public/9.0.0/ReadMe.txt


## unicode/ucd

cd $THE_UNICODE_UCD_DIR_PATH

wget -c http://www.unicode.org/Public/9.0.0/ucd/UCD.zip
wget -c http://www.unicode.org/Public/9.0.0/ucd/Unihan.zip

mkdir all -p

unzip UCD.zip -d all/UCD
unzip Unihan.zip -d all/Unihan


## uncode/ucdxml

cd $THE_UNICODE_UCDXML_DIR_PATH

wget -c http://www.unicode.org/Public/9.0.0/ucdxml/ucdxml.readme.txt
wget -c http://www.unicode.org/Public/9.0.0/ucdxml/ucd.all.flat.zip
wget -c http://www.unicode.org/Public/9.0.0/ucdxml/ucd.all.grouped.zip
wget -c http://www.unicode.org/Public/9.0.0/ucdxml/ucd.nounihan.flat.zip
wget -c http://www.unicode.org/Public/9.0.0/ucdxml/ucd.nounihan.grouped.zip
wget -c http://www.unicode.org/Public/9.0.0/ucdxml/ucd.unihan.flat.zip
wget -c http://www.unicode.org/Public/9.0.0/ucdxml/ucd.unihan.grouped.zip

unzip ucd.all.flat.zip -d all
unzip ucd.all.grouped.zip -d all
unzip ucd.nounihan.flat.zip -d all
unzip ucd.nounihan.grouped.zip -d all
unzip ucd.unihan.flat.zip -d all
unzip ucd.unihan.grouped.zip -d all


## unicode/charts

cd $THE_UNICODE_CHARTS_DIR_PATH

wget -c http://www.unicode.org/Public/9.0.0/charts/CodeCharts.pdf
wget -c http://www.unicode.org/Public/9.0.0/charts/Readme.txt
