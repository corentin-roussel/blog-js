let comment_place = document.querySelector("#place")
let comment_form = document.querySelector("#formComm")
let comment = document.querySelector("#comment");




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
    let formComment = new FormData(form)

    const response = await fetch("article-commentaire.php?commentaires=ok", {body: formComment ,method: "POST"})
    const dataJSON = await response.json()

    displayErrorComm(dataJSON);
}

const displayErrorComm = (dataJSON) => {

    let comm_error = document.querySelector("#errorComm")

    const errorComments = document.createElement("small")
    comm_error.appendChild(errorComments)

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
    const commentForm = document.querySelector("#formComm")
    let comment = document.querySelector("#comment");
    console.log(commentForm)
    console.log(comment);


    commentForm.addEventListener("submit", (e) => {
        insertComm(commentForm, e);
    })
})


const displayComm = () => {

}