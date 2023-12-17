const INPUT_AUTHOR = document.getElementById("inputAuthor");
const LOOKOUT_AUTHOR = document.getElementById("lookoutAuthor");

const INPUT_NAME = document.getElementById("inputName");
const LOOKOUT_NAME = document.getElementById("lookoutName");

const INPUT_DESCRIPTION = document.getElementById("inputDescription");
const LOOKOUT_DESCRTIPTION = document.getElementById("lookoutDescription");

const INPUT_PICTURE = document.getElementById("inputPic");
const LOOKOUT_PICTURE = document.getElementById("lookoutPic");

const LIST_FOR_NAMES_BY_API = document.getElementById("namesByApi");

let timeAfterLastChangeInputName = Date.now();
let lastTimeSearch = null;

let timeoutSearch = 300;

/**
 * почему bootstrap все еще не сделал выпадающий список в input type=text как что-то дефолтное... как же отвратительно он работает!
 */

function updateLookout() {
  if (INPUT_AUTHOR.value.length > 0 && INPUT_AUTHOR.value != LOOKOUT_AUTHOR.innerHTML) {
    LOOKOUT_AUTHOR.innerHTML = INPUT_AUTHOR.value;
  }

  if (INPUT_DESCRIPTION.value.length > 0 && INPUT_DESCRIPTION.value != LOOKOUT_DESCRTIPTION.innerHTML) {
    LOOKOUT_DESCRTIPTION.innerHTML = INPUT_DESCRIPTION.value;
  }

  if (INPUT_NAME.value.length > 0 && INPUT_NAME.value != LOOKOUT_NAME.innerHTML) {
    LOOKOUT_NAME.innerHTML = INPUT_NAME.value;

    timeAfterLastChangeInputName = Date.now();
  }

  if (INPUT_PICTURE.value.length > 0 && INPUT_PICTURE.value != LOOKOUT_PICTURE.src) {
    LOOKOUT_PICTURE.src = INPUT_PICTURE.value;
  }
}

setInterval(async () => {
  updateLookout()

  if (INPUT_NAME.value.length > 0 && lastTimeSearch != INPUT_NAME.value && Date.now() - timeAfterLastChangeInputName > timeoutSearch) {
    let data = await fetch(`./api/search/${INPUT_NAME.value}`);
    let dataFormed = await data.json();

    clearNamesByApi();
    lastTimeSearch = INPUT_NAME.value;

    dataFormed.forEach((albumData) => {
      addNameByApi(albumData);
    })
  }
  
}, 100);

function clearNamesByApi() {
  LIST_FOR_NAMES_BY_API.innerHTML = "";
}

function addNameByApi(data) {
  let li = document.createElement("li");
  let div = document.createElement("div");
  div.className = "dropdown-item";

  div.innerHTML = `${data.name} (От ${data.artist})`
  div.data = [data.name, data.artist, data.image[data.image.length - 2]];

  div.onclick = useDataFromApi

  li.appendChild(div);
  LIST_FOR_NAMES_BY_API.appendChild(li);
}

/**
 * 
 */
async function useDataFromApi(el) {
  let name = el.target.data[0];
  let artist = el.target.data[1];
  let image = el.target.data[2]["#text"];

  INPUT_NAME.value = name
  INPUT_AUTHOR.value = artist
  INPUT_PICTURE.value = image

  if (INPUT_DESCRIPTION.value.length == 0)
    INPUT_DESCRIPTION.value = "Description is not presented by api."
}