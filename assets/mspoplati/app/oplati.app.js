const oWrapper = '.oplati-wrapper';
const oCodeBlock = '.oplati-code-block';
const oInfoMessage = '.oplati-info-message';
const oHelpMessage = '.oplati-help-message';
const oMobileBlock = '.oplati-mobile-block';
const oTimerBlock = '.oplati-timer-block';
const oStatusBlock = '.oplati-status-block';

document
    .querySelectorAll(oWrapper)
    .forEach(block => {

        // console.log(block.dataset, block.dataset.path.padStart(7, '#'));

        const qrCode = new QRCode(block.querySelector(oCodeBlock), {
            width: block.dataset.size,
            height: block.dataset.size,
            colorDark: block.dataset.path.padStart(7, '#'),
            colorLight: block.dataset.fill.padStart(7, '#'),
            correctLevel: QRCode.CorrectLevel.H,
        });

        qrCode.clear();
        qrCode.makeCode(block.dataset.code);

        let start = 60;
        let interval = setInterval(() => {
            start--;
            block.querySelector(oTimerBlock).textContent = '00:' + start.toString(10).padStart(2, '0');
            // every 3 second?
            // update state?
            checkPaymentStatus(block.dataset.oid);

            if (start <= 0) {
                clearInterval(interval);
                // show button for renew
                console.log('renewwing the code');
            }
        }, 1000);
});

function checkPaymentStatus(oid) {
    let form = new FormData();
    form.set('ctx', 'web');
    form.set('action', 'check');
    form.set('id', oid);

    fetch('/assets/components/mspoplati/connector.php', {
        method: 'POST',
        body: form
    }).then(response => {
        console.log(response);
    });
}
