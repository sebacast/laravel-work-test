function addFavoriteCreateForm() {
    var formChild = document.getElementById("create-form-child");
    var formChildClon = formChild.cloneNode("create-form-child");
    var formContainer = document.getElementById("create-form-container");
    formContainer.appendChild(formChildClon);
    //formChildClon.setAttribute("id", "Div1");
}

function removeLastFavoriteCreateForm(){
    var formContainer = document.getElementById("create-form-container");
    //elimina si hay mas de 1 child 
    if(formContainer.childElementCount > 1){
        formContainer.removeChild(formContainer.lastChild);
    }   
}
