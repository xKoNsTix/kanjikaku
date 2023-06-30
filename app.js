/* This website was created as MultiMediaProject 1 for MultiMediaTechnology at the Salzburg University of Applied Sciences.
Author: Jennifer Scharinger
Illustration: by pikisuperstar - www.freepik.com */

let storage = localStorage;
// Get the container element
const btnContainer = document.getElementById("buttonContainer");

// Get all buttons with class="btn" inside the container
const btns = btnContainer.getElementsByClassName("btn");

let currentCategory = "grade-1";

let lists = [];

const htmlEscapes = {
  "<": "&lt;",
  ">": "&gt;",
  '"': "&quot;",
  "'": "&#x27;",
  "`": "&#x60;",
  "&": "&amp;"
};

function htmlEscapeChar(char) {
  return htmlEscapes[char];
}

const htmlUnescape = /[<>"'`&]/g;

function escapeHtml(string) {
  return string.replace(htmlUnescape, htmlEscapeChar);
}


document.getElementById("next").onclick = checkCat;

function checkCat() {
  switch (currentCategory) {
    case 'grade-1':
    case 'grade-2':
    case 'grade-3':
    case 'grade-4':
    case 'grade-5':
      fetchCategory();
      break;
    default:
      fetchCustom();
  }
}


async function fetchCustom() {
  let daKeyzzz = getKeyByValue(lists, currentCategory);

    let kanji = fetchRandomKanji(daKeyzzz);
    let kanjiData = await fetchKanjiData(kanji);

    display(kanji, kanjiData);
}

function getKeyByValue(object, value) {   
  return Object.keys(object).filter(key => object[key] === value); 
}

async function fetchCategory() {

      const response = await fetch(`https://kanjiapi.dev/v1/kanji/${currentCategory}`);
      let data = await response.json();

      let kanji = fetchRandomKanji(data);
      let kanjiData = await fetchKanjiData(kanji);

      display(kanji, kanjiData);
  }

  function display(kanji, kanjiData) {
    displayMeaning(kanjiData);
    displayKanji(kanji);

    resetKanjiDisplay();

    ctx.clearRect(0, 0, canvas.width, canvas.height);
  }


// Returns the random single Kanji String
function fetchRandomKanji(data) {
  const randomKanji = Math.floor(Math.random() * data.length);
  let reviewKanji = data[randomKanji];
  return reviewKanji;
}

// Fetches the data for one single kanji
async function fetchKanjiData(kanji) {
  const response = await fetch(`https://kanjiapi.dev/v1/kanji/${kanji}`)
  let data = await response.json()
  
  return data;
}

// Displays the meaning of a kanji inside the review div
function displayMeaning(kanjiData) {
  document.getElementById("display-meaning").innerText = kanjiData.meanings.slice(0, 2);
  document.getElementById("display-stroke-count").innerText = kanjiData.stroke_count + " Strokes";
}

let showKanjiBtn = document.getElementById("show-kanji");
showKanjiBtn.onclick = toggleKanjiDisplay;

function displayKanji(kanji) {
  document.getElementById("display-kanji").innerText = kanji;
  document.getElementById("grab-kanji").value = kanji;
}

function toggleKanjiDisplay() {
  if (document.getElementById("display-kanji").classList.contains("hidden")) {
    document.getElementById("display-kanji").classList.remove("hidden");
    document.getElementById("show-kanji").innerText = "Hide Kanji";
  } else {
    document.getElementById("display-kanji").classList.add("hidden");
    document.getElementById("show-kanji").innerText = "Show Kanji";
  }
}

function resetKanjiDisplay() {
  document.getElementById("display-kanji").classList.add("hidden");
  document.getElementById("show-kanji").innerText = "Show Kanji";
}


// Add new list as category to the sidebar directly after save
document.getElementById('save').addEventListener('click', function() {
  
  let list = document.getElementById('list').value;
  let isKanji = document.getElementById('display-kanji').innerText;

  console.log(escapeHtml(list));
  const template = `<button class="btn py-3 px-5 font-medium text-sm bg-gray-50 text-gray-500 rounded-lg text-left border border-gray-200 hover:border-gray-300" id="${escapeHtml(list)}">${escapeHtml(list)}</button>`;

  console.log(list.length);
  console.log(isKanji);

  if (list.length == 0) {
    return;
  }

  if (!isKanji) {
    return;
  }

  for (i = 0; i < btns.length; i++) {
    if (btns[i].id == list) {
      return;
    }
  }

  const kanji = document.getElementById('display-kanji').innerText;

  document.getElementById('grade-5').insertAdjacentHTML('afterend', template);

  list.value = null;

  localStorage.setItem(kanji, list);
})


// Load buttons on sidebar when refreshing the page
window.addEventListener("load", function() {
  
  lists = { ...localStorage};

  const items = [];

  const template = 
    `<button class="btn py-3 px-5 font-medium text-sm bg-gray-50 text-gray-500 rounded-lg text-left border border-gray-200 hover:border-gray-300" id="${items}">${items}</button>`;

    Object.values(lists).forEach(value => items.push(value));

    items.forEach(value => document.getElementById('grade-5').insertAdjacentHTML('afterend', `<button class="btn py-3 px-5 font-medium bg-gray-50 text-gray-600 rounded-lg text-left border border-gray-200 hover:bg-gray-100 hover:border-gray-300" id="${value}">${value}</button>`));

    for (let i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", function() {
        let current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
        currentCategory = this.id;
      });
    }
})





