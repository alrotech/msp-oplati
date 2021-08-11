# mspOplati – платежный модуль для miniShop2.

[Оплати](https://www.o-plati.by/) – система электронных денег для оплаты товаров и услуг на территории Республики Беларусь. Позволяет пополнять кошелек, осуществлять переводы между кошельками (людьми) и оплачивать товары и услуги с помощью QR-кода.

Данный модуль `mspOplati` предоставляет возможность интеграции платежной системы "Оплати" и интернет-магазинов, созданных на базе CMS MODX и с помощью дополнения miniShop2. Обратите внимание, что модуль не будет работать с другими решениями для создания интернет-магазинов на базе MODX Revolution.

## Регистрация аккаунта

Для начала работы с сервисом следует оставить [заявку на сайте](https://www.o-plati.by/business) и следовать дальнейшим инструкциям, предоставленным в письме. Для дальнейшей работы вам потребуется регистрационный номер кассы и пароль.

## Установка


Для установки модуля оплаты стоит

### Настройка при установке

Для быстрого начала работы, если у вас уже имеется номер кассы и пароль для входа, вы можете настроить модуль оплат во время установки. При установке появляется окно, где требуется ввести запрашиваемые данные и продолжить установку.

--картинка--

Если не заполнить форму, пакет так же успешно установится, а настроить его можно будет позже, через системные настройки или в параметрах способа оплаты.

### Требования

Для успешной работы модуля необходимо, чтобы в системе (хостинг, сервер), где работает сайт, были выполнены следующие требования:
- установлен интерпретатор языка PHP версии, не ниже 7.2, [рекомендуется PHP 7.4](https://www.php.net/supported-versions.php);
- установлены расширения языка PHP:
    - [PHP Data Objects (pdo)](https://www.php.net/manual/en/book.pdo.php)
    - [Client URL Library (curl)](https://www.php.net/manual/en/book.curl.php)
    - [SimpleXML (simplexml)](https://www.php.net/manual/en/book.simplexml.php)
    - [JavaScript Object Notation (json)](https://www.php.net/manual/en/book.json.php)
    - [XMLWriter (xmlwriter)](https://www.php.net/manual/en/book.xmlwriter.php)
    - [BCMath Arbitrary Precision Mathematics (bcmath)](https://www.php.net/manual/en/book.bc)
    - [OpenSSL (openssl)](https://www.php.net/manual/en/book.openssl.php)
- установлена [CMS MODX](https://modx.com/download) не ниже версии 2.7, рекомендуется 2.8.3?
- установлен компонент [msPaymentProps](https://modstore.pro/packages/utilities/mspaymentprops) последней доступной версии.

## Использование

Основная идея модуля – максимально упростить процесс подключения платежной системы "Оплати", тем не менее, сделать этот процесс полностью автоматическим не представляется возможным. Далее предоставлены детальные описания компонентов модуля, которые следует использовать, а так же инструкции, как их настраивать и использовать.

### Системные настройки

При установке создаются системные настройки, которые используются для детальной настройки модуля оплаты. Ниже приведен их список с подробным описанием каждой.

--таблица настроек--

### Настройки метода оплаты

Для более тонкой настройки видов платежей на сайте можно использовать параметры самого метода оплаты.


### Снипет `oplati`

Так как оплата по QR-коду отличается от обычной оплаты картой, когда происходит перенаправление на сайт платежной системы для ввода данных карты, необходимо учитывать некоторые особенности и следовать определенным правилам.

// Для того, чтобы

#### Параметры снипета

- список параметров в виде таблицы?

#### Механика работы

Наборы параметров?

#### Использование собственных библиотек

Модуль генерирует QR-код на стороне клиента, т.е. в браузере и для этих целей используется библиотека --name--, которая поставляется вместе с модулем. Так же, правильная работа и внешний вид обеспечиваются с помощь небольшой приложения на Javascript и CSS-стилей. Однако, в случае необходимости, приложение и стили можно заменить собственными.

## Техническая поддержка

Техническая поддержка осуществляется через личный кабинет маркетплейса [modstore.pro](https://modstore.pro/) и в соответствии с [правилами маркетплейса](https://modstore.pro/info/rules). При покупке пакета предоставляется 1 (один) год бесплатной технической поддержки. По истечении этого срока, в случае необходимости в технической поддержке, вы можете оплатить стоимость пакета, что даст вам очередной год технической поддержки с момента оплаты.

## Авторство и лицензия

Код модуля распространяется по лицензии MIT, тем не менее распространение и продажа готового модуля, в виде собранного пакета для системы управления MODX, запрещается. При использовании частей кода, сохранение лицензии и указание авторства обязательны.

Автор исходного кода модуля и владелец прав на распространение:

- Иван Климчук | [GitHub](https://github.com/alroniks) | [Twitter](https://twitter.com/iklimchuk) | [ivan@klimchuk.com](mailto:ivan@klimchuk.com) | [klimchuk.by](https://klimchuk.by/) | [alroniks.com](https://alroniks.com)