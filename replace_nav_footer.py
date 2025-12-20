import re
import glob

# Arquivos para processar
files = [
    'produto.php', 'categoria.php', 'Carrinho.php', 'favoritos.php',
    'informacoes_usuario.php', 'informacoes_endereco.php',
    'tela_adm.php', 'adm_usuarios.php', 'adm_produtos.php', 'adm_enderecos.php',
    'adm_editar_produto.php', 'adm_excluir_produtos.php', 'adm_informacoes.php',
    'cadastro_produtos.php', 'cadastro.php', 'login.php', 'base.php'
]

for filename in files:
    try:
        with open(filename, 'r', encoding='utf-8') as f:
            content = f.read()
        
        original_content = content
        
        # Substituir navbar (desde <!-- NAVBAR PRINCIPAL --> até </div> antes de OFFCANVAS ou main)
        pattern_nav = r'<!-- NAVBAR PRINCIPAL -->.*?<!-- OFFCANVAS \(Menu Lateral\) -->'
        if re.search(pattern_nav, content, re.DOTALL):
            content = re.sub(pattern_nav, r'<?php include "Components/nav.php"; ?>\n\n', content, flags=re.DOTALL)
            print(f"✓ {filename}: Navbar substituído")
        
        # Substituir footer (desde <!-- FOOTER --> até </footer>)
        pattern_footer = r'<!-- FOOTER -->.*?</footer>'
        if re.search(pattern_footer, content, re.DOTALL):
            content = re.sub(pattern_footer, r'<?php include "Components/footer.php"; ?>', content, flags=re.DOTALL)
            print(f"✓ {filename}: Footer substituído")
        
        # Salvar apenas se houve mudança
        if content != original_content:
            with open(filename, 'w', encoding='utf-8') as f:
                f.write(content)
            print(f"✓✓ {filename}: SALVO\n")
        else:
            print(f"⊘ {filename}: Nenhuma alteração necessária\n")
            
    except FileNotFoundError:
        print(f"✗ {filename}: Arquivo não encontrado\n")
    except Exception as e:
        print(f"✗ {filename}: Erro - {e}\n")

print("\n=== CONCLUÍDO ===")
