<?php

header('Content-Type: text/html; charset=utf-8');

$produtos = [
    ['id' => 1, 'nome' => 'Brigadeiro', 'preco' => 3.50, 'estoque' => 50],
    ['id' => 2, 'nome' => 'Beijinho', 'preco' => 3.00, 'estoque' => 45],
    ['id' => 3, 'nome' => 'Doce de Leite', 'preco' => 4.25, 'estoque' => 30],
];

$carrinho = [];

function encontrarProduto(int $id, array $produtos): ?array
{
    foreach ($produtos as $produto) {
        if ($produto['id'] === $id) {
            return $produto;
        }
    }
    return null;
}

function atualizarEstoque(int $id, int $quantidade, array &$produtos): void
{
    foreach ($produtos as &$p) {
        if ($p['id'] === $id) {
            $p['estoque'] += $quantidade;
            break;
        }
    }
    unset($p);
}

function adicionarItemAoCarrinho(int $id, int $quantidade, array $carrinho, array &$produtos): array
{
    $produtoEncontrado = encontrarProduto($id, $produtos);

    if ($produtoEncontrado === null) {
        echo "Erro: Produto com ID $id não encontrado.<br>";
        return $carrinho;
    }

    if ($quantidade > $produtoEncontrado['estoque']) {
        echo "Erro: Estoque insuficiente para o produto {$produtoEncontrado['nome']}.<br>";
        return $carrinho;
    }

    if (!array_key_exists($id, $carrinho)) {
        $carrinho[$id] = [
            'id_produto' => $id,
            'quantidade' => 0,
            'nome' => $produtoEncontrado['nome'],
            'preco' => $produtoEncontrado['preco'],
        ];
    }
    
    $carrinho[$id]['quantidade'] += $quantidade;
    $carrinho[$id]['subtotal'] = $carrinho[$id]['quantidade'] * $carrinho[$id]['preco'];

    atualizarEstoque($id, -$quantidade, $produtos); // Chama a nova função DRY

    return $carrinho;
}

function removerItemDoCarrinho(int $id, array $carrinho, array &$produtos): array
{
    if (!isset($carrinho[$id])) {
        echo "Erro: O item não existe no carrinho.<br>";
        return $carrinho;
    }

    $quantidade = $carrinho[$id]['quantidade'];
    atualizarEstoque($id, $quantidade, $produtos); // Chama a nova função DRY
    
    unset($carrinho[$id]);
    return $carrinho;
}

function listarItensDoCarrinho(array $carrinho): void
{
    echo "Itens do Carrinho:<br>";
    if (empty($carrinho)) {
        echo "O carrinho está vazio.<br>";
        return;
    }
    foreach ($carrinho as $item) {
        echo "ID: {$item['id_produto']} | Produto: {$item['nome']} | Qtd: {$item['quantidade']} | Subtotal: R$ " . $item['subtotal'] . "<br>";
    }
}

function calcularTotal(array $carrinho, string $cupom = ''): float
{
    $total = 0;
    foreach ($carrinho as $item) {
        $total += $item['subtotal'];
    }

    if ($cupom === 'DESCONTO10') {
        echo "Cupom 'DESCONTO10' aplicado! Desconto de 10%.<br>";
        $total *= 0.90;
    }

    return $total;
}

echo "Simulador de Carrinho de Compras<br><br>";

echo "Cenário: Adicionar Brigadeiro (id=1, 2 unidades)<br>";
$carrinho = adicionarItemAoCarrinho(1, 2, $carrinho, $produtos);
listarItensDoCarrinho($carrinho);
echo "Estoque atual do Brigadeiro (id=1): " . encontrarProduto(1, $produtos)['estoque'] . "<br><br>";

echo "Cenário: Adicionar Doce de Leite (id=3, 40 unidades)<br>";
$carrinho = adicionarItemAoCarrinho(3, 40, $carrinho, $produtos);
echo "<br>";

echo "Cenário: Remover Brigadeiro (id=1)<br>";
$carrinho = removerItemDoCarrinho(1, $carrinho, $produtos);
echo "Carrinho após a remoção:<br>";
listarItensDoCarrinho($carrinho);
echo "Estoque atual do Brigadeiro (id=1): " . encontrarProduto(1, $produtos)['estoque'] . "<br><br>";

$carrinho = adicionarItemAoCarrinho(2, 5, $carrinho, $produtos);
echo "Cenário: Aplicar cupom de desconto 'DESCONTO10'<br>";
echo "Total do carrinho: R$ " . calcularTotal($carrinho) . "<br>";
echo "Total com desconto: R$ " . calcularTotal($carrinho, 'DESCONTO10') . "<br>";