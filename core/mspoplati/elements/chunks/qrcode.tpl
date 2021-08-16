<div id="oplati-container" class="oplati-wrapper" data-size="[[+size]]" data-fill="[[+fill]]" data-path="[[+path]]" data-code="[[+code]]" data-oid="[[+oid]]">

    <span class="oplati-info-message">[[%oplati-info-message? &num=`[[+num]]`]]</span>
    <div class="oplati-code-block"></div>
    <span class="oplati-help-message">[[%oplati-help-message]]</span>

    <div class="oplati-mobile-block">
        <a href="https://getapp.o-plati.by/map/?app_link=[[+code]]" class="oplati-mobile-button">[[%oplati-mobile-button-text]]</a>
    </div>

    <div class="oplati-timer-block">--:--</div>

    <div class="oplati-renew-block">
        <button class="oplati-renew-button">
            <svg height="1rem" width="1rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512.004 512.004">
                <path d="M508.034 133.475l-112-128c-6.08-6.944-18.016-6.944-24.096 0l-112 128c-4.128 4.704-5.12 11.424-2.528 17.152 2.624 5.728 8.32 9.376 14.592 9.376h48v186.176c0 41.408-14.24 82.016-40.096 114.368l-20.384 25.472c-4.192 5.248-4.672 12.576-1.184 18.304 2.944 4.832 8.16 7.68 13.664 7.68 1.024 0 2.08-.096 3.136-.32 100.16-20.032 172.864-108.672 172.864-210.848V160.003h48c6.272 0 11.968-3.648 14.56-9.376 2.624-5.728 1.6-12.448-2.528-17.152zm-76.032-5.472c-8.832 0-16 7.168-16 16v156.832c0 69.376-39.392 131.456-98.656 162.368 22.464-34.656 34.656-75.52 34.656-117.024V144.003c0-8.832-7.168-16-16-16h-28.736l76.736-87.68 76.736 87.68h-28.736z"/>
                <path d="M240.002 352.003h-48V165.827c0-41.408 14.24-82.016 40.096-114.368l20.384-25.44c4.192-5.28 4.704-12.576 1.184-18.336-3.488-5.76-10.08-8.704-16.8-7.36C136.706 20.355 64.002 108.995 64.002 211.171v140.832h-48c-6.272 0-11.968 3.648-14.56 9.376-2.624 5.728-1.6 12.448 2.528 17.152l112 128c3.04 3.488 7.424 5.472 12.032 5.472s8.992-2.016 12.032-5.472l112-128c4.128-4.704 5.12-11.424 2.528-17.152-2.592-5.728-8.288-9.376-14.56-9.376zm-112 119.68l-76.736-87.68h28.736c8.832 0 16-7.168 16-16V211.171c0-69.376 39.392-131.488 98.656-162.4-22.464 34.688-34.656 75.552-34.656 117.056v202.176c0 8.832 7.168 16 16 16h28.736l-76.736 87.68z"/>
            </svg>
            <span>[[%oplati-renew-button-text]]</span>
        </button>
    </div>

    <div class="oplati-status-block">[[%oplati-status-in-progress]]</div>
</div>
