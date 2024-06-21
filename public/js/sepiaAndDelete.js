window.addEventListener('DOMContentLoaded', e => {
    // ボタン要素
    const elSepia = document.querySelector('#sepia_button');
    const elBack = document.querySelector('#back_button');
    const elDel = document.querySelector('#delete_button');

    // Canvas
    const canvas = document.querySelector('#view');
    const context = canvas.getContext('2d', {willReadFrequently: true});


    // セピアボタンクリック時の処理
    elSepia.addEventListener('click', e => {
        // 読み込み日時チェック
        if (! checkTime()) {
            return;
        }

        // セピア化
        efSepia(canvas, context);
    });

    // 戻すボタンクリック時
    elBack.addEventListener('click', e => {
        if (! checkTime()) {
            return;
        }

        // 戻す
        efBack(context);
    });

    // 削除ボタンクリック時
    elDel.addEventListener('click', e => {
        const elNoView = document.querySelector('#noView');
        elNoView.style.display = 'block';
        canvas.style.display = 'none';

        canvas.removeAttribute('time');
        context.clearRect(0, 0, canvas.width, canvas.height);
    });

    // 読み込み最終時刻
    let timeOld = null;
    let imgDataCache = null;

    // 読み込み日時確認
    function checkTime() {
        const time = canvas.getAttribute('time');

        if (time === null) { return false; }

        // 読み込みが新しいか
        if (time !== timeOld) {
            // ImageDataのキャッシュを得る
            imgDataCache = context.getImageData(0, 0, canvas.width, canvas.height);
        }

        timeOld = time;

        // 正常終了
        return true;
    }

    // セピア化
    function efSepia(canvas, context) {
        const w = canvas.width;
        const h = canvas.height;
        const imgDt = context.getImageData(0, 0, w, h);
        const data = imgDt.data;

        // 画素に処理
        for (let i = 0; i < data.length; i += 4) {
            // RGBA
            const r = data[i + 0];
            const g = data[i + 1];
            const b = data[i + 2];
            const a = data[i + 3];

            // 輝度
            let Y = 0.298912 * r + 0.586611 * g + 0.114478 * b;
            Y = Math.trunc(Y);

            // 上書き
            data[i + 0] = Math.trunc(Y * 240 / 255);
            data[i + 1] = Math.trunc(Y * 200 / 255);
            data[i + 2] = Math.trunc(Y * 145 / 255);
        }

        // ImageDataオブジェクト描画
        context.putImageData(imgDt, 0, 0);
    }

    // 戻す
    function efBack(context) {
        context.putImageData(imgDataCache, 0, 0);
    }
});
