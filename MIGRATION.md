# Migração para Arquitetura MVC

## Resumo das Mudanças

Este projeto foi completamente reestruturado de uma aplicação PHP procedural para uma arquitetura MVC moderna e organizada.

## Nova Estrutura de Pastas

```
WadeClub/
├── app/                        # Código da aplicação
│   ├── Controllers/            # Controladores MVC
│   │   ├── Controller.php      # Controlador base
│   │   ├── SiteController.php  # Páginas públicas
│   │   ├── AuthController.php  # Autenticação
│   │   ├── AdminController.php # Painel administrativo
│   │   └── ActionController.php # Endpoints de ações
│   ├── Models/                 # Modelos (futuro)
│   ├── Services/               # Lógica de negócio (futuro)
│   ├── Repositories/           # Acesso a dados (futuro)
│   ├── Support/                # Classes auxiliares
│   │   ├── Database.php        # Conexão PDO singleton
│   │   ├── Router.php          # Sistema de rotas
│   │   ├── Env.php             # Carregador .env
│   │   ├── Config.php          # Gerenciador de config
│   │   ├── Session.php         # Helper de sessão
│   │   ├── Csrf.php            # Proteção CSRF
│   │   ├── Validator.php       # Validação de dados
│   │   └── helpers.php         # Funções auxiliares
│   └── Views/                  # Templates
│       ├── Components/         # Componentes reutilizáveis
│       │   ├── nav.php         # Navbar
│       │   └── footer.php      # Footer
│       ├── index.php           # Página inicial
│       ├── categoria.php       # Página de categoria
│       └── [outros].php        # Wrappers para páginas legadas
├── bootstrap/                  # Inicialização
│   └── init.php                # Bootstrap da aplicação
├── config/                     # Arquivos de configuração
│   ├── app.php                 # Config da aplicação
│   └── database.php            # Config do banco de dados
├── public/                     # Pasta pública (documentRoot)
│   ├── index.php               # Front controller
│   ├── .htaccess               # Rewrite rules
│   └── assets/                 # Assets públicos
│       ├── css/                # Arquivos CSS
│       ├── js/                 # Arquivos JavaScript
│       └── images/             # Imagens
├── routes/                     # Definição de rotas
│   └── web.php                 # Rotas da aplicação
├── storage/                    # Arquivos de armazenamento
│   └── logs/                   # Logs da aplicação
├── tests/                      # Testes automatizados
│   └── SmokeTest.php           # Teste básico
├── legacy/                     # Código legado (ignorado pelo git)
│   └── [arquivos antigos].php  # Arquivos PHP originais
├── .env                        # Variáveis de ambiente
├── .env.example                # Exemplo de .env
├── .gitignore                  # Arquivos ignorados pelo git
├── .htaccess                   # Rewrite para public/
├── composer.json               # Dependências e autoload
├── conexao.php                 # Wrapper de conexão (compatibilidade)
├── index.php                   # Redirect para public/
├── phpunit.xml.dist            # Configuração de testes
└── readme.md                   # Documentação do projeto
```

## Principais Melhorias

### 1. **Separação de Responsabilidades**
- Controllers gerenciam requisições HTTP
- Models (futuro) gerenciarão dados
- Views apenas renderizam HTML
- Support classes fornecem utilidades

### 2. **Sistema de Rotas Centralizado**
- Todas as rotas definidas em `routes/web.php`
- Suporte para GET, POST e ANY
- Fallback para páginas legadas
- URLs limpas e semânticas

### 3. **Front Controller Pattern**
- Único ponto de entrada: `public/index.php`
- Todas as requisições passam pelo router
- Middleware e proteção centralizados

### 4. **PSR-4 Autoload**
- Classes carregadas automaticamente
- Namespace `App\` mapeado para `app/`
- Compatível com Composer

### 5. **Configuração Baseada em Ambiente**
- Arquivo `.env` para configurações sensíveis
- Diferentes ambientes (dev, prod)
- Config helpers para acesso fácil

### 6. **Assets Organizados**
- CSS, JS e imagens em `public/assets/`
- Separação clara entre código e recursos estáticos
- Fácil integração com CDNs no futuro

### 7. **Código Legado Isolado**
- Arquivos antigos movidos para `legacy/`
- Wrappers em `app/Views/` mantêm compatibilidade
- Migração gradual possível

## Como Funciona

### Fluxo de Requisição

1. **Requisição HTTP** → `public/index.php`
2. **Bootstrap** carrega `bootstrap/init.php`
   - Autoload PSR-4
   - Carrega .env
   - Inicia sessão
   - Configura timezone e erros
3. **Router** carrega rotas de `routes/web.php`
4. **Dispatch** identifica rota e chama controller
5. **Controller** processa lógica e retorna view
6. **View** renderiza HTML e retorna resposta

### Exemplo de Rota

```php
// routes/web.php
Router::get('/', 'SiteController@home');
Router::get('/categoria', 'SiteController@categoria');
Router::post('/login', 'AuthController@login');
```

### Exemplo de Controller

```php
// app/Controllers/SiteController.php
class SiteController extends Controller
{
    public function home()
    {
        return $this->view('index');
    }
    
    public function categoria()
    {
        return $this->view('categoria');
    }
}
```

### Helpers Disponíveis

```php
// Paths
base_path('file.php')          // Caminho absoluto do projeto
view_path('index.php')         // Caminho para views

// Config
config('app.name')             // Acessa configuração
env('APP_ENV', 'production')   // Acessa variável de ambiente

// HTTP
redirect('/login')             // Redireciona
response_json($data, 200)      // Resposta JSON

// Session
flash('success', 'Saved!')     // Flash message
csrf_token()                   // Token CSRF
```

## Migração de Páginas

### Páginas Migradas Completamente
- `index.php` - Home com carousel e produtos
- `categoria.php` - Listagem com filtros

### Páginas com Wrappers
Todas as outras páginas têm wrappers em `app/Views/` que apontam para `legacy/`:

```php
<?php require base_path('legacy/carrinho.php'); ?>
```

Isso permite que funcionem normalmente enquanto são migradas gradualmente.

## Componentes Reutilizáveis

### Navbar (`app/Views/Components/nav.php`)
- Header completo com estilos
- Navbar principal e secundária
- Barra de pesquisa
- Menu offcanvas
- Totalmente responsivo

### Footer (`app/Views/Components/footer.php`)
- Rodapé com informações institucionais
- Links e contato
- Copyright

### Uso nos Templates

```php
<?php require view_path('Components/nav.php'); ?>

<!-- Conteúdo da página -->

<?php require view_path('Components/footer.php'); ?>
```

## Database

### Conexão Singleton

```php
// Antiga forma (ainda funciona)
include('conexao.php');
$sql = mysqli_query($conexao, "SELECT ...");

// Nova forma (recomendada)
use App\Support\Database;

$pdo = Database::connection();
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);
```

### Configuração

Definida em `.env`:
```env
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=wadeclub
DB_USERNAME=root
DB_PASSWORD=
```

## Testes

### Rodar Testes

```bash
composer test
# ou
vendor/bin/phpunit
```

### Criar Novo Teste

```php
// tests/ExampleTest.php
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testBasicAssertion()
    {
        $this->assertTrue(true);
    }
}
```

## Próximos Passos

### Recomendações de Evolução

1. **Migrar páginas do legacy/**
   - Mover lógica para controllers
   - Extrair HTML para views limpas
   - Remover duplicação de código

2. **Criar Models**
   - `app/Models/Produto.php`
   - `app/Models/Usuario.php`
   - `app/Models/Pedido.php`

3. **Implementar Repositories**
   - Isolar queries SQL
   - Facilitar testes
   - Reutilizar código

4. **Adicionar Middleware**
   - Autenticação
   - Autorização (admin)
   - Rate limiting
   - CORS

5. **Validação de Forms**
   - Usar `Validator` class
   - Mensagens de erro
   - Sanitização de inputs

6. **API REST**
   - Endpoints JSON
   - Autenticação por token
   - Versionamento

7. **Cache**
   - Cache de queries
   - Cache de views
   - Redis/Memcached

8. **Queue System**
   - Envio de emails
   - Processamento de imagens
   - Notificações

## Compatibilidade

### Links Antigos
Todos os links antigos continuam funcionando:
- `/index.php` → Funciona normalmente
- `/categoria.php?cat=camiseta` → Funciona
- `/produto.php?id=1` → Funciona

### Sessões
Sistema de sessão mantido:
- `$_SESSION['id']` - ID do usuário
- `$_SESSION['nome']` - Nome do usuário  
- `$_SESSION['adm_usuario']` - Flag de admin

### Banco de Dados
Schema do banco não foi alterado. Todas as tabelas e queries antigas funcionam.

## Troubleshooting

### Erro 404
- Verifique se `.htaccess` existe na raiz e em `public/`
- Verifique se `mod_rewrite` está ativo no Apache
- Acesse via `public/index.php` diretamente

### Erro 500
- Verifique logs em `storage/logs/`
- Ative debug em `.env`: `APP_DEBUG=true`
- Verifique permissões de pastas

### Sessão não funciona
- Verifique se `session_start()` não está duplicado
- `bootstrap/init.php` já inicia a sessão
- Remova `session_start()` de arquivos legados

### CSS/JS não carrega
- Verifique caminhos em `public/assets/`
- Use caminhos relativos à raiz: `/public/assets/css/style.css`
- Ou absolutos com base URL helper

## Manutenção

### Adicionar Nova Rota

1. Defina em `routes/web.php`:
```php
Router::get('/nova-pagina', 'SiteController@novaPagina');
```

2. Crie método no controller:
```php
public function novaPagina()
{
    return $this->view('nova-pagina');
}
```

3. Crie view em `app/Views/nova-pagina.php`

### Adicionar Configuração

1. Adicione em `.env`:
```env
NOVA_CONFIG=valor
```

2. Adicione em `config/app.php` (ou novo arquivo):
```php
'nova_config' => env('NOVA_CONFIG', 'default'),
```

3. Use com helper:
```php
$valor = config('app.nova_config');
```

---

**Data da Migração:** 20/12/2025  
**Status:** ✅ Concluída  
**Compatibilidade:** 100% retrocompatível
