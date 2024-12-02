let TrapacaVal = 0
let IntervaloTimer;
let TempoSobrando = 300;
let TempoDecorido = 0;

function Iniciar(){
    startGame();
}

function startGame(){
    event.preventDefault()
    celulasAbertas = []
    boardReal = []
    createBoard()
    let input_timer = document.getElementById('tempo-partida');
    input_timer.value = "00:00"
}

function startTimer(modalidadeVal, totalSeconds) {
    let input_timer = document.getElementById('tempo-partida');
    input_timer.value = ""
    let minutos, segundos;

    if(modalidadeVal == "Rivotril"){
        TempoSobrando = totalSeconds;
        IntervaloTimer = setInterval(() => {
            minutos = Math.floor(TempoSobrando / 60);
            segundos = TempoSobrando % 60;


            input_timer.value = `${minutos}:${segundos < 10 ? '0' : ''}${segundos}`;

            if (TempoSobrando <= 0) {
                clearInterval(IntervaloTimer);
            }

            TempoSobrando--;
        }, 1000);
    }else{
        TempoDecorido = 0;
        IntervaloTimer = setInterval(() => {
            minutos = Math.floor(TempoDecorido / 60);
            segundos = TempoDecorido % 60;

            input_timer.value = `${minutos}:${segundos < 10 ? '0' : ''}${segundos}`;

            TempoDecorido++;
        }, 1000);
    }
}

function stopTimer() {
    clearInterval(IntervaloTimer);
    if(modalidadeVal == "Rivotril"){
        return `${Math.floor(TempoSobrando / 60)}m ${TempoSobrando % 60}s`
    }else{
        return `${Math.floor(TempoDecorido / 60)}m ${TempoDecorido % 60}s`
    }
}





function createBoard(){
    clearBoard()

    board = document.getElementById("gameBoard")
    largura = document.getElementById("largura-campo").value
    altura = document.getElementById("altura-campo").value
    bombas = document.getElementById("numero-bombas").value 

    if (largura * altura < bombas) {
        alert("Numero de Bombas Maior que o Numero de Campos");
        return;
    }
    if (largura === "" || largura <= 0) {
        alert("Campo Largura Vazio ou com valor inválido. Por favor, preencha com um valor válido.");
        return;
    }
    if (altura === "" || altura <= 0) {
        alert("Campo Altura Vazio ou com valor inválido. Por favor, preencha com um valor válido.");
        return;
    }
    if (bombas === "" || bombas <= 0) {
        alert("Campo Número de Bombas Vazio ou com valor inválido. Por favor, preencha com um valor válido.");
        return;
    }
    if (largura * altura > 6400) {
        alert("Numero Máximo de Células Excedido");
        return;
    }

    celula = 1;
    for(index=0;index<altura;index++){
        let alturaAtual = []

        for(inIndex=0;inIndex<largura;inIndex++){
            
            alturaAtual.push(0)

            newCelula = document.createElement("img")
            newCelula.classList.add("cellBlock")
            newCelula.setAttribute("id", celula.toString())
            newCelula.setAttribute("src", "stylesheets/Img/board/Empty.png")
            newCelula.setAttribute("onclick", `checkBomb(${celula})`)
            newCelula.setAttribute("alt", `${celula}ª celula do jogo`)
            celula++;
            board.appendChild(newCelula);
        }
        boardReal.push(alturaAtual)

        broke = document.createElement("br")
        board.appendChild(broke)
    }

    while(bombas > 0){
        
        let variacao = Math.floor(Math.random()*(altura*largura))
        
        let celulaAtual = 0

        for(index=0;index<altura;index++){
            for(inIndex=0;inIndex<largura;inIndex++){
                //if(!((celulaAtual == variacao) && (boardReal[index][inIndex] != 1))){
                if(celulaAtual == variacao){
                    if(boardReal[index][inIndex] < 1){
                        boardReal[index][inIndex] = 1
                        bombas--;
                    }
                }
                celulaAtual++;
            }
        }
    }
    board.style.height  = (2.5*altura)  +'vw'
    board.style.width   = (2.5*largura) +'vw'
}


function clearBoard(){
    board = document.getElementById("gameBoard")
    while(board.firstChild){
        board.removeChild(board.firstChild)
    }
    boardReal.splice(0, boardReal.length)
}

function checkBomb(posicaoBomba){
    let gameBoard = document.getElementById("gameBoard");
    let images_list = gameBoard.getElementsByTagName("img");

    let check_first_click = Array.from(images_list).every(img => img.src.includes("Empty.png"));

    if (check_first_click) {
        modalidadeVal = document.getElementById("modalidade").value
        largura = document.getElementById("largura-campo").value
        altura = document.getElementById("altura-campo").value
        totalSeconds = (Math.ceil(Math.sqrt(largura * altura))/2)* 60;
        stopTimer()
        startTimer(modalidadeVal, totalSeconds)
    }
    
    celulaAtual = 1

    for(index=0;index<altura;index++){
        for(inIndex=0;inIndex<largura;inIndex++){
            if(celulaAtual == posicaoBomba){
                if(boardReal[index][inIndex] == 1){
                    //quando a bomba explode
                    let imgElement = document.getElementById(posicaoBomba)
                    showBombas();
                    Perdeu();
                    imgElement.setAttribute("src","stylesheets/Img/board/Bomb.png" )
                }
                else{
                    cleanSides(celulaAtual, index, inIndex);
                }
            }
            celulaAtual++;
        }
    }
    board = document.getElementById("gameBoard")
    checkVenceu()
}



function cleanSides(celulaAtual, hIndex, wIndex) {
    altura = parseInt(document.getElementById("altura-campo").value);
    largura = parseInt(document.getElementById("largura-campo").value);

    let imgElement = document.getElementById(celulaAtual);
    
    // Checa se a célula já foi aberta
    if (celulasAbertas.includes(celulaAtual)) {
        return; // Se já foi aberta, sai da função
    }
    
    // Marca a célula como aberta
    celulasAbertas.push(celulaAtual);

    if (boardReal[hIndex][wIndex] < 1) {
        if (howManyBombas(hIndex, wIndex) > 0) {
            imgElement.setAttribute("src", `stylesheets/Img/board/EmptyClicadoNumber${howManyBombas(hIndex, wIndex)}.png`);
        } else {
            imgElement.setAttribute("src", "stylesheets/Img/board/emptyClicked.png");
            
            // Verifica as células adjacentes
            for (let x = -1; x <= 1; x++) {
                for (let y = -1; y <= 1; y++) {
                    if (x === 0 && y === 0) continue; // Ignora a célula atual
                    let newHIndex = hIndex + x;
                    let newWIndex = wIndex + y;

                    // Verifica se a nova posição está dentro dos limites do tabuleiro
                    if (newHIndex >= 0 && newHIndex < altura && newWIndex >= 0 && newWIndex < largura) {
                        let newCelula = newHIndex * largura + newWIndex + 1; // Cálculo da nova posição
                        cleanSides(newCelula, newHIndex, newWIndex); // Chama recursivamente
                    }
                }
            }
        }
    }
}

function howManyBombas(hIndex,wIndex){
    largura = document.getElementById("largura-campo").value
    altura = document.getElementById("altura-campo").value
    let bombasVisinhas = 200
    //verifica bombas no centro
    if(hIndex>0 && hIndex<altura-1 && wIndex>0 && wIndex<largura-1)
        bombasVisinhas = boardReal[hIndex-1][wIndex] + boardReal[hIndex+1][wIndex] + boardReal[hIndex][wIndex+1] + boardReal[hIndex][wIndex-1] + boardReal[hIndex-1][wIndex-1] + boardReal[hIndex+1][wIndex+1] + boardReal[hIndex-1][wIndex+1] + boardReal[hIndex+1][wIndex-1]
    //verifica as bombas na esquerda
    if(hIndex>0 && hIndex<altura-1 && wIndex==0)
        bombasVisinhas = boardReal[hIndex-1][wIndex] + boardReal[hIndex+1][wIndex] + boardReal[hIndex][wIndex+1] + boardReal[hIndex+1][wIndex+1] + boardReal[hIndex-1][wIndex+1]
    //verifica as bombas na direita
    if(hIndex>0 && hIndex<altura-1 && wIndex==largura-1)
        bombasVisinhas = boardReal[hIndex-1][wIndex] + boardReal[hIndex+1][wIndex] + boardReal[hIndex][wIndex-1] + boardReal[hIndex+1][wIndex-1] + boardReal[hIndex-1][wIndex-1]
    //verifica as bombas no topo
    if(hIndex==0 && wIndex>0 && wIndex<largura-1)
        bombasVisinhas = boardReal[hIndex][wIndex-1] + boardReal[hIndex][wIndex+1] + boardReal[hIndex+1][wIndex] + boardReal[hIndex+1][wIndex-1] + boardReal[hIndex+1][wIndex+1]
    //verifica as bombas na base
    if(hIndex==altura-1 && wIndex>0 && wIndex<largura-1)
        bombasVisinhas = boardReal[hIndex][wIndex-1] + boardReal[hIndex][wIndex+1] + boardReal[hIndex-1][wIndex] + boardReal[hIndex-1][wIndex-1] + boardReal[hIndex-1][wIndex+1]
    //verifica as bombas nos cantos
        //canto esquerdo superior
    if(hIndex == 0 && wIndex == 0)
        bombasVisinhas = boardReal[hIndex+1][wIndex+1] + boardReal[hIndex][wIndex+1] + boardReal[hIndex+1][wIndex]
        //canto direito superior
    if(hIndex == 0 && wIndex == largura-1)
        bombasVisinhas = boardReal[hIndex+1][wIndex] + boardReal[hIndex+1][wIndex-1] + boardReal[hIndex][wIndex-1]
        //canto esquerdo inferior
    if(hIndex == altura-1 && wIndex==0)
        bombasVisinhas = boardReal[hIndex][wIndex+1] + boardReal[hIndex-1][wIndex+1] + boardReal[hIndex-1][wIndex]
        //canto direito inferior
    if(hIndex == altura-1 && wIndex == largura-1)
        bombasVisinhas = boardReal[hIndex][wIndex-1] + boardReal[hIndex-1][wIndex-1] + boardReal[hIndex-1][wIndex]

    if(bombasVisinhas == 0)
        return 0

    return bombasVisinhas
}

function Trapaça(){
    if (TrapacaVal == 0){
        showBombas()
        TrapacaVal = 1
    }else{
        hideBombas()
        TrapacaVal = 0
    }
}

function showBombas(){
    celulaAtual = 1
    for(index=0;index<altura;index++){
        for(inIndex=0;inIndex<largura;inIndex++){
            if(boardReal[index][inIndex] == 1){

                let imgElement = document.getElementById(celulaAtual)
                imgElement.setAttribute("src","stylesheets/Img/board/Bomb.png" )
            }
            celulaAtual++;
        }
    }
}

function hideBombas(){
    celulaAtual = 1
    for(index=0;index<altura;index++){
        for(inIndex=0;inIndex<largura;inIndex++){
            if(boardReal[index][inIndex] == 1){

                let imgElement = document.getElementById(celulaAtual)
                imgElement.setAttribute("src","stylesheets/Img/board/Empty.png" )
            }
            celulaAtual++;
        }
    }
}

function checkVenceu() {
    var gameBoard = document.getElementById('gameBoard');
    
    var images = gameBoard.getElementsByTagName('img');

    if (TrapacaVal == 1){
        var foundEmpty = false;

        for (var i = 0; i < images.length; i++) {
            if (images[i].src.includes("Empty.png")) {
                foundEmpty = true;
                break;
            }
        }

        if (foundEmpty) {

        } else {
            Venceu()
        }
    }
    else{

        var emptyImageCount = 0;
        
        for (var i = 0; i < images.length; i++) {
            if (images[i].src.includes('Empty.png')) {
                emptyImageCount++;
            }
        }
        let NumBombas = parseInt(document.getElementById("numero-bombas").value, 10);

        if (NumBombas == emptyImageCount){
            Venceu()
        }
    }
}

function Venceu(){
    var time = stopTimer()
    largura = document.getElementById("largura-campo").value
    altura = document.getElementById("altura-campo").value 
    celulas = 1

    for(index=0;index<altura*largura;index++){
        let imgElement = document.getElementById(celulas)
        imgElement.style.pointerEvents = 'none'
        celulas++
    }
    alert("VOCE VENCEU " + "Tempo: "+  time)
    InsertInfoHistorico("Vitoria", time)
}



function Perdeu(){
    var time = stopTimer()
    largura = document.getElementById("largura-campo").value
    altura = document.getElementById("altura-campo").value 
    celulas = 1

    for(index=0;index<altura*largura;index++){
        let imgElement = document.getElementById(celulas)
        imgElement.style.pointerEvents = 'none'
        celulas++
    }
    divElement = document.getElementById("kaboom")
    divElement.style.display = ''

    InsertInfoHistorico("Derrota", time)
}

function InsertInfoHistorico(resultado, tempo){
    name_info = "Jogador 1"
    largura_info = document.getElementById("largura-campo").value
    altura_info = document.getElementById("altura-campo").value
    bombas_info = document.getElementById("numero-bombas").value 
    modalidade_info = document.getElementById("modalidade").value
    dataAtual = new Date();

    let ano = dataAtual.getFullYear();
    let mes = String(dataAtual.getMonth() + 1).padStart(2, '0');
    let dia = String(dataAtual.getDate()).padStart(2, '0');
    let horas = String(dataAtual.getHours()).padStart(2, '0');
    let minutos = String(dataAtual.getMinutes()).padStart(2, '0');
    
    dataAtual = `${ano}-${mes}-${dia} ${horas}:${minutos}`;

    let tableBody = document.querySelector('table tbody');

    let newRow = document.createElement('tr');

    let cells = [
        name_info, 
        largura_info + "X" + altura_info,       
        bombas_info,        
        modalidade_info,      
        tempo,    
        resultado,   
        dataAtual
    ];

    cells.forEach(cellData => {
        let newCell = document.createElement('td');
        newCell.textContent = cellData;
        newRow.appendChild(newCell);
    });

    tableBody.appendChild(newRow);
}


function vanish(){
    divElement = document.getElementById("kaboom")
    divElement.style.display = 'none'
}
