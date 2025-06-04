# Desafio Jungle

Sistema simples para cadastro e consulta de cidadãos utilizando o NIS (Número de Identificação Social), desenvolvido em PHP puro com Programação Orientada a Objetos.

---

## 📋 Funcionalidades

-   Cadastro de cidadão com nome (gera NIS automaticamente);
-   Consulta de cidadão por NIS;
-   Persistência local via arquivo JSON;
-   Interface simples via navegador;
-   Arquitetura desacoplada com separação de responsabilidades.

---

## 🧰 Tecnologias utilizadas

-   PHP 8.2+
-   Composer (autoload)
-   Docker & Docker Compose
-   Padrões: OOP, separação em camadas, SRP

---

## 🚀 Como executar o projeto

### 1. Pré-requisitos

-   Docker
-   Docker Compose

### 2. Clone o repositório

```bash
git clone https://github.com/andrewwmax/desafio-jungle.git
cd desafio-jungle
```

### 3. Suba os containers

```bash
docker-compose up --build
```

### 4. Acesse no navegador

```bash
http://localhost:8080
```

Você verá a tela com:

-   Um formulário de cadastro de cidadão

-   Um formulário de busca por NIS

---

## 🗂️ Estrutura do projeto

```
.
├── app
│   ├── Core                # Entidades, contratos e serviços
│   │   ├── Contracts
│   │   └── Services
│   ├── Domain
│   ├── Http                # Controller
│   │   └── Controller
│   ├── Infrastructure      # Repositórios e persistência
│   │   └── Repository
│   ├── Storage             # Persistência dos cidadãos em JSON
│   └── Tests
├── docker
│   ├── nginx
│   └── php
├── docs
│   └── arquitetura
├── nginx
├── public                  # Entrada da aplicação (index.php)
├── vendor                  # Dependências gerenciadas pelo Composer
├── composer.json           # Autoload PSR-4
├── docker-compose.yml
├── Dockerfile
└── README.md

```

---

## ✨ Melhorias futuras (bonus)

-   [x] 🟡 Camada de apresentação mais rica com HTML/CSS/JS separados;
-   [ ] 🔴 Validações mais robustas;
-   [ ] 🔴 Testes automatizados (PHPUnit);
-   [ ] 🔜 Integração com banco de dados relacional (Postgres).

---

## 👤 Autor

Feito com 💻 por André Couto.

---
