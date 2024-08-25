## Criação de uma API RESTful para Parcelas de Carnê

### Instalação do Projeto

Para instalar o projeto

```
clone o repósitorio
```

Para instalar as depêndencias do projeto

```
composer install 
```

Crie o banco de dados utilizando o arquivo:
```
banco.sql
```

Modifique o arquivo:
```
config.php 
```
na raiz do projeto.

Abrir o Postman ou equivalente no endpoint:

Para inserir dados do carnê:
```
http://localhost/<pasta_do_projeto>/public_html/api/carne
```


Para retornar um carnê especifíco:
```
http://localhost/<pasta_do_projeto>/public_html/api/carne/{id}
```