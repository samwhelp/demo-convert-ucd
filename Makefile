
THE_MAKEFILE_FILE_PATH := $(abspath $(lastword $(MAKEFILE_LIST)))
THE_BASE_DIR_PATH := $(abspath $(dir $(THE_MAKEFILE_FILE_PATH)))
THE_BIN_DIR_PATH := $(THE_BASE_DIR_PATH)/bin

PATH := $(THE_BIN_DIR_PATH):$(PATH)

default: help
.PHONY: default

help:
	@help.sh
.PHONY: help

asset:
	@asset.sh
.PHONY: asset

test:
	@test.php
.PHONY: test

source:
	@source.php
.PHONY: source

source-with-char:
	@source-with-char.php
.PHONY: source-with-char

json:
	@json.php
.PHONY: json

xml:
	@xml.php
.PHONY: xml

html:
	@html.php
.PHONY: html
