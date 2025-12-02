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
O projeto foi desenvolvido para a **Wade Club**, uma loja de streetwear que operava suas vendas exclusivamente via Instagram. A ausência de um sistema centralizado gerava problemas de controle de estoque e sobrecarga no atendimento ao cliente. A solução web foi criada para automatizar o fluxo de vendas, profissionalizar a gestão de pedidos e oferecer autonomia ao consumidor final.

## 💻 Descrição do App
O **Wade Club E-commerce** é uma aplicação web Full Stack desenvolvida com foco em usabilidade e segurança.

**Principais Funcionalidades:**
* **Autenticação e Segurança:** Sistema de login com distinção de níveis de acesso. Rotas administrativas (painel de gestão) são protegidas e inacessíveis a usuários comuns. O acesso ao carrinho de compras exige login ativo, redirecionando visitantes não autenticados para a tela de entrada.
* **Integração via API:** O formulário de cadastro consome uma API externa para preenchimento automático de endereço (Rua, Bairro, Cidade, Estado) ao digitar o CEP, otimizando a experiência do usuário (UX).
* **Gestão de Produtos (CRUD):** O administrador possui controle total para criar, ler, atualizar e excluir produtos e categorias.
* **Gestão de Usuários:** O administrador pode visualizar a lista de clientes cadastrados e seus respectivos endereços de entrega.

## ⚙️ Ambiente de Desenvolvimento
Para executar o projeto:
1.  **Servidor:** XAMPP ou WAMP (Apache + MySQL).
2.  **Linguagem:** PHP 7.4+.
3.  **Banco de Dados:** Importar `banco_de_dados.sql` (disponível na raiz).
4.  **Configuração:** Ajustar credenciais em `conexao.php`.

---

## 📸 Telas do Sistema

### 1. Home e Identidade Visual
Página inicial responsiva com banners promocionais e listagem de produtos.
![Home Page](image_df9e44.jpg)

### 2. Cadastro Inteligente
Formulário com busca automática de CEP para agilizar o registro.
![Cadastro](image_df9e81.png)

### 3. Painel Administrativo (Gestão de Usuários)
Área restrita para controle de base de clientes e endereços.
![Lista Usuários](image_df9e83.jpg)

### 4. Carrinho de Compras
Sistema de checkout que calcula totais automaticamente (acesso restrito a logados).
![Carrinho](image_df9ea2.png)