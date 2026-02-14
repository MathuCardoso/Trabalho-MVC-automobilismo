# Projeto MVC de Automobilismo

Aplicacao web em PHP puro (sem framework) para gerenciamento de **categorias**, **equipes** e **pilotos** de automobilismo.

## Tecnologias Utilizadas

- PHP 8+
- MySQL / MariaDB
- PDO (acesso a banco)
- HTML5
- CSS3
- JavaScript (vanilla)
- Apache (XAMPP)

## Arquitetura

O projeto segue padrao **MVC** com separacao por camadas:

- `app/controller`: controllers e fluxo das requisicoes
- `app/model`: entidades de dominio
- `app/repository`: DAOs e consultas SQL
- `app/service`: regras de negocio e validacoes
- `app/routing`: roteamento e method spoofing (`PUT`/`DELETE` via `__method`)
- `public/view`: views
- `public/css`, `public/js`, `public/assets`: arquivos estaticos
- `public/uploads`: upload de imagens de categorias e pilotos

## Funcionalidades

- CRUD de categorias
- CRUD de equipes
- CRUD de pilotos
- Upload de imagem para categoria (logo)
- Upload de imagem para piloto (foto)
- Validacao de campos obrigatorios
- Regra para limitar pilotos por equipe (dupla)
- Interface com listagem e formularios de cadastro/edicao

## Requisitos

- PHP com extensao `pdo_mysql` habilitada
- Banco MySQL/MariaDB ativo

## Como Executar

1. Inicie o servidor built-in do PHP: `php -S localhost:numeroDaPorta`.
2. Crie o banco de dados `automobilismo`.
3. Execute o script SQL base (`script.sql`) no banco.
4. Confira as credenciais em `configs/Database.php`:
5. Acesse no navegador:
   - `http://localhost:numeroDaPorta/`

## Rotas Principais

- `GET /` -> home
- `GET|POST|PUT|DELETE /categorias`
- `GET|POST|PUT|DELETE /equipes`
- `GET|POST|PUT|DELETE /pilotos`

> Observacao: `PUT` e `DELETE` sao simulados por formulario com campo oculto `__method`.

## Banco de Dados

Entidades principais:

- `categorias`
- `equipes` (FK para `categorias`)
- `pilotos` (FK para `equipes`)

## Observacoes Importantes

- O projeto usa autoload proprio (`autoload.php`) baseado no namespace `App\\`.
- Os uploads sao salvos em `public/uploads/categorias` e `public/uploads/pilotos`.

## Autor
Matheus de Souza Cardoso

Projeto academico da disciplina de desenvolvimento web com padrao MVC.
