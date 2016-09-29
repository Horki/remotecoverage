#!/usr/bin/env bash


vendor/bin/codecept build

vendor/bin/codecept run api --coverage-html