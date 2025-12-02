# Wade Club E-commerce

### PAC - Projeto de Aprendizagem Colaborativa Extensionista do Curso de Engenharia de Software da Católica de Santa Catarina

**Autores:**
* Wellerson Kauan Meredyk
* Leonardo Raye

**Professores Orientadores:**
* Luiz Carlos Camargo
* Claudinei Dias

---

## 🎯 Justificativa
O projeto foi desenvolvido para a **Wade Club**, uma loja de streetwear local. A entidade beneficiada enfrentava dificuldades de escalabilidade, pois realizava 100% das suas vendas de forma manual através de mensagens diretas (DM) no Instagram. Isso gerava falta de controle de estoque, demora no atendimento e perda de vendas. O sistema web foi criado para automatizar esse processo, centralizar o catálogo e oferecer gestão administrativa.

## 💻 Descrição do App
O **Wade Club E-commerce** é uma aplicação web Full Stack.
* **Front-end:** Interface responsiva focada na experiência do usuário (UX) com identidade visual "street".
* **Back-end:** Sistema de autenticação, gestão de sessão e CRUD completo.
* **Funcionalidades do Usuário:** Cadastro/Login, busca de produtos, carrinho de compras e visualização de detalhes.
* **Funcionalidades do Admin:** Painel administrativo para cadastro de produtos (upload de imagens), edição de estoque e gestão de usuários.

## ⚙️ Ambiente de Desenvolvimento (Requisitos)
Para executar o projeto localmente:
1.  **Servidor Web:** Apache (Recomendado uso do XAMPP ou WAMP).
2.  **Linguagem:** PHP 7.4 ou superior.
3.  **Banco de Dados:** MySQL / MariaDB.
4.  **Configuração:**
    * Clone o repositório em `htdocs` (XAMPP) ou `www` (WAMP).
    * Importe o arquivo `banco_de_dados.sql` (fornecido na raiz) no seu gerenciador MySQL (phpMyAdmin).
    * Configure a conexão no arquivo `conexao.php`.

---

## 📸 Telas do Sistema

### 1. Home Page e Identidade Visual
Página inicial com banners promocionais e destaque para a identidade visual renovada da marca.
![Home Page](img/Captura de tela 2025-12-02 011540.png)

### 2. Catálogo e Carrinho de Compras
Sistema que permite ao usuário adicionar itens ao carrinho, calculando o total da compra.
![Carrinho](image_df9ea2.png)

### 3. Painel do Administrador (CRUD)
Área restrita onde o administrador pode visualizar, editar e excluir produtos e usuários.
![Painel Admin](image_df9ec1.jpg)

### 4. Cadastro de Produtos
Formulário para inserção de novos itens no banco de dados, incluindo upload de imagens e definição de categorias.
![Cadastro de Produtos](image_e0f3a2.png)
