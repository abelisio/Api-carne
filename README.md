# Documentação da API RESTful de Carnês


## Visão Geral:

```
Esta API RESTful foi desenvolvida em PHP e permite a criação e recuperação de carnês com parcelas. A API calcula automaticamente as parcelas, considerando um possível valor de entrada e diferentes periodicidades (mensal, semanal ou trimestral). Os dados são armazenados em um banco de dados MySQL.
```
### Estrutura do Projeto

- **index.php**: Ponto de entrada da aplicação. Gerencia as requisições HTTP e as direciona para o controlador correto.
- **CarneController.php**: Controlador responsável pelo gerenciamento das requisições relacionadas ao carnê, como criar e recuperar carnês.
- **Carne.php**: Classe de modelo que interage com o banco de dados para realizar operações CRUD (Create, Read, Update, Delete) relacionadas ao carnê.
- **Banco de Dados**: Uma tabela única chamada `carnes_parcelas` armazena as informações tanto do carnê quanto das parcelas.

## Requisitos

- **PHP 7.4 ou superior**
- **Servidor Web (Apache ou Nginx)**
- **Banco de Dados MySQL**
- **Composer** (para gerenciamento de dependências)

## Instalação

1. **Clone o Repositório:**
   
```  
   bash
   git clone https://seu_repositorio.git
   cd seu_repositorio
```

2. **Instale as Dependências:**
   
```   
composer install
```

3. **Configuração do Banco de Dados:**

- **Crie uma nova base de dados no MySQL.**
- **Crie o banco de dados utilizando o arquivo:**

```
banco.sql
```

4. **Configuração da Conexão com o Banco de Dados:**

```
No arquivo config.php (ou onde a conexão está configurada), insira as credenciais do seu banco de dados:
```
```
define('DB_HOST', 'localhost');
define('DB_NAME', 'nome_do_banco_de_dados');
define('DB_USER', 'usuario');
define('DB_PASS', 'senha');
```

## Uso


1. **Criar um Carnê**
- **Endpoint:** POST: http://localhost/<pasta_do_projeto>/public_html/api/carne
- **Parâmetros:**
- **valor_total:** O valor total do carnê.
- **quantidade_parcelas**: A quantidade de parcelas.
- **data_primeiro_vencimento** (formato YYYY-MM-DD): A data do primeiro vencimento. 
- **data do primeiro vencimento.**
- **periodicidade:** Pode ser "mensal" ou "semanal".
- **valor_entrada:** O valor da entrada.


2. **Recuperar Parcelas de um Carnê**
Endpoint: GET: http://localhost/<pasta_do_projeto>/public_html/api/carne/{id}

#### Parâmetros:
- **id (int):** O identificador do carnê.

###  Explicação das Principais Funcionalidades
1. **index.php**
   
- Recebe todas as requisições HTTP.
- Direciona as requisições para o controlador correto, dependendo do método (GET, POST, etc.) e da rota.
  
2. **CarneController.php**

- Método get($id): Recupera as parcelas de um carnê específico ou todos os carnês se o id não for fornecido.
- Método post(): Cria um novo carnê com as parcelas calculadas e armazena no banco de dados.
- Método update(): (Implementação futura) Atualiza os detalhes de um carnê existente.
- Método delete(): (Implementação futura) Exclui um carnê existente.

3. **Carne.php**
   
- Método insert($data): Insere um novo registro na tabela - carnes_parcelas com os detalhes do carnê e suas parcelas.
- Método select($id): Retorna as parcelas associadas a um carnê específico.
- Método selectAll(): Retorna todos os carnês cadastrados.


## Testes

```
Para garantir que a API esteja funcionando corretamente, use ferramentas como Postman, Insomnia  ou cURL para enviar requisições aos endpoints e verificar as respostas.
```