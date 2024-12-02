<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Game</title>
        <link rel="stylesheet" href="stylesheets/mainstyles.css">
        <link rel="stylesheet" href="stylesheets/gamestyle.css">
        <link rel="shortcut icon" href="Img/GUII.png" type="image/x-icon">
    </head>
    <body>
        <header>
            <form action="logout.php" method="POST">
                <button type="submit" class="exitButton" style="font-size: 1.5vw">
                    Sair
                </button>
            </form>
            <h1>Campo Minado - Zona 401</h1> 
            <nav>
                <ul>
                    
                    <li><a href="play-game.php">Game</a></li>
                    <li><a href="ranking.php">Ranking</a></li>
                    <li><a href="info-pessoais.php">Área do Usuário</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <script src="scripts/boardScript.js"></script>
            <!-- Área do Jogo -->
            <div class="game-container">
                <div class="historico">
                    <h2>
                        Historico de Partida
                    </h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Nome do Jogador</th>
                                <th>Dimensões do Campo</th>
                                <th>Número de Bombas</th>
                                <th>Modalidade</th>
                                <th>Tempo Gasto</th>
                                <th>Resultado</th>
                                <th>Data/Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- As linhas da tabela serão preenchidas dinamicamente -->
                            <tr>
                                <td>Jogador 1</td>
                                <td>10x10</td>
                                <td>15</td>
                                <td>Normal</td>
                                <td>5m 23s</td>
                                <td>Vitória</td>
                                <td>2024-09-14 14:00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="divcentral">
                    <div class="game-config">
                        <form id="gameForm">
                            <label for="tempo-partida">Tempo da Partida:</label>
                            <input type="text" id="tempo-partida" name="tempo-partida" placeholder="00:00" readonly>
                        
                            <fieldset>
                                <legend>Dimensões:</legend>
                                <label for="largura-campo"></label>
                                <input type="number" id="largura-campo" name="largura-campo" min="1" placeholder="Largura">
                                <span>x</span>
                                <label for="altura-campo"></label>
                                <input type="number" id="altura-campo" name="altura-campo" min="1" placeholder="Altura">
                            </fieldset>
                            <label for="numero-bombas">Número de Bombas:</label>
                            <input type="number" id="numero-bombas" name="numero-bombas" min="1" value="1">
                        
                            <label for="modalidade">Modalidade:</label>
                            <select id="modalidade" name="modalidade">
                                <option value="Normal">Normal</option>
                                <option value="Rivotril">Rivotril</option>
                            </select>
                        </form>
                        <div class="div-btns">
                            <button onclick="Iniciar()" id="start-game" type="submit" form="gameForm">Start</button>
                            <hr style="display:block;border:rgb(247, 241, 247) solid 1px;">
                            <button id="trapaça-game" onclick="Trapaça()">Trapaça</button>
                        </div>
                    </div>
                    <div class="gameBoard" id="gameBoard">

                    </div>                            
                </div>
            </div>
            <div id="kaboom" class="kaboomDiv" style="display: none;">
                <img class="kaboom" src="stylesheets/Img/Kaboom.png" alt="Kaboom!">
                <button class="kabutton" onclick="vanish()">Continue</button>
            </div>
        </main>
        <footer>
            <p>&copy; Site da Disciplina SI401</p>
        </footer>
    </body>
</html>
