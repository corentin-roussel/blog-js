const imageDisplay = document.getElementById('profileImage');
const form = document.getElementById('changePPform');

form.addEventListener('submit', async(e) => {

    e.preventDefault();

    const image = document.getElementById('picture');

    const formData = new FormData();

    formData.append('file', image.files[0]);

    const response = await fetch('back.php?setPicture=1', {method: "POST", body: formData});
    const message = await response.text();

    console.log(image.files[0]);

})