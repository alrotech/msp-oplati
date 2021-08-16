const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

const oContainer = 'oplati-container';
const oCodeBlock = '.oplati-code-block';
const oTimerBlock = '.oplati-timer-block';
const oStatusBlock = '.oplati-status-block';
const oRenewBlock = '.oplati-renew-block';

const threshold = 3; // check status every 3 seconds

let timer;
// let duration = 7; // in seconds

// https://shop.local.docker/orders.html?msorder=148

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

let ticker = function(block, code, defduration = 7) {
    let duration = defduration;

    console.log(duration);

    block.querySelector(oTimerBlock).textContent = '00:' + duration.toString().padStart(2, '0');
    duration--;

    console.log(duration);


    // if (start % threshold === 0 && start >= threshold) {
    if (duration % threshold === 0 || duration < 1) {
        requestBackend(block.dataset.oid, 'check').then((data) => {
            block.querySelector(oStatusBlock).textContent = data['object'].properties.humanStatus;
        });
    }

    if (duration < 1) {
        clearInterval(timer);
        hide(block.querySelector(oTimerBlock));
        show(block.querySelector(oRenewBlock)).addEventListener('click', function (e) {
            e.preventDefault();
            requestBackend(block.dataset.oid, 'renew').then((data) => {
                block.dataset.code = data['object'].properties.dynamicQR;

                hide(block.querySelector(oRenewBlock));
                show(block.querySelector(oTimerBlock)).textContent = '--:--';

                code.clear();
                code.makeCode(block.dataset.code);

                console.log('renew code');

                // duration = 7;
                timer = window.setInterval(ticker, 1000, block, code);
            })
        });
    }
}

function initQRCodeBlock()
{
    if (isMobile) {
        return;
    }

    let container = document.getElementById(oContainer);

    const qrCode = new QRCode(empty(container.querySelector(oCodeBlock)), {
        width: container.dataset.size,
        height: container.dataset.size,
        colorDark: container.dataset.path.padStart(7, '#'),
        colorLight: container.dataset.fill.padStart(7, '#'),
        correctLevel: QRCode.CorrectLevel.H,
    });

    qrCode.clear();
    qrCode.makeCode(container.dataset.code);

    // duration = 7;
    timer = window.setInterval(ticker, 1000, container, qrCode);

            // let interval = setInterval(() => {
            //     block.querySelector(oTimerBlock).textContent = '00:' + start.toString(10).padStart(2, '0');
            //     start--;
            //
            //     // if (start % threshold === 0 && start >= threshold) {
            //     if (start % threshold === 0 || start < 1) {
            //         requestBackend(block.dataset.oid, 'check').then((data) => {
            //             block.querySelector(oStatusBlock).textContent = data['object'].properties.humanStatus;
            //         });
            //     }
            //
            //     if (start < 1) {
            //         clearInterval(interval);
            //
            //         hide(block.querySelector(oTimerBlock));
            //
            //         show(block.querySelector(oRenewBlock)).addEventListener('click', function (e) {
            //             e.preventDefault();
            //             requestBackend(block.dataset.oid, 'renew').then((data) => {
            //                 block.dataset.code = data['object'].properties.dynamicQR;
            //                 // initQRCodeBlock();
            //
            //                 hide(block.querySelector(oRenewBlock));
            //                 show(block.querySelector(oTimerBlock)).textContent = '--:--';
            //
            //                 qrCode.clear();
            //                 qrCode.makeCode(block.dataset.code);
            //
            //                 // simple reset values, no more
            //             })
            //         });
            //     }
            // }, 1000);
        // });
}

async function requestBackend(oid, action, context = 'web') {
    let form = new FormData();
    form.set('ctx', context);
    form.set('action', action);
    form.set('id', oid);

    const response = await fetch('/assets/components/mspoplati/connector.php', {
        method: 'POST',
        body: form
    });

    return await response.json();
}

loadQRCodeLibrary(determineLibraryPath('qrcode.min.js'), initQRCodeBlock);

const show = function (elem) { elem.style.display = 'block'; return elem; };
const hide = function (elem) { elem.style.display = 'none';  return elem; };
const empty = function (elem) { elem.textContent = ''; return elem; }
