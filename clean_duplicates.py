import re
import os

files_to_clean = [
    'tela_adm.php', 'adm_usuarios.php', 'adm_produtos.php', 'adm_enderecos.php',
    'adm_editar_produto.php', 'adm_excluir_produtos.php', 'adm_informacoes.php',
    'cadastro_produtos.php', 'Carrinho.php', 'favoritos.php',
    'informacoes_usuario.php', 'informacoes_endereco.php', 'login.php', 'base.php',
    'produto.php', 'categoria.php'
]

for filename in files_to_clean:
    if not os.path.exists(filename):
        print(f"⊘ {filename}: Não encontrado")
        continue
    
    try:
        with open(filename, 'r', encoding='utf-8') as f:
            content = f.read()
        
        original = content
        
        # Remover tudo entre o include do nav e o <main (navbar/offcanvas duplicados)
        pattern = r'(Components/nav\.php"; \?>).*?(<main|<!-- CONTEÚDO PRINCIPAL -->|<div class="container)'
        content = re.sub(pattern, r'\1\n\n\2', content, flags=re.DOTALL)
        
        if content != original:
            with open(filename, 'w', encoding='utf-8') as f:
                f.write(content)
            print(f"✓ {filename}: Navbar/offcanvas duplicados removidos")
        else:
            print(f"⊘ {filename}: Sem alteração")
            
    except Exception as e:
        print(f"✗ {filename}: Erro - {e}")

print("\n=== CONCLUÍDO ===")
