
THE_MAKEFILE_FILE_PATH := $(abspath $(lastword $(MAKEFILE_LIST)))
THE_BASE_DIR_PATH := $(abspath $(dir $(THE_MAKEFILE_FILE_PATH)))
THE_BIN_DIR_PATH := $(THE_BASE_DIR_PATH)/bin

.PHONY: usage asset test source source-with-char xml html

usage:
	$(THE_BIN_DIR_PATH)/usage.sh

asset:
	$(THE_BIN_DIR_PATH)/asset.sh

test:
	$(THE_BIN_DIR_PATH)/test.php

source:
	$(THE_BIN_DIR_PATH)/source.php

source-with-char:
	$(THE_BIN_DIR_PATH)/source-with-char.php

json:
	$(THE_BIN_DIR_PATH)/json.php

xml:
	$(THE_BIN_DIR_PATH)/xml.php

html:
	$(THE_BIN_DIR_PATH)/html.php
