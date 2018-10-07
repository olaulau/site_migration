#!/bin/bash

## global config
DO_CLEANUP=true
DO_IMPORT=true
DO_MODIFICACTIONS=false
DO_EXTRA_MODIFICATIONS=false
DO_EXPORT=true
USE_RSYNC=false # for website transfert, instead of lbzip2 and tar through SSH


## source config
SRC_SHELL_HOST=""
SRC_SHELL_USER=""
SRC_SHELL_PASSWORD=""
SRC_SHELL_DIRECTORY=""

SRC_DB_NAME=""
SRC_DB_USER=""
SRC_DB_PASSWORD=""

SRC_URL_SCHEME="https"
SRC_URL_HOST=""
SRC_URL_DIRECTORY=""


## destination config
DEST_SHELL_HOST=""
DEST_SHELL_USER=""
DEST_SHELL_PASSWORD=""
DEST_SHELL_DIRECTORY=""

DEST_DB_NAME=""
DEST_DB_USER="" # warning : if db user and name are identical on source, they have to be identical too on destination side to avoid replacement collision.
DEST_DB_PASSWORD=""

DEST_URL_SCHEME="https"
DEST_URL_HOST=""
DEST_URL_DIRECTORY=""
