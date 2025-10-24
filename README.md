# 🚀 FIAP PHP Projeto

Projeto desenvolvido em **PHP 8.2.12**, utilizando boas práticas e estrutura organizada para facilitar manutenção.

---

## 🛠 Tecnologias Utilizadas

- 🐘 **PHP 8.2.12**
- 💻 **MVC (Model-View-Controller)**
- 🌐 **MySQL 8** (via **XAMPP 3.3.0**)
- 🎨 **Tailwind CSS**
- 🔑 **phpdotenv** para variáveis de ambiente
- 🛡 **Proteção CSRF** em todos os controller

## 🛠️ Passo a passo para rodar o projeto

### 1. Clonar o repositório

```bash
git clone https://github.com/yagofontoura/fiap-projeto.git
```

### 2. Configurar banco de dados

- Estrutura da base de dados disponível em:

  ```
  ./database/secretaria_fiap.sql
  ```

```bash
  mysql -u root -p
```

```bash
  mysql> source secretaria_fiap.sql;
```

### 3. Configurar conexão com o banco

- Copie o arquivo:

```bash
.env_example
```

- Renomeie para:
  ```bash
  .env
  ```
- Edite com suas credenciais de banco de dados.

### 4. Instalar dependências

Execute no terminal dentro da pasta do projeto:

```bash
composer install
```

### 5. Acessar o projeto

Suba o projeto em seu servidor local (ex: **XAMPP, WAMPP ou similar**) e acesse pelo navegador.

---

## 🔑 Credenciais de Admin

```
Email: admin@fiap.com.br
Senha: Fiap@2025
```

---

## 📂 Estrutura do Projeto

```
fiap-php/
│── app/              # Arquivos de configuração (ex: database.php)
│── database/         # Dump da base de dados
│── public/           # Pasta pública do servidor (js, css, imagens)
│── resources/        # Código fonte (controllers, models, services)
│── routes/           # Rotas da aplicação
│── vendor/           # Dependências do Composer
│── .env              # Variáveis de ambiente
│── .gitignore/       # Ignore certos arquivos para não serem versionados
│── composer.json     # Gerenciador de dependências do Composer
│── README.md         # Este arquivo
```

---
