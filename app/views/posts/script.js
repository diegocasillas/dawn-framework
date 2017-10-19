var scoreElem = document.getElementById('score');
var score = parseInt(scoreElem.textContent);
console.log(score);
scoreElem.innerHTML = "";
for (var i = 0; i < score; i++) {
    scoreElem.innerHTML += "&#9733;";
}