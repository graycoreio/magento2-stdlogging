# Magento 2 StdLogger

[![Total Downloads](https://poser.pugx.org/graycore/magento2-stdlogging/downloads)](https://packagist.org/packages/graycore/magento2-stdlogging)
[![Build Status](https://graycore.visualstudio.com/open-source/_apis/build/status/graycoreio.magento2-stdlogging?branchName=master)](https://graycore.visualstudio.com/open-source/_build/latest?definitionId=14&branchName=master)
[![Latest Stable Version](https://poser.pugx.org/graycore/magento2-stdlogging/version)](https://packagist.org/packages/graycore/magento2-stdlogging)
[![License](https://poser.pugx.org/graycore/magento2-stdlogging/license)](https://packagist.org/packages/graycore/magento2-stdlogging)

## Purpose
This module is a drop in replacement to pump all Magento logs to StdOut and StdErr.

This is especially useful when working in a dockerized environment where you want to aggregate your logs.

## Getting Started
This module is intended to be installed with [composer](https://getcomposer.org/). From the root of your Magento 2 project:

1. Download the package
```bash
composer require graycore/magento2-stdlogging
```
2. Enable the package

```bash
./bin/magento module:enable Graycore_StdLogging
```