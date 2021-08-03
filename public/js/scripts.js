

// VARIABLES
const originSystemEl = document.querySelector('#originSystem');
const originGradeEl = document.querySelector('#originGrade');
const targetSystemEl = document.querySelector('#targetSystem');
const targetGradeEl = document.querySelector('#targetGrade');

const grades = {
    french:       ["3",     "4a",    "4b",      "4c",     "5a",    "5b",    "5c",      "6a",      "6a+",     "6b",      "6b+",       "6c",           "6c+",       "7a",        "7a+",     "7b",          "7b+",     "7c",        "7c+",       "8a",       "8a+",       "8b",      "8b+",       "8c",       "8c+",       "9a",      "9a+",       "9b"],
    yds:          ["5.4",   "5.5",   "5.6",     "5.7",    "5.8",   "5.9",   "5.10a",   "5.10b",   "5.10c",   "5.10d",   "5.11a",     "5.11b",        "5.11c",     "5.11d",     "5.12a",   "5.12b",       "5.12c",   "5.12d",     "5.13a",     "5.13b",    "5.13c",     "5.13d",   "5.14a",     "5.14b",    "5.14c",     "5.14d",   "5.15a",     "5.15b"],
    uiaa:         ["III",   "IV",    "IV+",     "V",      "V+",    "VI-",   "VI",      "VI+",     "VII-",    "VII",     "VII+",      "VII+/VIII-",   "VIII-",     "VIII",      "VIII+",   "VIII+/IX-",   "IX-",     "IX",        "IX+",       "IX+/X-",   "X-",        "X",       "X+",        "X+/XI-",   "XI-",       "XI",      "XI+",       "XII-"],
    ewbank:       ["12",    "13",    "14",      "15",     "16",    "17",    "18",      "19",      "20",      "21",      "22",        "23",           "23/24",     "24",        "25",      "26",          "26/27",   "27",        "28",        "29",       "30",        "31",      "32",        "33",       "34",        "35",      "36",        "37", ],
    brazilian:    ["2",     "2/3",   "3/3c",    "3c",     "4",     "5a",    "5b/5c",   "6a",      "6b",      "6c",      "6c/7a",     "7a/7b",        "7b",        "7c",        "8a",      "8b",          "8c",      "9a",        "9b",        "9c",       "10a",       "10b",     "10c",       "11a",      "11b",       "11c",     "12a",       "12c"],
    british:      ["H.D",   "V.D",   "H.V.D",   "M.S.",   "4a",    "4b",    "4c",      "5a",      "5b",      "5c",      "5c/6a",     "6a",           "6a/(6b)",   "(6a)/6b",   "6b",      "6b/6c",       "6c",      "6c/(7a)",   "(6c)/7a",   "7a",       "7a/(7b)",   "7a/7b",   "(7a)/7b",   "7b",       "7b/(7c)",   "7b/7c",   "(7b)/7c",   "7c/8a"]
}


let originSystem;
let originGrade;
let targetSystem;
let currentIndex;

// EVENT LISTENERS
originSystemEl.addEventListener('change', _updateOriginSystem);
originGradeEl.addEventListener('change', _updateGrades);
targetSystemEl.addEventListener('change', _updateTargetSystem);

// FUNCTIONS

function _updateOriginSystem(e) {
    originSystem = _getSelectValue(e.target);
    _resetOriginOptions();
}

function _updateTargetSystem(e) {
    targetSystem = _getSelectValue(e.target);
    _updateGrades();
}

function _updateGrades() {
    originGrade = _getSelectValue(originGradeEl);
    currentIndex = grades[originSystem].indexOf(originGrade.toString());

    if (grades[originSystem].indexOf(originGrade.toString()) >= 0) {
        _outputResult(grades[targetSystem][currentIndex]);
    }
}

// HELPER FUNCTIONS
function _getSelectValue(sel) {
    return sel.value;
}

function _resetOriginOptions() {
    originGradeEl.innerHTML = '';
    let el = document.createElement("option");
    el.textContent = '-- choose --';
    el.selected = true;
    el.disabled = true;
    originGradeEl.appendChild(el);

    for(let i = 0; i < grades[originSystem].length; i++) {
        let el = document.createElement("option");
        el.textContent = grades[originSystem][i];
        el.value = grades[originSystem][i];
        originGradeEl.appendChild(el);
    }
}

function _outputResult(result) {
    targetGradeEl.innerHTML = result;
}


// init
function init() {
    originSystem = _getSelectValue(originSystemEl);
    targetSystem = _getSelectValue(targetSystemEl);
    _resetOriginOptions();
}

init();