const whenSubmit = async(e) =>{

    e.preventDefault();

    const formData = new FormData(formCreation);

    const response = await fetch('back.php?create=1', {method: "POST", body: formData});
    const dataJSON = await response.json();

}


const publishButton = document.getElementById('publish');
const formCreation = document.getElementById('creaArticleForm');

formCreation.addEventListener('submit', async(e) => {

    whenSubmit(e);

})