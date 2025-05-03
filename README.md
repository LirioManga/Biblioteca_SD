# SISTEMA DE GESTÃO DE RECURSOS
## API

### 🔐 Base URL

```
/admin/utilizadores
```

---

### 📌 Endpoints

#### 🔹 1. Registar Utilizador

- **Método:** `POST`
- **Rota:** `/registar`
- **Descrição:** Regista um novo utilizador com perfil.

##### 📥 JSON Requisição

```json
{
  "name": "Lirio Manga",
  "email": "lirio.manga@gmail.com",
  "user_type": "admin",
  "gender": "masculino",
  "birthdate": "2000-05-20",
  "phone": "+258840000000",
  "address": "2F"
}
```

##### 📤 Resposta (Sucesso)

```json
{
  "status": true,
  "message": "Utilizador registado com sucesso"
}
```

---

#### 🔹 2. Visualizar Todos os Utilizadores

- **Método:** `POST`
- **Rota:** `/visualizar`
- **Descrição:** Lista todos os utilizadores e seus perfis.

##### 📤 Resposta

```json
{
  "status": true,
  "data": [
    {
    "name": "Lirio Manga",
    "email": "lirio.manga@gmail.com",
    "user_type": "admin",
    "gender": "masculino",
    "birthdate": "2000-05-20",
    "phone": "+258840000000",
    "address": "2F"
    }
  ]
}
```

---

#### 🔹 3. Buscar Utilizador por ID

- **Método:** `POST`
- **Rota:** `/buscar/{id}`
- **Descrição:** Retorna os dados de um utilizador específico com base no ID.

##### 📤 Resposta

```json
{
  "status": true,
    {
    "name": "Lirio Manga",
    "email": "lirio.manga@gmail.com",
    "user_type": "admin",
    "gender": "masculino",
    "birthdate": "2000-05-20",
    "phone": "+258840000000",
    "address": "2F"
    }
}
```

##### ❌ Resposta (Erro)

```json
{
  "status": false,
  "message": "Utilizador não encontrado",
  "error": "No query results for model..."
}
```

---

#### 🔹 4. Actualizar Utilizador

- **Método:** `POST`
- **Rota:** `/actualizar`
- **Descrição:** Atualiza os dados de um utilizador e/ou seu perfil.

##### 📥 JSON Requisição

```json
{
  "id": "uuid-do-utilizador",
  "name": "Lirio Manga",
  "email": "manga.lirio@.com",
  "user_type": "student",
  "gender": "masculino",
  "birthdate": "2000-05-20",
  "phone": "+258820000000",
  "address": "Ferreira Fios"
}
```

##### 📤 Resposta (Sucesso)

```json
{
  "status": true,
  "message": "Utilizador actualizado com sucesso"
}
```

##### ❌ Resposta (Erro)

```json
{
  "status": false,
  "message": "Erro ao actualizar o utilizador",
  "error": "Detalhes do erro"
}
```