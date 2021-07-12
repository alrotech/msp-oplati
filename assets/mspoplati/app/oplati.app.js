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

        const oplatiinfomessage = '';


    console.log(
        block.dataset.size,
        block.dataset.fill,
        block.dataset.path,
        block.dataset.code,
    );

    const codeBlock = block.querySelector(oCodeBlock);

    const qrCode = new QRCode(codeBlock, {
        width: block.dataset.size,
        height: block.dataset.size,
        colorDark : block.dataset.path,
        colorLight : block.dataset.fill,
        correctLevel : QRCode.CorrectLevel.H,
    });

    qrCode.clear();
    qrCode.makeCode(block.dataset.code);

    // setInterval();

    const button = block.querySelector('.button');

    console.log(button);

    button.addEventListener('click', function () {

        const urlParams = new URLSearchParams(window.location.search);
        const orderId = urlParams.get('msorder');

        let form = new FormData();
        form.set('ctx', 'web');
        form.set('action', 'check');
        form.set('id', orderId);

        fetch("/assets/components/mspoplati/connector.php", {
            method: "POST",
            body: form
        }).then(res => {
            console.log("Request complete!, resp: ", res);
        });

    });
});

// check payment
// request new code
