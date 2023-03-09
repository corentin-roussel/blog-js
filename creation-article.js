const whenSubmit = async(e) => {

    e.preventDefault();

    const formData = new FormData(formCreation);

    const response = await fetch('back.php?create=1', {method: "POST", body: formData});
    const dataJSON = await response.json();

    displayErrors(dataJSON);

}

const displayErrors = async(dataJSON) => {

    const errorTitleDiv = document.getElementById('errorTitre');
    errorTitleDiv.innerHTML = "";

    const errorContentDiv = document.getElementById('errorContent');
    errorContentDiv.innerHTML = "";

    const errorCategorieDiv = document.getElementById('errorCategorie');
    errorCategorieDiv.innerHTML = "";

    const successDiv = document.getElementById('success');
    successDiv.innerHTML = "";

    if(dataJSON['errorTitre']) {
        const paraErrorTitle = document.createElement("p");
        paraErrorTitle.textContent = dataJSON['errorTitre'];
        errorTitleDiv.appendChild(paraErrorTitle);
    }

    if(dataJSON['errorContent']) {
        const paraErrorContent = document.createElement("p");
        paraErrorContent.textContent = dataJSON['errorContent'];
        errorContentDiv.appendChild(paraErrorContent);
    }

    if(dataJSON['errorCategorie']) {
        const paraErrorCategorie = document.createElement("p");
        paraErrorCategorie.textContent = dataJSON['errorCategorie'];
        errorCategorieDiv.appendChild(paraErrorCategorie);
    }

    if(dataJSON['success']) {
        alert(dataJSON['success']);
    }
}


const publishButton = document.getElementById('publish');
const formCreation = document.getElementById('creaArticleForm');

formCreation.addEventListener('submit', async(e) => {

    whenSubmit(e);

})