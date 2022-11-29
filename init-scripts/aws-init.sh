#!/usr/bin/env bash
set -x
awslocal s3 mb s3://task12
awslocal ses verify-email-identity --email-address task12@gmail.com --endpoint-url=http://172.17.0.1:4566
set +x
