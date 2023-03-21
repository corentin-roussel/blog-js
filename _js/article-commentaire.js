let comment_place = document.querySelector("#place");
let displayComment = document.querySelector("#displayComment");
let repComment
let submitForm

/********************************* Fetch/DisplayForm *********************************/

const fetchFormComm = async () => {
    const response = await fetch("commentaire.php?post_comm=ok")
    const formComm = await response.text()

    return formComm;
}

const fetchFormRep = async() => {
    const response = await fetch("commentaire.php?rep_comm=ok")
    const formRep = await response.text();

    return formRep;
}


const displayForm = (place, form) => {
    place.innerHTML = ""
    place.innerHTML = form
}

/********************************* InsertComm *********************************/

const insertComm = async (form, e) => {

    e.preventDefault();
    let formComment = new FormData(form)

    const response = await fetch("article-commentaire.php" + window.location.search + "&commentaires=ok" , {body: formComment ,method: "POST"})
    const dataJSON = await response.json()

    displayErrorComm(dataJSON);
}

const insertRepComm = async (buttonId ,form,e) => {

    e.preventDefault();
    let formRepComment = new FormData(form)

    const response = await fetch("article-commentaire.php" + window.location.search + "&insert_rep=" + buttonId , {body: formRepComment, method: "POST"})
    const dataJSON = await response.json()

    displayErrorRepComm(dataJSON)
}

/********************************* ErrorComm *********************************/

const displayErrorComm = (dataJSON) => {

    let comm_error = document.querySelector("#errorComm");
    comm_error.innerHTML = "";


    const errorComments = document.createElement("small");
    comm_error.appendChild(errorComments);

    if(dataJSON['errorComment']) {
        errorComments.innerHTML = dataJSON['errorComment'];

    }
    if(dataJSON['success']) {
        alert(dataJSON['success']);
    }
}

const displayErrorRepComm = (dataJSON) => {

    let comm_rep_error = document.querySelector("#errorRep");
    comm_rep_error.innerHTML = "";

    const errorComments = document.createElement("small");
    comm_rep_error.appendChild(errorComments);

    if(dataJSON['errorRepComment']) {
        errorComments.innerHTML = dataJSON['errorRepComment'];

    }
    if(dataJSON['success']) {
        alert(dataJSON['success']);
    }
}



/********************************* displayComm *********************************/

const formatDate = (date) => {
    let mySQLDate = date
    let jsDate = new Date(date);
    let day = jsDate.getDate()
    let month = jsDate.getMonth()
    let year = jsDate.getFullYear()

    let hour = jsDate.getHours()
    let minutes = jsDate.getMinutes()
    let seconds = jsDate.getSeconds()

    return displayDate(day) + "-" + displayDate(month) + "-" + year + " at " + displayDate(hour) + ":" + displayDate(minutes) + ":" + displayDate(seconds)
}
const displayDate = (date) => {
    return (date < 10) ? '0' + date : date
}

const comment = (reponse) => {
    displayComment.innerHTML = "";

    for(let comm of reponse)
    {
        const dateFormat = formatDate(comm.date_creation)

        let comment = document.createElement("div")
        comment.setAttribute("class", "comment")
        displayComment.append(comment)

        let title = document.createElement("h3")
        title.innerHTML = "Posted by " + comm.login
        title.setAttribute("class", "title-comment")
        comment.append(title)

        let contenu = document.createElement("p")
        contenu.innerHTML = comm.contenu;
        contenu.setAttribute("class", "para-comment")
        comment.append(contenu)

        let date = document.createElement("h6")
        date.innerHTML = "Posted the " + dateFormat
        comment.append(date)

        let buttonRep = document.createElement("button")
        buttonRep.setAttribute("class", "buttonRep")
        buttonRep.setAttribute("id", comm.id)
        buttonRep.innerHTML = "Respond"
        comment.append(buttonRep)

        let place = document.createElement("div")
        place.setAttribute("class", "formRep")
        comment.append(place)

        let br = document.createElement("hr")
        br.setAttribute("class", "br-comment")
        comment.append(br)

    }
}

const responseComment = (reponse) => {
    for(let comm of reponse)
    {
        const dateFormat = formatDate(comm.date_creation)

        let comment = document.createElement("div")
        comment.setAttribute("class", "rep-comment")
        displayComment.append(comment)

        let title = document.createElement("h3")
        title.innerHTML = "Posted by " + comm.login
        title.setAttribute("class", "title-rep-comment")
        comment.append(title)

        let contenu = document.createElement("p")
        contenu.innerHTML = comm.contenu;
        contenu.setAttribute("class", "para-rep-comment")
        comment.append(contenu)

        let date = document.createElement("h6")
        date.innerHTML = "Posted the " + dateFormat
        comment.append(date)

        let br = document.createElement("hr")
        br.setAttribute("class", "br-comment")
        comment.append(br)

    }
}


const displayComm = async() => {
    const response = await fetch("article-commentaire.php"+ window.location.search +"&commentaire=display")
    const json = await response.json()
    comment(json)

}

const displayRepComm = async(buttonId) => {
    const response = await fetch("article-commentaire.php"+window.location.search + "&response_comm=" +buttonId)
    const json = await response.json()
    responseComment(json);
}

/********************************* displayComm *********************************/
window.addEventListener("load", async () => {
    formComm = await fetchFormComm();
    displayForm(comment_place ,formComm);
    await displayComm();
    const commentForm = document.querySelector("#formComm")
    let comment = document.querySelector("#comment");
    repComment = document.querySelectorAll(".buttonRep")
    let div_rep = document.querySelectorAll(".formRep")
    console.log(div_rep)

    console.log(repComment)



    commentForm.addEventListener("submit", (e) => {
        insertComm(commentForm, e);
        displayComm();
        comment.value = ""
    })

    for(let i = 0; i < repComment.length ; i++)
    {
        repComment[i].addEventListener("click", async() => {
            for(let j = 0; j < div_rep.length; j++)
            {
                div_rep[j].innerHTML = ""
            }
            formRep = await fetchFormRep()
            displayForm(repComment[i].nextSibling, formRep)
            console.log(div_rep)
            submitForm = document.querySelector("#formSubmitRep")
            let id_repComm =repComment[i].id


            submitForm.addEventListener("submit",  (e) => {
                insertRepComm(id_repComm , submitForm, e)
                displayRepComm(id_repComm);
            })
            await displayRepComm(id_repComm);
        })
    }
})
