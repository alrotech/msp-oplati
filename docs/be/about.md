#### Oplati payment system

[Oplati](https://www.o-plati.by/) is a virtual money system for paying for goods and services in Belarus. Allows you to replenish your wallet, make transfers between wallets (people) and pay for goods and services using a QR code.

#### Integration module capabilities

Данный модуль `mspOplati` предоставляет возможность интеграции платежной системы "Оплати" и интернет-магазинов, созданных на базе CMS MODX и с помощью дополнения miniShop2. Обратите внимание, что модуль не будет работать с другими решениями для создания интернет-магазинов на базе MODX Revolution.

Модуль предоставляет возможность легко настроить оплату по QR коду на сайте с помощью специального снипета, который можно вызвать практически на любой странице, лишь передав ему номер оформленного заказа. Внешний вид блока с кодом может гибко настраиваться без необходимости изменять исходный код модуля, что позволит без проблем обновляться до более свежей версии в будущем.

#### Новости и обновления

Значимые обновления будут публиковаться на сайте сообщества <a href="https://modx.pro/">modx.pro</a> в виде анонсов, подробные же изменения всегда можно найти в <a href="https://modstore.pro/packages/payment-system/mspklarna#tab/changelog">списке изменений</a>.

- <a href="https://modx.pro">Оплата по QR-коду на сайте с помощью Oplati</a>.

#### Установка, настройка и использование

Установка модуля осуществляется через административную часть вашего сайта на MODX. Для установки модуля необходимо перейти в раздел <em>Пакеты</em> и далее в <em>Установщик</em> главного меню, <a href="https://modstore.pro/info/connection">подключить репозиторий modstore.pro</a>, выбрать из списка пакетов <kbd>mspOplati</kbd> и следовать дальнейшим инструкциям установщика.

Описание процесса установки и настройки компонента, а так же справка по всем доступным параметрам конфигурации, доступна в <a href="https://docs.modx.pro/komponentyi/minishop2/moduli-oplatyi/mspklarna">подробной документации</a>.

Быстро проверить работу модуля можно используя компонент <a href="https://modx.com/extras/package/console">Console</a> (или <a href="https://modstore.pro/packages/utilities/modalconsole">modalConsole</a>). Откройте окно компонента <kbd>Console</kbd> и выполните приведенный ниже код.

<code>
require_once MODX_CORE_PATH . 'components/mspklarna/model/msppaymo/msppaymohandler.class.php';
$oid = 1; # id заказа
if ($order = $modx->getObject('msOrder', $order_id)) {
$handler = new mspKlarnaH($order);
echo $handler->getPaymentLink($order); # ссылка на оплату или ошибка в логе в случае неудачи
}</code>

В ответ вы должны получить ссылку, по которой откроется окно оплаты, либо сообщение об ошибке, если настройка модуля была выполнена неправильно.

#### Техническая поддержка

Для получения технической поддержки по этому модулю воcпользуйтесь <a href="https://modstore.pro/office/support">специальной формой</a> (доступна после авторизации). Техническая поддержка осуществляется согласно <a href="https://modstore.pro/info/rules">правилам</a> <strong>modstore</strong>.
