const oWrapper = '.oplati-wrapper';
const oCodeBlock = '.oplati-code-block';
const oInfoMessage = '.oplati-info-message';
const oHelpMessage = '.oplati-help-message';
const oMobileBlock = '.oplati-mobile-block';
const oTimerBlock = '.oplati-timer-block';
const oStatusBlock = '.oplati-status-block';

function determineLibraryPath(filename) {
    const scripts = document.getElementsByTagName("script");
    const relative = scripts[scripts.length-1].src
        .replace(window.location.origin, '')
        .split('/').slice(0, -1).join('/');

    return [relative, filename].join('/');
}

function loadQRCodeLibrary(url, callback) {
    let script = document.createElement("script");
    script.type = "text/javascript";
    script.src = url;

    script.onreadystatechange = callback;
    script.onload = callback;

    document.body.appendChild(script);
}

function initQRCodeBlock()
{
    document
        .querySelectorAll(oWrapper)
        .forEach(block => {

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
            let threshold = 3;
            let interval = setInterval(() => {
                if (start < 1) {
                    clearInterval(interval);
                    // show button for renew
                    // console.log('renewwing the code');
                }

                block.querySelector(oTimerBlock).textContent = '00:' + start.toString(10).padStart(2, '0');
                start--;

                // every 3 seconds
                if (start % threshold === 0) {
                    checkPaymentStatus(block.dataset.oid).then((data) => {
                        block.querySelector(oStatusBlock).textContent = data['object'].properties.humanStatus;
                    });
                }
            }, 1000);
        });
}

async function checkPaymentStatus(oid) {
    let form = new FormData();
    form.set('ctx', 'web');
    form.set('action', 'check');
    form.set('id', oid);

    const response = await fetch('/assets/components/mspoplati/connector.php', {
        method: 'POST',
        body: form
    })

    return await response.json();
}

loadQRCodeLibrary(determineLibraryPath('qrcode.min.js'), initQRCodeBlock);
