let btn_subscribe = document.querySelector('#btn_subscribe');

btn_subscribe.onclick = () => {
    axios.post('/user/subscribe').then((response) => {
        console.log(response);
    })
};