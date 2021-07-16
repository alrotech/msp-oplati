# [0.9.0](https://github.com/alroniks/mspOplati/compare/v0.8.0...v0.9.0) (2021-07-15)


### Bug Fixes

* proper usage of dto classes, fix composer psr-4 param ([bf20fec](https://github.com/alroniks/mspOplati/commit/bf20fecc241174dcb5fe6bad0463d3dbd2107624))
* split handler and serivce interfaces to be compatibe with mspPaymentProps ([a5aecb8](https://github.com/alroniks/mspOplati/commit/a5aecb81cb0695b963f4ed61fde1812367737533))
* stabilize chunk structure, replace labels by lexicon keys ([bf8ed59](https://github.com/alroniks/mspOplati/commit/bf8ed59e7351658ca3967b71de9d8c2af187b1c4))
* use class name constant in the resolver to setup proper payment handler during installation ([b7299bc](https://github.com/alroniks/mspOplati/commit/b7299bc38c23adf8800ecc53358a3ba8fb513320))


### Features

* add default property set for the snippet `oplati` ([d8d6728](https://github.com/alroniks/mspOplati/commit/d8d6728aa22a4e75f83342621d9d20a68e2e5127))
* split payment handler and payment service for better maintainability ([095577c](https://github.com/alroniks/mspOplati/commit/095577cac71bb74cbc9eb9919bd4212b6ff3c7df))
* use DTO for payment response ([886e7a9](https://github.com/alroniks/mspOplati/commit/886e7a99613b5d6cf02a64665e11fb45b7025740))



# [0.8.0](https://github.com/alroniks/mspOplati/compare/v0.7.0...v0.8.0) (2021-07-12)


### Bug Fixes

* finished snippet for generating qr code in the template (snippet) ([93f467d](https://github.com/alroniks/mspOplati/commit/93f467d86ec52ad2b95a2c58c17bf6626485fe86))
* use in the chunk real properties about size and colors ([6282b62](https://github.com/alroniks/mspOplati/commit/6282b624c9a43f94d8ea1aa18176c39162a90fa1))


### Features

* connector for requests to the processors ([9c376dc](https://github.com/alroniks/mspOplati/commit/9c376dcff778edabb90d340fdaf543895d22ec8e))
* localization, lexicons added ([6ea3ce6](https://github.com/alroniks/mspOplati/commit/6ea3ce65e6fee72c55617dd3eda726a266c4d4d3))
* processors for getting payment status and renewing qr code ([c825031](https://github.com/alroniks/mspOplati/commit/c825031b7954de75bb1675bfda154a83a7b588e2))



# [0.7.0](https://github.com/alroniks/mspOplati/compare/v0.6.0...v0.7.0) (2021-07-07)


### Features

* add draft of documentation ([f3698a3](https://github.com/alroniks/mspOplati/commit/f3698a33193faf1a83c81da7f1313c8b143b1262))
* add qr code library and create front application ([53a9221](https://github.com/alroniks/mspOplati/commit/53a9221a90636d15d07ab40bcb55ed2534f9ba14))
* add snippet and tpl for qr code ([2dec4d1](https://github.com/alroniks/mspOplati/commit/2dec4d1a6ccfe01c93e26b4a5580ee921354399f))



# [0.6.0](https://github.com/alroniks/mspOplati/compare/v0.5.0...v0.6.0) (2021-07-02)


### Bug Fixes

* proper file path in require ([bbc2f42](https://github.com/alroniks/mspOplati/commit/bbc2f420e79fbe193d806e3ca31dd189de8f2181))


### Features

* add snippet and chunk for rendering qr code ([cb80cc9](https://github.com/alroniks/mspOplati/commit/cb80cc9db687ad91b6ef49f59abe06ed633aa311))
* return to unpaid page and showing the qr code there ([6a30980](https://github.com/alroniks/mspOplati/commit/6a309802611625ca07eb9927e9e676fde851bb85))



# [0.5.0](https://github.com/alroniks/mspOplati/compare/v0.4.0...v0.5.0) (2021-04-23)


### Bug Fixes

* set to lower case readme and changelog files names to add them to package ([fd34229](https://github.com/alroniks/mspOplati/commit/fd3422999c28e72292673584e51297c804facb56))


### Features

* add ability to pass encryption key to the build command as a param ([1f740d8](https://github.com/alroniks/mspOplati/commit/1f740d81e66027ccf05373b30526cc57e860887d))



# [0.4.0](https://github.com/alroniks/mspOplati/compare/87df0249c5b7b37d1d6b87038926b963110b6f01...v0.4.0) (2021-04-23)


### Bug Fixes

* issue with overidden system settings with login and password ([0812caf](https://github.com/alroniks/mspOplati/commit/0812caf150e4610e12a8d83468b51ec749a66ef2))


### Features

* added areas to system settings ([0aec6c0](https://github.com/alroniks/mspOplati/commit/0aec6c09a1c705bf28c6652dd1617541d8820c9b))
* core and build files ([e616b5a](https://github.com/alroniks/mspOplati/commit/e616b5ae7c02114e6200411d533ace942186f7df))
* dto objects for building request ([d874ff1](https://github.com/alroniks/mspOplati/commit/d874ff1a67f9581137cc82cd6abf9ad8aa39d6c7))
* encryption and build script modernization ([20983cf](https://github.com/alroniks/mspOplati/commit/20983cf5eee5b7c4584f15372db4afc64bcfe23d))
* getting payment link in mobile browser ([b7e6c37](https://github.com/alroniks/mspOplati/commit/b7e6c37c3d65b8ee5d4d24cc9a811b8cbd74c223))
* init model as composer package, require dependensies needed to proper work ([93969e2](https://github.com/alroniks/mspOplati/commit/93969e2e15418cd79e34bf7a3686a41c398d8a12))
* license and other initial files ([87df024](https://github.com/alroniks/mspOplati/commit/87df0249c5b7b37d1d6b87038926b963110b6f01))
* package files as special file vehicle ([62c4a3d](https://github.com/alroniks/mspOplati/commit/62c4a3d25490549a39382a2b10669f5de98ea0c2))
* remove useless validators and add new one for php extensions ([0de2293](https://github.com/alroniks/mspOplati/commit/0de2293dcd58307ed8617fdd034a15a2f3cc8335))
* system settings for the component ([83e23d2](https://github.com/alroniks/mspOplati/commit/83e23d261747e1db6a6f07b3310c59dc10041384))



