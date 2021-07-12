<div class="oplati-wrapper"
     data-size="[[+size]]" data-fill="[[+fill]]" data-path="[[+path]]" data-code="[[+code]]"
data-pid="[[+pid]]">

    <span class="oplati-info-message">[[%oplati-info-message]] //
        [[%oplati_info_message? &namespace=`namespace_name`]]</span>
{*    Оплата заказа №num*}

    <div class="oplati-code-block"></div>

    {*    todo: to lexicons*}
    <span class="oplati-help-message">[[%oplati-help-message]]</span>
{*    Отсканируйте QR-код приложением Oplati.*}

    <button class="button">Проверить платеж</button>

    <div class="oplati-mobile-block">
        <button class="oplati-mobile-button">[[%oplati-mobile-button]]</button>
{*        Оплатить через "Оплати"*}
    </div>

    <div class="oplati-timer-block"></div>
    <div class="oplati-status-block"></div>
</div>
