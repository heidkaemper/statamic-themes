#!/bin/bash
set -e

composer update --no-interaction --no-progress
npm update --no-fund --no-audit

exec ./vendor/bin/pest "$@"
