let comment_place = document.querySelector("#place")
let comment_form = document.querySelector("#formComm")
let comm_error = document.querySelector("#errorComm")

const fetchFormComm = async () => {
    const response = await fetch("commentaire.php")
    const formComm = await response.text()

    return formComm;
}

const displayFormComm = (formComm) => {
    comment_place.innerHTML = ""
    comment_place.innerHTML = formComm
}

const insertComm = async (form, e) => {
    e.preventDefault();

    const response = await fetch("article-commentaire.php?commentaire=ok")
    const dataJSON = await response.json()

    displayErrorComm(dataJSON);
}

const displayErrorComm = (dataJSON) => {

    const errorComments = document.createElement("small")
    comm_error.appendChild(errorComment)

    if(dataJSON['errorComment']) {
        const commentProblem = document.createElement("div")
        commentProblem.innerHTML = dataJSON['errorComment']
        errorComments.appendChild(commentProblem);

    }
    if(dataJSON['success']) {
        alert(dataJSON['success']);
    }
}

const buttonComm = document.querySelector("#switchComment")
console.log(buttonComm)

buttonComm.addEventListener("click", async () => {
    formComm = await fetchFormComm();
    displayFormComm(formComm);
    let buttonSubmitComm = document.querySelector("#submitComm")

    buttonSubmitComm.addEventListener("submit", (e) => {
        insertComm(formComm, e)
    })
})