# Magento 2 StdLogging

<div align="center">

[![Packagist Downloads](https://img.shields.io/packagist/dm/graycore/magento2-stdlogging?color=blue)](https://packagist.org/packages/graycore/magento2-stdlogging/stats)
[![Packagist Version](https://img.shields.io/packagist/v/graycore/magento2-stdlogging?color=blue)](https://packagist.org/packages/graycore/magento2-stdlogging)
[![Packagist License](https://img.shields.io/packagist/l/graycore/magento2-stdlogging)](https://github.com/graycoreio/magento2-stdlogging/blob/main/LICENSE)
[![Installation Test](https://github.com/graycoreio/magento2-stdlogging/actions/workflows/install.yaml/badge.svg)](https://github.com/graycoreio/magento2-stdlogging/actions/workflows/install.yaml)
[![Integration Test](https://github.com/graycoreio/magento2-stdlogging/actions/workflows/integration.yaml/badge.svg)](https://github.com/graycoreio/magento2-stdlogging/actions/workflows/integration.yaml)
[![Unit Test](https://github.com/graycoreio/magento2-stdlogging/actions/workflows/unit.yaml/badge.svg)](https://github.com/graycoreio/magento2-stdlogging/actions/workflows/unit.yaml)

</div>




## Magento Version Support
![Magento v2.3 Supported](https://img.shields.io/badge/Magento-2.3-brightgreen.svg?labelColor=2f2b2f&logo=magento&logoColor=f26724&color=464246&longCache=true&style=flat)
![Magento v2.4 Supported](https://img.shields.io/badge/Magento-2.4-brightgreen.svg?labelColor=2f2b2f&logo=magento&logoColor=f26724&color=464246&longCache=true&style=flat)

## Purpose
This module is a drop in replacement to pump all Magento 2 logs to StdOut. This is especially useful when working in a dockerized environment where you want to aggregate your logs into an external system without having to know about Magento specific log files and configurations.

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
## Upgrading
* [Semver Policy](https://semver.org/)