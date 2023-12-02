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

Resposta de Erro:
Caso a autenticação falhe, a resposta terá um status 422 (Unprocessable Entity) com a mensagem de erro.

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