# [0.12.0](https://github.com/mspay/msp-oplati/compare/v0.11.0...v0.12.0) (2021-08-11)


### Bug Fixes

* hide desktop elements in mobile view in the qr code chunk ([eae6e95](https://github.com/mspay/msp-oplati/commit/eae6e954948076afd0848327ca6e2d9b3d8a2b12))


### Features

* generating and handling backlinks for mobile app ([6c93965](https://github.com/mspay/msp-oplati/commit/6c93965972f91d5b4ff65f91b4cb944d606d92ae))



# [0.11.0](https://github.com/mspay/msp-oplati/compare/v0.10.1...v0.11.0) (2021-07-19)


### Bug Fixes

* make loading qrcode library from js application ([6deb88f](https://github.com/mspay/msp-oplati/commit/6deb88ffbc55a5edad8d0af1acb6d39f2e968de4))
* make payment status visible always ([b50d1db](https://github.com/mspay/msp-oplati/commit/b50d1dbe2498e8fcb9f6b0e00fbefa53710693f2))
* show translated status right after page loaded ([6d1d027](https://github.com/mspay/msp-oplati/commit/6d1d027dbbe64281ba21d5c852251da9dbaffa7b))


### Features

* finish processor for cheking payment state ([d71c8a4](https://github.com/mspay/msp-oplati/commit/d71c8a40ac7ea97af39138a538c6c166fe4479a9))
* finished frontend application, now it handles statuses ([2fe2a50](https://github.com/mspay/msp-oplati/commit/2fe2a506c5afe3bc065e51bc006f2f86c71b325d))
* handling payment statuses in the service ([afc528a](https://github.com/mspay/msp-oplati/commit/afc528ab3294515e1e3af0be82fbcb544d2f8db5))
* translations and human text for payment statuses ([8422eda](https://github.com/mspay/msp-oplati/commit/8422eda98855d085c788aacd722f46e46ee71e9b))



## [0.10.1](https://github.com/mspay/msp-oplati/compare/v0.10.0...v0.10.1) (2021-07-16)


### Bug Fixes

* rename case of filename with service to be able to load it in modx ([974fede](https://github.com/mspay/msp-oplati/commit/974fedee6b2b92f5e6b2797845e433a3c0a98a1b))



# [0.10.0](https://github.com/mspay/msp-oplati/compare/v0.9.0...v0.10.0) (2021-07-16)


### Bug Fixes

* improve view of the block with qr-code ([33fa40c](https://github.com/mspay/msp-oplati/commit/33fa40c6ad59245f3d527ec43eaffab12d4a061c))
* pass to the chunk with qr-code order info as well ([30ddf45](https://github.com/mspay/msp-oplati/commit/30ddf4546eef86580ddb44e2ceda0ee32bf9c6d3))


### Features

* set up lexicons and start translating ([ceef9f1](https://github.com/mspay/msp-oplati/commit/ceef9f1b9c4dfbe3f6b958ad5660a8f5d6540ef6))



# [0.9.0](https://github.com/mspay/msp-oplati/compare/v0.8.0...v0.9.0) (2021-07-15)


### Bug Fixes

* proper usage of dto classes, fix composer psr-4 param ([bf20fec](https://github.com/mspay/msp-oplati/commit/bf20fecc241174dcb5fe6bad0463d3dbd2107624))
* split handler and serivce interfaces to be compatibe with mspPaymentProps ([a5aecb8](https://github.com/mspay/msp-oplati/commit/a5aecb81cb0695b963f4ed61fde1812367737533))
* stabilize chunk structure, replace labels by lexicon keys ([bf8ed59](https://github.com/mspay/msp-oplati/commit/bf8ed59e7351658ca3967b71de9d8c2af187b1c4))
* use class name constant in the resolver to setup proper payment handler during installation ([b7299bc](https://github.com/mspay/msp-oplati/commit/b7299bc38c23adf8800ecc53358a3ba8fb513320))


### Features

* add default property set for the snippet `oplati` ([d8d6728](https://github.com/mspay/msp-oplati/commit/d8d6728aa22a4e75f83342621d9d20a68e2e5127))
* split payment handler and payment service for better maintainability ([095577c](https://github.com/mspay/msp-oplati/commit/095577cac71bb74cbc9eb9919bd4212b6ff3c7df))
* use DTO for payment response ([886e7a9](https://github.com/mspay/msp-oplati/commit/886e7a99613b5d6cf02a64665e11fb45b7025740))



# [0.8.0](https://github.com/mspay/msp-oplati/compare/v0.7.0...v0.8.0) (2021-07-12)


### Bug Fixes

* finished snippet for generating qr code in the template (snippet) ([93f467d](https://github.com/mspay/msp-oplati/commit/93f467d86ec52ad2b95a2c58c17bf6626485fe86))
* use in the chunk real properties about size and colors ([6282b62](https://github.com/mspay/msp-oplati/commit/6282b624c9a43f94d8ea1aa18176c39162a90fa1))


### Features

* connector for requests to the processors ([9c376dc](https://github.com/mspay/msp-oplati/commit/9c376dcff778edabb90d340fdaf543895d22ec8e))
* localization, lexicons added ([6ea3ce6](https://github.com/mspay/msp-oplati/commit/6ea3ce65e6fee72c55617dd3eda726a266c4d4d3))
* processors for getting payment status and renewing qr code ([c825031](https://github.com/mspay/msp-oplati/commit/c825031b7954de75bb1675bfda154a83a7b588e2))



# [0.7.0](https://github.com/mspay/msp-oplati/compare/v0.6.0...v0.7.0) (2021-07-07)


### Features

* add draft of documentation ([f3698a3](https://github.com/mspay/msp-oplati/commit/f3698a33193faf1a83c81da7f1313c8b143b1262))
* add qr code library and create front application ([53a9221](https://github.com/mspay/msp-oplati/commit/53a9221a90636d15d07ab40bcb55ed2534f9ba14))
* add snippet and tpl for qr code ([2dec4d1](https://github.com/mspay/msp-oplati/commit/2dec4d1a6ccfe01c93e26b4a5580ee921354399f))



# [0.6.0](https://github.com/mspay/msp-oplati/compare/v0.5.0...v0.6.0) (2021-07-02)


### Bug Fixes

* proper file path in require ([bbc2f42](https://github.com/mspay/msp-oplati/commit/bbc2f420e79fbe193d806e3ca31dd189de8f2181))


### Features

* add snippet and chunk for rendering qr code ([cb80cc9](https://github.com/mspay/msp-oplati/commit/cb80cc9db687ad91b6ef49f59abe06ed633aa311))
* return to unpaid page and showing the qr code there ([6a30980](https://github.com/mspay/msp-oplati/commit/6a309802611625ca07eb9927e9e676fde851bb85))



# [0.5.0](https://github.com/mspay/msp-oplati/compare/v0.4.0...v0.5.0) (2021-04-23)


### Bug Fixes

* set to lower case readme and changelog files names to add them to package ([fd34229](https://github.com/mspay/msp-oplati/commit/fd3422999c28e72292673584e51297c804facb56))


### Features

* add ability to pass encryption key to the build command as a param ([1f740d8](https://github.com/mspay/msp-oplati/commit/1f740d81e66027ccf05373b30526cc57e860887d))



# [0.4.0](https://github.com/mspay/msp-oplati/compare/87df0249c5b7b37d1d6b87038926b963110b6f01...v0.4.0) (2021-04-23)


### Bug Fixes

* issue with overidden system settings with login and password ([0812caf](https://github.com/mspay/msp-oplati/commit/0812caf150e4610e12a8d83468b51ec749a66ef2))


### Features

* added areas to system settings ([0aec6c0](https://github.com/mspay/msp-oplati/commit/0aec6c09a1c705bf28c6652dd1617541d8820c9b))
* core and build files ([e616b5a](https://github.com/mspay/msp-oplati/commit/e616b5ae7c02114e6200411d533ace942186f7df))
* dto objects for building request ([d874ff1](https://github.com/mspay/msp-oplati/commit/d874ff1a67f9581137cc82cd6abf9ad8aa39d6c7))
* encryption and build script modernization ([20983cf](https://github.com/mspay/msp-oplati/commit/20983cf5eee5b7c4584f15372db4afc64bcfe23d))
* getting payment link in mobile browser ([b7e6c37](https://github.com/mspay/msp-oplati/commit/b7e6c37c3d65b8ee5d4d24cc9a811b8cbd74c223))
* init model as composer package, require dependensies needed to proper work ([93969e2](https://github.com/mspay/msp-oplati/commit/93969e2e15418cd79e34bf7a3686a41c398d8a12))
* license and other initial files ([87df024](https://github.com/mspay/msp-oplati/commit/87df0249c5b7b37d1d6b87038926b963110b6f01))
* package files as special file vehicle ([62c4a3d](https://github.com/mspay/msp-oplati/commit/62c4a3d25490549a39382a2b10669f5de98ea0c2))
* remove useless validators and add new one for php extensions ([0de2293](https://github.com/mspay/msp-oplati/commit/0de2293dcd58307ed8617fdd034a15a2f3cc8335))
* system settings for the component ([83e23d2](https://github.com/mspay/msp-oplati/commit/83e23d261747e1db6a6f07b3310c59dc10041384))



