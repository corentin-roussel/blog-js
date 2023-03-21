let comment_place = document.querySelector("#place");
let displayComment = document.querySelector("#displayComment");
let repComment
let submitForm



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

    const response = await fetch("article-commentaire.php" + window.location.search + "&rep-comm=" + buttonId , {body: formRepComment, method: "POST"})
    const dataJSON = await response.json()

    displayErrorComm(dataJSON)
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
    displayForm(comment_place ,formComm);
    await displayComm();
    const commentForm = document.querySelector("#formComm")
    let comment = document.querySelector("#comment");
    repComment = document.querySelectorAll(".buttonRep")

    console.log(repComment)



    commentForm.addEventListener("submit", (e) => {
        insertComm(commentForm, e);
        displayComm();
        comment.value = ""
    })

    for(let i = 0; i < repComment.length ; i++)
    {
        repComment[i].addEventListener("click", async() => {
            formRep = await fetchFormRep()
            displayForm(repComment[i].nextSibling, formRep)
            submitRep = document.querySelectorAll("#submitRep")
            submitForm = document.querySelector("#formRep")



            for(let buttonSubmitRep = 0; buttonSubmitRep < submitForm.length; buttonSubmitRep++)
            {
                submitForm[buttonSubmitRep].addEventListener("submit", async (e) => {
                    await insertRepComm(repComment[i].id, submitForm, e)
                })
            }
        })
    }


})



const formatDate = (date) => {
    let mySQLDate = date
    let jsDate = new Date(date);
    let day = jsDate.getDate()
    let month = jsDate.getMonth()
    let year = jsDate.getFullYear()

    let hour = jsDate.getHours()
    let minutes = jsDate.getMinutes()
    let seconds = jsDate.getSeconds()

    return displayDate(day) + "-" + displayDate(month) + "-" + year + " a " + displayDate(hour) + ":" + displayDate(minutes) + ":" + displayDate(seconds)
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
        title.innerHTML = "Poster par " + comm.login
        title.setAttribute("class", "title-comment")
        comment.append(title)

        let contenu = document.createElement("p")
        contenu.innerHTML = comm.contenu;
        contenu.setAttribute("class", "para-comment")
        comment.append(contenu)

        let date = document.createElement("h6")
        date.innerHTML = "Poster le " + dateFormat
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


const displayComm = async() => {
    const response = await fetch("article-commentaire.php"+ window.location.search +"&commentaire=display")
    const json = await response.json()
    comment(json)

}
