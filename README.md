# Site AGRO Estoque 

Um site de controle de estoque voltado para o agro.

<p align="right"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="150" alt="Laravel Logo"></a></p>

## Passos para instalação e uso

O github disponibiliza de diversos modos para fazer upload do codigo. 

Aqui estão duas dessas formas:
<p style="display: block"> 
   <strong> 1 - </strong>  Vá até uma pasta reservada para o projeto e use o comando no "git bash" : 
    https://github.com/AdrianoMiguell/SiteCursos-laravel.git
</p>
<p style="display: block"> 
    <strong> 2 - </strong>  Baixe o arquivo .zip do código, clicando no botão "Download .ZIP"
</p>

### Pré Requisitos

``` Ter suporte a linguagem PHP em sua maquina ```

``` Ter um editor de código (Ex.: Visual Studio Code) ```

``` Ter um sistema de hospedagem local, com suporte a banco de dados (Ex.: Xampp ) ```

``` Ter instalado em sua maquina o Gerenciador de dependências Composer ```

``` Ter instalado em sua maquina o framework Laravel ```

### Preparando ambiente

-- Abra o terminal, e na pasta do projeto, execute o código: ``` composer install ```

-- Execute também o seguinte código: ``` npm install ```

-- Ligue o seu servidor local apache e o servidor de banco de dados

-- Acesse a sua ferramenta de banco de dados, e crie um banco de dados com um nome que desejar (Ex: Cursos);

-- Agora, vá a raiz do código, copie um arquivo chamado  ``` .env.example ```  e cole-o nesse mesmo local, trocando o nome para apenas ```.env```.

-- Encontre o trecho com o código ```DB_CONNECTION``` e troque o nome do banco para o que será usado (ex: mysql, sqlite, ...).

-- Localize também o trecho ``` DB_DATABASE ```  e troque para o nome do seu banco de dados. 

--Também encontre o trecho do código ```FILESYSTEM_DISK``` e troque o valor "local" para "public".

-- Vá ao terminal e digite este código para que as tabelas do banco sejam construidas altomaticamente:  ``` php artisan migrate ``` .  

-- Se você quiser carregar alguns dados para teste salvos nos seeders, você pode executar o seguinte comando:  ``` php artisan db:seed ``` .  

-- Agora, execute esse código no terminal, para geração de uma chave criptografada exigida pelo artisan: ``` php artisan key:generate ```

-- Finalmente, execute o código no terminal, para visualização do sistema:  ``` php artisan serve ``` . 


## Fotos do site

<div>
    <img src="https://github.com/AdrianoMiguell/ControleEstoque/blob/main/.github/images/dashboard-movimentacoes.jpg" width="500" />
    <img src="https://github.com/AdrianoMiguell/ControleEstoque/blob/main/.github/images/dashboard.jpg" width="500" />
</div>
<div>
    <img src="https://github.com/AdrianoMiguell/ControleEstoque/blob/main/.github/images/dashboard_nova_entrada.jpg" width="500" />
    <img src="https://github.com/AdrianoMiguell/ControleEstoque/blob/main/.github/images/tela_inicial.jpg" width="500" />
</div>


