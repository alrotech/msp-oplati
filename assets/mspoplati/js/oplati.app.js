
let blocks = document.querySelectorAll('.oplati-qr-code');

console.log(blocks)

blocks.forEach(block => {
    console.log(block);

    console.log(
        block.dataset.size,
        block.dataset.fill,
        block.dataset.path,
        block.dataset.code,
    );

    const codeBlock = block.querySelector('.code');

    console.log(codeBlock);

    const qrCode = new QRCode(codeBlock, {
        width: block.dataset.size,
        height: block.dataset.size,
        colorDark : "#cc0000",
        colorLight : "#ffff00",
        correctLevel : QRCode.CorrectLevel.H,
    });

    qrCode.clear();
    qrCode.makeCode(block.dataset.code);
});

// const QR_CODE = new QRCode("qrcode", {
//     width: 220,
//     height: 220,
//     colorDark: "#000000",
//     colorLight: "#ffffff",
//     correctLevel: QRCode.CorrectLevel.H,
// });
