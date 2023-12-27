const character = document.querySelector(".character");
const contador = document.querySelector("h1");
const pao = document.querySelector(".pao");
const paoAlho = document.querySelector(".pao-alho");
const timer = document.querySelector("#timer");
const score = document.querySelector("#score");
const startScreen = document.querySelector(".start");
const btnStart = document.querySelector(".btn-start");
const gameOver = document.querySelector(".game-over");
const winner = document.querySelector(".winner");
const resetBtn = document.querySelector(".reset");

const main = document.querySelector("#main");
main.volume = 0.2;

const risa = document.querySelector("#risa");
main.volume = 0.2;

const uuu = document.querySelector("#uuu");
main.volume = 0.2;

const musicControl = document.querySelector('.music-control');

musicControl.addEventListener('click', (event) =>{
    event.stopPropagation();

    event.target.src = `${event.target.src}`.includes("on.png") 
    ? "../img/img_gu_game/icons/off.png" 
    : "../img/img_gu_game/icons/on.png";

    `${event.target.src}`.includes("on.png") ? main.play() : main.pause();
})


function mov() {
    let position = 70;
    let direcao = 'right';
    const movimentacao = setInterval(() => {
        if(position === 4){
            direcao = 'left';
        }
        if(position === 70){
            direcao = 'right';
        }
        
        if (direcao === 'left') {
            position = position + 2;
        }
        
        if (direcao === 'right') {
            position = position - 2;
        }
        character.style.right = `${position}%`;
        
        }, 90);
}

btnStart.addEventListener("click", (event)=>{
    event.stopPropagation();
    musicControl.src ="../img/img_gu_game/icons/on.png";
    main.play();
    startScreen.style.display = "none";
    btnStart.style.display = "none";
    const start = setTimeout(() => {
        showPao();
        contagem();
        mov();
    }, 800);
})


function feliz() {
    let positionCount = 0;
    let positionUp = false;
    const movimentacao2 = setInterval(() => {
        character.src = '../img/img_gu_game/gu-feliz.png';
        if (positionUp === false) {
            character.style.top = '70%';
            positionUp = true;
        }
        else{
            character.style.top = '72%';
            positionUp = false;
        }
        positionCount++;
        if (positionCount === 6) {
            clearInterval(movimentacao2);
            character.src = '../img/img_gu_game/gu-costas.png';
        }
        }, 80);
}

function triste() {
    let positionCount = 0;
    let positionUp = false;
    const movimentacao2 = setInterval(() => {
        character.src = '../img/img_gu_game//gu-triste.png';
        if (positionUp === false) {
            character.style.top = '70%';
            positionUp = true;
        }
        else{
            character.style.top = '72%';
            positionUp = false;
        }
        positionCount++;
        if (positionCount === 6) {
            clearInterval(movimentacao2);
            character.src = '../img/img_gu_game/gu-costas.png';
        }
        }, 80);
}

paoCount = 0;
paoAlhoMeta = Math.floor(Math.random() * 10)+1;

function showPao(){
    const show = setInterval(() => {
        let randomRight = Math.floor(Math.random() * 92)
        let randomTop = Math.floor(Math.random() * 70)+5;
        if(paoCount === paoAlhoMeta){
            paoAlho.style.right = `${randomRight}%`;
            paoAlho.style.top = `${randomTop}%`;
            pao.style.display = "none";
            paoAlho.style.display = "block";
            paoCount=0;
            paoAlhoMeta = Math.floor(Math.random() * 10)+1;
        } else{
            paoAlho.style.display = "none";
            pao.style.right = `${randomRight}%`;
            pao.style.top = `${randomTop}%`;
            pao.style.display = "block";
        }
        paoCount++;
    }, 800);
    
}

let statusGame = "";

function contagem(){
    let timerCount = 30;
    var count = setInterval(() => {
        if(timerCount <= 0 || statusGame === "win"){
            main.pause();
            clearInterval(count);
            gameOver.style.display = "block";
            resetBtn.style.display = "block";
        }else{
            timerCount--;
            timer.textContent = timerCount;
        }
    }, 1000);
}

scoreCount = 0;
score.textContent = scoreCount;

pao.addEventListener("click", (event) =>{
    event.stopPropagation();
    risa.play();
    feliz();
    scoreCount++;
    score.textContent = scoreCount;
    if(scoreCount >= 20){
        statusGame = "win";
        winner.style.display = "block";
        resetBtn.style.display = "block";
    }
})

paoAlho.addEventListener("click", (event) =>{
    event.stopPropagation();
    triste();
    uuu.play();
    scoreCount--;
    score.textContent = scoreCount;
})

resetBtn.addEventListener('click',() =>{
    window.location.reload();
    reset.style.display='none';
})

