let comment_place = document.querySelector("#place")
let displayComment = document.querySelector("#displayComment");




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

    const response = await fetch("article-commentaire.php" + window.location.search + "&commentaires=ok" , {body: formComment ,method: "POST"})
    const dataJSON = await response.json()

    displayErrorComm(dataJSON);
}

const displayErrorComm = (dataJSON) => {

    let comm_error = document.querySelector("#errorComm");
    comm_error.innerHTML = "";

    const errorComments = document.createElement("small");
    comm_error.appendChild(errorComments);

    if(dataJSON['errorComment']) {
        const commentProblem = document.createElement("div");
        commentProblem.innerHTML = dataJSON['errorComment'];
        errorComments.appendChild(commentProblem);

    }
    if(dataJSON['success']) {
        alert(dataJSON['success']);
    }
}


window.addEventListener("load", async () => {
    formComm = await fetchFormComm();
    displayFormComm(formComm);
    const commentForm = document.querySelector("#formComm")
    let comment = document.querySelector("#comment");


    commentForm.addEventListener("submit", (e) => {
        insertComm(commentForm, e);
        displayComm();
    })
})


window.addEventListener("load", () => {
    displayComm();
})


const comment = (reponse) => {
    displayComment.innerHTML = "";

    for(let comm of reponse)
    {
        let title = document.createElement("h3")
        title.innerHTML = "Fait par " + comm.login + " le " + comm.date_creation;
        title.setAttribute("class", "title-comment")
        displayComment.append(title)

        let contenu = document.createElement("p")
        contenu.innerHTML = comm.contenu;
        contenu.setAttribute("class", "para-comment")
        displayComment.append(contenu)

        let br = document.createElement("hr")
        br.setAttribute("class", "br-comment")
        displayComment.append(br)
    }
}


const displayComm = async() => {
    const response = await fetch("article-commentaire.php"+ window.location.search +"&commentaire=display")
    const json = await response.json()
    let display = comment(json)

}