import re
import os

# Lista de arquivos para processar
files_to_process = [
    'Carrinho.php', 'favoritos.php', 'informacoes_usuario.php', 'informacoes_endereco.php',
    'tela_adm.php', 'adm_usuarios.php', 'adm_produtos.php', 'adm_enderecos.php',
    'adm_editar_produto.php', 'adm_excluir_produtos.php', 'adm_informacoes.php',
    'cadastro_produtos.php', 'login.php', 'base.php', 'cadastro.php'
]

def replace_navbar_footer(filename):
    try:
        if not os.path.exists(filename):
            print(f"✗ {filename}: Não encontrado")
            return False
            
        with open(filename, 'r', encoding='utf-8') as f:
            content = f.read()
        
        original = content
        modified = False
        
        # Padrão 1: Navbar completo (<!-- NAVBAR PRINCIPAL --> até antes de <main ou <!-- CONTEÚDO)
        # Procurar por <body> e substituir tudo até <main
        pattern1 = r'(<body[^>]*>\s*)(<!-- NAVBAR PRINCIPAL -->.*?)(<main|<!-- CONTEÚDO|<!-- BANNERS)'
        if re.search(pattern1, content, re.DOTALL | re.IGNORECASE):
            content = re.sub(
                pattern1,
                r'\1<?php include "Components/nav.php"; ?>\n\n\3',
                content,
                flags=re.DOTALL | re.IGNORECASE
            )
            modified = True
            print(f"  ✓ Navbar substituído")
        
        # Padrão 2: Navbar antigo admin (navbar bg-dark ou bg-primary)
        pattern2 = r'(<body[^>]*>\s*)(<!-- rodapé superior -->.*?</nav>.*?</div>\s*</nav>.*?</div>.*?</div>)(\s*<)'
        if re.search(pattern2, content, re.DOTALL):
            content = re.sub(
                pattern2,
                r'\1<?php include "Components/nav.php"; ?>\n\n\3',
                content,
                flags=re.DOTALL
            )
            modified = True
            print(f"  ✓ Navbar antigo substituído")
        
        # Salvar se houve mudança
        if modified or content != original:
            with open(filename, 'w', encoding='utf-8') as f:
                f.write(content)
            print(f"✓✓ {filename}: SALVO\n")
            return True
        else:
            print(f"⊘ {filename}: Sem mudanças\n")
            return False
            
    except Exception as e:
        print(f"✗ {filename}: Erro - {e}\n")
        return False

print("=== SUBSTITUINDO NAVBARS E FOOTERS ===\n")
count = 0
for fname in files_to_process:
    print(f"Processando: {fname}")
    if replace_navbar_footer(fname):
        count += 1

print(f"\n=== CONCLUÍDO: {count} arquivos modificados ===")
