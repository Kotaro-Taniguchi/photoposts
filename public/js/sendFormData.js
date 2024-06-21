window.addEventListener('DOMContentLoaded', e => {
    // 要素
    const elSubmit = document.querySelector('#submit_button');

    // submitボタンがクリックされた時
    elSubmit.addEventListener('click', e => {
        const canvas = document.querySelector('#view');
        const elPost = document.querySelector('#post');
        const post = elPost.value;

        // 送信用データ準備
        const formData = new FormData();

        if (post.length > 0) {
            formData.append('post', post);
        }

        if (canvas.getAttribute('time') !== null) {  // canvasに画像が描画されていれば
            // canvasを指定された形式のdataURLにする
            const canvasData = canvas.toDataURL('image/jpeg');
            formData.append('image_file', canvasData);
        }

        fetch('/posts', {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
            body: formData
        })
        .then(response => {
            if (response.status === 200) {
                location.href = '/';
            } else {
                return response.json();
            }
        })
        .then(res => {
            const error_messages = [];
            if (res['errors']['image_file'] !== undefined) {
                error_messages.push(res['errors']['image_file'][0]);
            }
            if (res['errors']['post'] !== undefined) {
                error_messages.push(res['errors']['post'][0]);
            }
            const elImageArea = document.querySelector('#imageArea');
            const elContainer = document.querySelector('#container');
            const elDivPrev = document.querySelectorAll('.alert.alert-error.mb-4');
            if (elDivPrev.length > 0) {
                elDivPrev.forEach((elDivPrevEach) => {
                   elContainer.removeChild(elDivPrevEach);
                });
            }
            error_messages.forEach((error_message) => {
                const elDiv = document.createElement('div');
                elDiv.classList.add('alert', 'alert-error', 'mb-4');
                elDiv.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>${error_message}`;
                elContainer.insertBefore(elDiv, elImageArea);
            });
        })
        .catch(error => {
            console.log(error);
        });
    });
});
