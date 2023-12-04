# TodoListApi

## Descrição: O TodoListAPI é uma API para gerenciamento de Tarefa.

# Endpoint: Login
### Descrição: Este endpoint é utilizado para autenticar um usuário e obter um token de acesso para futuras requisições autenticadas.

## Rota: POST api/login

### Parâmetros da Requisição:

```json
email (string, obrigatório): O e-mail do usuário.
password (string, obrigatório): A senha do usuário.
remember (boolean, opcional): Opção para manter a sessão do usuário ativa.

```

## Exemplo de Requisição:

```json
{
  "email": "usuario@example.com",
  "password": "senha123",
  "remember": true
}

```

## Resposta de Sucesso:
### Caso a autenticação seja bem-sucedida, a resposta será um token de acesso e informações do usuário.

```json
{
  "token": "token_de_acesso",
  "user": {
    "usuário"
  }
}

```

## Resposta de Erro:
### Caso a autenticação falhe, a resposta terá um status 422 (Unprocessable Entity) com a mensagem de erro.

```json
{
  "message": "Usuário ou Senha está incorreto"
}

```


# Endpoint: Logout

### Descrição: Este endpoint é utilizado para encerrar a sessão do usuário, invalidando o token de acesso utilizado para autenticação.

## Rota: POST api/logout

## Parâmetros da Requisição:
### Este endpoint não requer parâmetros na requisição. A autenticação é realizada através do token enviado no cabeçalho da requisição.

## Exemplo de Requisição:

``` json
// Cabeçalho da Requisição
{
  "Authorization": "Bearer token_de_acesso"
}

```

## Resposta de Sucesso:
### Caso o logout seja bem-sucedido, a resposta será um status 204 (No Content), indicando que a sessão foi encerrada com sucesso.


# Endpoint: Obter Usuário Atual

### Descrição: Este endpoint é utilizado para obter as informações do usuário autenticado no momento. 

## Rota: GET /api/current-user

## Parâmetros da Requisição:
### Este endpoint não requer parâmetros na requisição. A autenticação é realizada através do token enviado no cabeçalho da requisição.

## Exemplo de Requisição:

``` json
// Cabeçalho da Requisição
{
  "Authorization": "Bearer token_de_acesso"
}

```

## Resposta de Sucesso:
### Caso a requisição seja bem-sucedida, a resposta será um objeto contendo as informações do usuário.

``` json
{
  "data": {
    // Informações do usuário (consulte a documentação do UserController para detalhes)
  }
}
```



# Endpoint: Criar Conta de Usuário

### Descrição: Este endpoint é utilizado para criar uma nova conta de usuário.

## Rota: POST /api/create-account

## Parâmetros da Requisição:

``` json
name (string, obrigatório): Nome do usuário.
email (string, obrigatório): E-mail do usuário.
password (string, obrigatório): Senha do usuário.

```

## Exemplo de Requisição:

``` json
{
  "name": "Nome do Usuário",
  "email": "usuario@example.com",
  "password": "senha123"
}
```

## Resposta de Sucesso:
### Caso a conta seja criada com sucesso, a resposta será um status 200 (OK) com a mensagem correspondente.

``` json
{
  "message": "Usuário cadastrado"
}
```

## Resposta de Erro:
### Caso o e-mail já esteja sendo utilizado, a resposta terá um status 422 (Unprocessable Entity) com a mensagem de erro.

``` json
{
  "message": "Email já está sendo utilizado"
}
```


# Endpoint: Atualizar Usuário

### Descrição: Este endpoint é utilizado para atualizar as informações de um usuário existente.

## Rota: PUT /api/user/{id}

## Parâmetros da Requisição:

``` json
name (string, opcional): Novo nome do usuário.
password (string, opcional): Nova senha do usuário.
```

## Exemplo de Requisição:

``` json
// Cabeçalho da Requisição
{
  "Authorization": "Bearer token_de_acesso"
}

// Corpo da Requisição
{
  "name": "Novo Nome",
  "password": "novaSenha123"
}
```

## Resposta de Sucesso:
### Caso a atualização seja bem-sucedida, a resposta será um status 200 (OK) com a mensagem correspondente e as informações atualizadas do usuário.

``` json
{
  "message": "Nome do usuário atualizado",
  "user": {
    // Informações do usuário atualizadas (consulte a documentação do UserController para detalhes)
  }
}

OU

{
  "message": "Senha atualizada",
  "user": {
    // Informações do usuário atualizadas (consulte a documentação do UserController para detalhes)
  }
}

```

## Resposta de Erro:

``` json
Se o novo nome já estiver sendo utilizado, a resposta terá um status 422 (Unprocessable Entity) com a mensagem de erro.
Se a nova senha já estiver sendo utilizada, a resposta terá um status 422 (Unprocessable Entity) com a mensagem de erro.
```


# Endpoint: Listar Tarefas

### Descrição: Este endpoint é utilizado para obter a lista de tarefas do usuário autenticado, com suporte a paginação, pesquisa, ordenação e filtros.

## Rota: GET /api/task

## Parâmetros da Requisição:

``` json
per_page (integer, opcional): Número de itens por página na paginação (padrão: 5).
search (string, opcional): Termo de pesquisa para filtrar tarefas por título.
sort_field (string, opcional): Campo utilizado para ordenação (padrão: 'title').
sort_direction (string, opcional): Direção da ordenação (padrão: 'desc').
status (integer, opcional): ID do status da tarefa para filtrar.
priority (integer, opcional): ID da prioridade da tarefa para filtrar.
```

## Exemplo de Requisição:

``` json
// Cabeçalho da Requisição
{
  "Authorization": "Bearer token_de_acesso"
}

// Parâmetros da Requisição
{
  "per_page": 10,
  "search": "Tarefa",
  "sort_field": "title",
  "sort_direction": "asc",
  "status": 1,
  "priority": 2
}
```

## Resposta de Sucesso:
### Caso a requisição seja bem-sucedida, a resposta será um objeto paginado contendo a lista de tarefas.

``` json
{
  "current_page": 1,
  "data": [
    {
      // Informações da tarefa (consulte a documentação do TaskController para detalhes)
    },
    // ... (outras tarefas)
  ],
  "first_page_url": "url_da_primeira_pagina",
  "from": 1,
  "last_page": 3,
  "last_page_url": "url_da_ultima_pagina",
  "next_page_url": "url_da_proxima_pagina",
  "path": "url_da_pagina_atual",
  "per_page": 10,
  "prev_page_url": null,
  "to": 10,
  "total": 25
}
```

# Endpoint: Criar Tarefa

### Descrição: Este endpoint é utilizado para criar uma nova tarefa para o usuário autenticado.

## Rota: POST /api/task

## Parâmetros da Requisição:

``` json
title (string, obrigatório): Título da tarefa.
description (string, opcional): Descrição da tarefa.
status (integer, obrigatório): ID do status da tarefa.
priority (integer, obrigatório): ID da prioridade da tarefa.
schedule (integer, obrigatório): ID do agendamento da tarefa.
category (integer, obrigatório): ID da categoria da tarefa.
```

## Exemplo de Requisição:

``` json
// Cabeçalho da Requisição
{
  "Authorization": "Bearer token_de_acesso"
}

// Corpo da Requisição
{
  "title": "Nova Tarefa",
  "description": "Descrição da tarefa",
  "status": 1,
  "priority": 2,
  "schedule": 3,
  "category": 4
}

```

## Resposta de Sucesso:
### Caso a tarefa já exista, a resposta terá um status 422 (Unprocessable Entity) com a mensagem de erro.

``` json
{
  "message": "Esta Tarefa já existe"
}
```

## Resposta de Erro:

``` json
Se o novo nome já estiver sendo utilizado, a resposta terá um status 422 (Unprocessable Entity) com a mensagem de erro.
Se a nova senha já estiver sendo utilizada, a resposta terá um status 422 (Unprocessable Entity) com a mensagem de erro.
```


# Endpoint: Atualizar Tarefa

### Descrição: Este endpoint é utilizado para atualizar as informações de uma tarefa existente.

## Rota: PUT /api/task/{id}

## Parâmetros da Requisição:

``` json
title (string, obrigatório): Novo título da tarefa.
description (string, opcional): Nova descrição da tarefa.
category (integer, obrigatório): ID da nova categoria da tarefa.
status (integer, obrigatório): ID do novo status da tarefa.
priority (integer, obrigatório): ID da nova prioridade da tarefa.
```

## Exemplo de Requisição:

``` json
// Cabeçalho da Requisição
{
  "Authorization": "Bearer token_de_acesso"
}

// Corpo da Requisição
{
  "title": "Novo Título",
  "description": "Nova Descrição",
  "category": 2,
  "status": 1,
  "priority": 3
}
```

## Resposta de Sucesso:
### Caso a atualização seja bem-sucedida, a resposta será um status 200 (OK) com a mensagem correspondente e as informações atualizadas da tarefa.

``` json
{
  "message": "Tarefa Atualizada",
  "task": {
    // Informações atualizadas da tarefa (consulte a documentação do TaskController para detalhes)
  }
}
```


# Endpoint: Deletar Tarefa

### Descrição: Este endpoint é utilizado para deletar uma tarefa existente.

## Rota: DELETE /api/task/{id}

## Parâmetros da Requisição:

``` json
Este endpoint não requer parâmetros na requisição. A autenticação é realizada através do token enviado no cabeçalho da requisição.
```

## Exemplo de Requisição:

``` json
// Cabeçalho da Requisição
{
  "Authorization": "Bearer token_de_acesso"
}
```

## Resposta de Sucesso:
### Caso a exclusão seja bem-sucedida, a resposta será um status 200 (OK) com a mensagem correspondente.

``` json
{
  "message": "Tarefa deletada"
}
```