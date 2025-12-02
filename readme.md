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
<img width="1897" height="847" alt="Image" src="https://github.com/user-attachments/assets/2463c9a5-f8c6-435f-b19d-c99aa4d7c1c8" />
<img width="1870" height="843" alt="Image" src="https://github.com/user-attachments/assets/34728071-5e12-4262-a581-35dd9d087d60" />

### 2. Catálogo e Carrinho de Compras
Sistema que permite ao usuário adicionar itens ao carrinho, calculando o total da compra.
<img width="1909" height="846" alt="Image" src="https://github.com/user-attachments/assets/da9d29ac-7e56-4532-a54e-d5c5cc1eb4a4" />

### 3. Painel do Administrador (CRUD)
Área restrita onde o administrador pode visualizar, editar e excluir produtos e usuários.
<img width="1900" height="851" alt="Image" src="https://github.com/user-attachments/assets/cd982988-8a15-43dc-83a4-1e73aa766127" />
<img width="1856" height="806" alt="Image" src="https://github.com/user-attachments/assets/fc9c08a3-569e-40c0-b167-e65f1f0a8b64" />

### 4. Cadastro de Produtos
Formulário para inserção de novos itens no banco de dados, incluindo upload de imagens e definição de categorias.
<img width="1702" height="822" alt="Image" src="https://github.com/user-attachments/assets/f509809b-82cd-45ef-b405-fa49e35636e5" />