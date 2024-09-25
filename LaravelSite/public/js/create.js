let btn = document.getElementById("btn1");
btn.addEventListener("click", myFunc);

let form = document.getElementById("input");

function myFunc() {
    let name = document.getElementById("artist_name");
    let genre = document.getElementById("genre");
    let desc = document.getElementById("desc");

    alert(name.value + "\n" + genre.value + "\n" + desc.value);
}

function addFn() {
    let divEle = document.getElementById("tracks_field");
    let wrapper = document.createElement("div");
    let iField = document.createElement("input");

    iField.setAttribute("type", "text");
    iField.setAttribute("placeHolder", "Enter Value");
    iField.classList.add("input-field");
    wrapper.appendChild(iField);
    divEle.appendChild(wrapper);
}
