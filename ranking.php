<!-- <p>Por fim, na página de ranking global de jogadores o sistema deverá mostrar os usernames e dados da partida para 10 jogadores, obtidas dentre todos os jogadores registrados no sistema. A escolha destas partidas deverá ser feita em função do tamanho do tabuleiro e tempo de partida: deverão ser exibidos os dados das partidas disputadas (e vencidas) nos 10 maiores tabuleiros. Caso mais de um jogador tenha disputado uma partida com as mesmas dimensões de tabuleiro, deverão ser exibidos os dados do jogador que venceu a partida em menor tempo. </p> -->

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ranking Global</title>
        <link rel="stylesheet" href="stylesheets/mainstyles.css">
        <link rel="stylesheet" href="stylesheets/rankingstyle.css">
        <link rel="shortcut icon" href="stylesheets/GUII.png" type="image/x-icon">
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
            <div class="divcentral" id="divcentral-rank">
                <h2>Ranking</h2>

                <div class="quadro-ranking">
                    <table id="tabela-ranking">
                        <tr>
                            <td id="icone-rank1"></td>
                            <td>usernames</td>
                            <td>tipo tabuleiro</td>
                            <td>tempo</td>
                        </tr>
                        <tr>
                            <td id="icone-rank2"></td>
                            <td>usernames</td>
                            <td>tipo tabuleiro</td>
                            <td>tempo</td>
                        </tr>
                        <tr>
                            <td id="icone-rank3"></td>
                            <td>usernames</td>
                            <td>tipo tabuleiro</td>
                            <td>tempo</td>
                        </tr>
                        <tr>
                            <td class="num-tabela-rank">4</td>
                            <td>usernames</td>
                            <td>tipo tabuleiro</td>
                            <td>tempo</td>
                        </tr>
                        <tr>
                            <td class="num-tabela-rank">5</td>
                            <td>usernames</td>
                            <td>tipo tabuleiro</td>
                            <td>tempo</td>
                        </tr>
                        <tr>
                            <td class="num-tabela-rank">6</td>
                            <td>usernames</td>
                            <td>tipo tabuleiro</td>
                            <td>tempo</td>
                        </tr>
                        <tr>
                            <td class="num-tabela-rank">7</td>
                            <td>usernames</td>
                            <td>tipo tabuleiro</td>
                            <td>tempo</td>
                        </tr>
                        <tr>
                            <td class="num-tabela-rank">8</td>
                            <td>usernames</td>
                            <td>tipo tabuleiro</td>
                            <td>tempo</td>
                        </tr>
                        <tr>
                            <td class="num-tabela-rank">9</td>
                            <td>usernames</td>
                            <td>tipo tabuleiro</td>
                            <td>tempo</td>
                        </tr>
                        <tr>
                            <td class="num-tabela-rank-10">10</td>
                            <td>usernames</td>
                            <td>tipo tabuleiro</td>
                            <td>tempo</td>
                        </tr>
                    </table>
                </div>

            </div>
            <!--<aside id="aside-rank">
                <ul>
                    <li>Tipo de Tabuleiro</li>   
                </ul>
            </aside>-->
        </main>
        <footer>
            <p>&copy; Site da  Disciplina SI401</p>
        </footer>
    </body> 
</html>
