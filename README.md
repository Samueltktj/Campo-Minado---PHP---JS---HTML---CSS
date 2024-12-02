# Campo Minado

# Grupo 05
* Alona Nicolau         - 249664
* Roberto Kendy Hassabe - 224141
* Samuel Lima Martins   - 173820
* Samuel Josef          - 247597

## Regras do Jogo

* O usuário deverá poder escolher as **dimensões** do grid e o **número de bombas** no campo, sendo que o número máximo de bombas deve respeitar o tamanho do grid.

* O usuário também poderá escolher entre duas modalidades de partida: **Clássica** e **Rivotril**. No modo **Rivotril**, haverá um contador de tempo (timer), e o jogador deverá encerrar a partida antes que tal contador chegue a zero. Caso ele não consiga, a partida contará como uma "derrota" em seu histórico. Caberá ao grupo **definir o tempo de cada partida do modo Rivotril**, em função do tamanho do tabuleiro.

* O sistema deverá manter um **histórico** com o resultado de todas as partidas disputadas pelo usuário. Este histórico deve conter as seguintes informações sobre **_cada_ partida jogada**: nome do jogador, dimensões do campo utilizado na partida, número de bombas no campo, modalidade da partida, tempo gasto até a vitória ou derrota (contado a partir do primeiro clique no campo), resultado da partida (vitória ou derrota) e data/hora em que a partida foi disputada.

* Para facilitar a correção da atividade, o jogo deverá contar com um botão **Trapaça** que, quando pressionado, exibirá temporariamente todas as células do tabuleiro, **sem interferir na dinâmica do jogo**. Após o tempo de trapaça permitido, as células que ainda não haviam sido abertas pelo usuário voltam ao seu estado original.

# Regras para o Trabalho

1. Esse Projeto deverá ser desenvolvido em grupos de 4 a 5 alunos.

2. Como consta no Plano de Ensino da Disciplina, a nota desse Projeto corresponderá a 75% da média de cada aluno.

3. Ao longo do semestre, cada grupo deverá entregar três parciais do Projeto, correspondentes a versões incrementais do sistema (os pesos de cada parcial na nota final do Projeto estão no Plano de Ensino da Disciplina). Tais parciais serão:

* **Parcial 1:** documentos HTML correspondentes a versões não-funcionais das páginas previstas para o jogo, já com todas as definições de estilo via CSS. Nessa versão preliminar do sistema, todas as páginas deverão estar presentes, já com a formatação final e com hyperlinks que levem o usuário às demais páginas do sistema. No entanto, as funcionalidades de controle de acesso, do jogo em si, e o armazenamento e recuperação de informações não devem estar presentes. Substitua os campos das páginas que dependem dos aspectos dinâmicos do sistema por imagens ou valores estáticos (ex.: uma figura que corresponda ao tabuleiro e valores fixos nas tabelas de ranking). A ordem de navegação entre as páginas já deve ser a final.

* **Parcial 2:** nesta segunda versão do sistema, toda a dinâmica do Campo Minado deverá estar implementada e funcional, mas a plataforma ainda não terá nenhuma funcionalidade relacionada ao back-end. Ou seja, o usuário poderá jogar quantas partidas quiser, mas o sistema não contará com o controle de acesso ou persistência de dados.

* **Parcial 3:** corresponde ao incremento final do sistema, com a implementação de todas as funcionalidades relacionadas ao back-end. Espera-se que essa entrega corresponda à versão final do sistema, com as funcionalidades de front-end e back-end mencionadas anteriormente devidamente integradas e testadas.

4. A entrega de cada parcial do Projeto será composta por dois arquivos:

* Um arquivo .ZIP contendo todos os arquivos necessários para configuração e execução do sistema (.html, .js, .php, .css, imagens etc.). É importante manter, no arquivo .ZIP, a estrutura de diretórios necessária para execução do jogo e incluir um arquivo TXT ou PDF que contenha:

    * As instruções necessárias para configuração e uso do sistema;

    * O link para um vídeo de apresentação da parcial entregue pelo grupo.

    * Caso o tamanho final do arquivo .ZIP exceda o limite permitido pelo Moodle, arquivos maiores (como imagens) podem ser hospedados em repositórios online. No entanto, é obrigatório inserir instruções sobre como tais arquivos devem ser acessados.

* Um arquivo .XLSX contendo o detalhamento da contribuição de cada membro do grupo. Este arquivo corresponde ao modelo disponível Moodle, preenchido pelo grupo.

5. Cada parcial entregue deverá ser acompanhada de um vídeo, de no máximo 10 minutos, em que todos os membros do grupo apresentam o que foi desenvolvido naquela parcial. Espera-se uma apresentação não apenas do funcionamento do sistema, mas da estrutura interna do que foi desenvolvido por cada aluno naquela parcial.

* O foco de cada vídeo deve ser no conteúdo da parcial que está sendo entregue (não é necessário reexplicar o que já foi apresentado em vídeos anteriores).

*  O vídeo deve ser hospedado em algum serviço gratuito (ex.: YouTube) e o link fornecido junto com a entrega.

6. Todo o código-fonte em JavaScript deve estar prioritariamente contido em arquivos .JS externos (exceto as chamadas às funções implementadas, que podem estar no HTML conforme a necessidade).

7. Todas as definições de formatação geral das páginas deverão estar contidas em folhas de estilo CSS externas. É obrigatório o uso de folhas de estilo em todas as páginas.

8. Todos os documentos HTML gerados deverão seguir a versão mais recente do padr"ao.

9. Tanto os arquivos HTML quando as folhas de estilo CSS deverão ser validados no site do W3C.

10. Cópias de outros grupos ou da internet serão penalizadas como descrito no Plano de Ensino da Disciplina.

11. Não serão aceitas parciais entregues fora do prazo.


# Desenvolvimento

## [ ] Front-End
A primeira tela a ser exibida para qualquer usuário que acesse o sistema deve conter dois campos de um formulário para autenticação: um para o **_usuário_** e o outro para a **_senha_** (além de um botão para enviar os dados fornecidos). Além disso, deverá haver um link para uma página de cadastro no sistema, caso o usuário não possua usuário e senha.

Na página de cadastro o sistema deverá solicitar os seguintes dados de um novo jogador: **nome completo**, **data de nascimento**, **CPF**, **telefone** e **e-mail**, além do **_username_** (único) e da **senha** para acesso ao sistema. Estes dados deverão ser mantidos na **plataforma** enquanto a conta do jogador estiver ativa.

Uma vez autenticado no sistema, o jogador deverá ser redirecionado para uma página que contenha o **Campo Minado** implementado em JavaScript. Além do jogo em si, nessa página o usuário deverá visualizar pelo menos as seguintes informações:

* **Tempo da partida** até o momento (caso iniciada), **configuração do tabuleiro** (dimensões e número de bombas), **modalidade de partida** e, no caso do modo **Rivotril**, o tempo restante para conclusão da partida.

* **Histórico** com os resultados de todas as partidas jogadas anteriormente **por aquele jogador**. Tal histórico deve exibir as seguintes informações: **nome do jogador**, **dimensões do campo** utilizado na partida, **número de bombas** no campo, **modalidade** da partida, **tempo gasto** até a vitória ou derrota (contado a partir do primeiro clique no campo), **resultado** da partida (vitória ou derrota) e a data/hora em que a partida foi disputada.

* Botão de ativação do modo **Trapaça**.

Na página que contém o **Campo Minado** o usuário também deverá ter acesso a hyperlinks que o levam a duas outras páginas do sistema, além de uma **opção para desconectar e retornar à página de login**: uma página com o **_ranking global_** de jogadores e outra onde ele poderá **editar suas informações pessoais**. Nesta página de edição de informações pessoais, os campos data de nascimento, CPF e username **_NÃO_** poderão ser alterados.

Por fim, na página de **ranking global** de jogadores o sistema deverá mostrar os **usernames** e **dados da partida** para **10 jogadores**, obtidas dentre todos os jogadores registrados no sistema. A escolha destas partidas deverá ser feita em função do tamanho do tabuleiro e tempo de partida: **deverão ser exibidos os dados das partidas disputadas (e vencidas) nos 10 maiores tabuleiros**. Caso mais de um jogador tenha disputado uma partida com as mesmas dimensões de tabuleiro, deverão ser exibidos os dados do jogador que venceu a partida em **menor tempo**. 

Ao final de cada partida, o sistema deverá permitir ao usuário escolher se ele deseja ou não iniciar uma nova partida.

**ATENÇÃO 1:** todas as páginas exibidas no front-end deverão seguir o padrão mais recente de HTML e contar com folhas de estilo **prioritariamente externas**, escritas em CSS (versão 2 ou superior). Tanto os documentos HTML enviados pela plataforma ao navegador dos usuários quanto as folhas de estilo devem ser validadas nos validadores de HTML e CSS do W3C:

[**Validador de HTML**](https://validator.w3.org/)
[**Validador de CSS**](https://jigsaw.w3.org/css-validator)

**ATENÇÃO 2:** **NÃO** é recomendado o uso de templates CSS neste trabalho, mas, caso o grupo queira usá-los, é **mandatório** indicar isto explicitamente no site e fornecer um link para a(s) fonte(s).

**ATENÇÃO 3:** para o desenvolvimento do jogo, será necessário estudar o funcionamento de eventos temporizados em JavaScript.


# A fazer 11/09 HTML - CSS - Entrega Parcial 1

- [x] Tela de login e Cadastro **_(documento próprio)_** (Direciona à tela principal) [Alona]
    - [x] username
    - [x] senha
    - [x] nome completo
    - [x] data de nascimento
    - [x] CPF
    - [x] telefone
    - [x] e-mail



- [x] Tela de edição de perfil **_(documento próprio)_** [Alona]
- [x] Tela de ranking **_(documento próprio)_** [Kendy]
    - [x] username
    - [x] dados da partida
    - [x] apenas 10 jogadores

- [x] Tela de histórico de partidas **_(documento próprio)_** [SamuelJosef]
    - [x] username
    - [x] dimensões do campo
    - [x] número de bombas
    - [x] modalidade
    - [x] tempo gasto
    - [x] resultado(vitória ou derrota)

- [x] Cabeçalho da página **_(documento principal)_** [SamuelLima]
    - [x] Atualizar Cabeçalho da página **_(documento principal)_**

- [x] Img ilustrativa do jogo **_(documento principal)_** [SamuelJosef]
    - [x] Botão de trapaça
    - [x] Opções de jogo **_(documento principal)_** 
    - [x] Timer e Timer Rivotril **_(documento principal)_**

- [x] Hrefs para outros documentos **_(documento principal)_**[Alona :3] 








