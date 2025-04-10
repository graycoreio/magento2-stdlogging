# Changelog

All notable changes to this project will be documented in this file. See [standard-version](https://github.com/conventional-changelog/standard-version) for commit guidelines.

## [2.1.0](https://github.com/graycoreio/magento2-stdlogging/compare/v2.0.0...v2.1.0) (2025-04-10)


### Features

* bump allowed monolog dependency  ([#27](https://github.com/graycoreio/magento2-stdlogging/issues/27)) ([5eedf82](https://github.com/graycoreio/magento2-stdlogging/commit/5eedf82e18833e27fa3ed571b9b3b19cd7127061))


### Bug Fixes

* log bubbling compat between v2 and v3  ([#27](https://github.com/graycoreio/magento2-stdlogging/issues/27)) ([9945597](https://github.com/graycoreio/magento2-stdlogging/commit/994559767a720853ea36143a81586e3acf08c8de))


### Miscellaneous Chores

* **deps:** ignore Magento plugin ([#24](https://github.com/graycoreio/magento2-stdlogging/issues/24)) ([e254c4e](https://github.com/graycoreio/magento2-stdlogging/commit/e254c4e85b458be5565563d95459a3a4249d5bbf))

## [2.0.0](https://github.com/graycoreio/magento2-stdlogging/compare/v1.1.1...v2.0.0) (2022-06-26)


### ⚠ BREAKING CHANGES

* **all:** we no longer test against php7.2. Please use it at your own risk.

### ci

* **all:** fixup failing CI pipeline ([#15](https://github.com/graycoreio/magento2-stdlogging/issues/15)) ([f8dd292](https://github.com/graycoreio/magento2-stdlogging/commit/f8dd292eee2232d3355ed80dcf632906632c5960))

### [1.1.1](https://github.com/graycoreio/magento2-stdlogging/compare/v1.1.0...v1.1.1) (2020-10-23)


### Bug Fixes

* **deps:** align monolog version with Magento base version ([3380ca7](https://github.com/graycoreio/magento2-stdlogging/commit/3380ca7a3c971b7f857b77821a582459f9055c34))

## [1.1.0](https://github.com/graycoreio/magento2-stdlogging/compare/v1.0.3...v1.1.0) (2020-09-16)


### Features

* **deps:** update deps to support Magento v2.4 ([0958f4a](https://github.com/graycoreio/magento2-stdlogging/commit/0958f4a43c62cc5658a4147d3d18eb87271213f4))

### [1.0.3](https://github.com/graycoreio/magento2-stdlogging/compare/v1.0.2...v1.0.3) (2020-06-23)


### Bug Fixes

* **handler:** fix bug where accessing state  would cause a crash during setup:install ([#1](https://github.com/graycoreio/magento2-stdlogging/issues/1)) ([c903733](https://github.com/graycoreio/magento2-stdlogging/commit/c903733))



### [1.0.2](https://github.com/graycoreio/magento2-stdlogging/compare/v1.0.1...v1.0.2) (2020-03-12)


### Bug Fixes

* **log:** Inability to Run the DI Compiler before setup ([0a38687](https://github.com/graycoreio/magento2-stdlogging/commit/0a38687))


### Build System

* **deps:** bump composer deps ([fbc7f70](https://github.com/graycoreio/magento2-stdlogging/commit/fbc7f70))
* **release:** revert bad package.json version ([635e82e](https://github.com/graycoreio/magento2-stdlogging/commit/635e82e))
