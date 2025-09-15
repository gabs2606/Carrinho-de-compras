Repositório para armazenar o código do nosso projeto.

Dupla: Gabriel Veloso (RA:1990821) e Gabriela Lima (RA:2014108)

#Carrinho de compras

Este é um projeto em PHP para simular as funcionalidades básicas de um carrinho de compras. O código permite adicionar e remover produtos, calcular o total da compra e aplicar cupons de desconto.

#Como Executar:
Salve o código em um arquivo com a extensão .php (ex: carrinho.php).

Abra o terminal (ou o Prompt de Comando/PowerShell no Windows).

Navegue até a pasta onde você salvou o arquivo.

#Funcionalidades:
Gerenciamento de Produtos: Um array simples com dados de produtos (nome, preço, estoque).

Adicionar Item: Adiciona um produto ao carrinho e atualiza o estoque disponível.

Remover Item: Remove um produto do carrinho e devolve a quantidade para o estoque.

Listar Carrinho: Exibe todos os itens no carrinho, suas quantidades e subtotais.

Calcular Total: Calcula o valor final da compra.

Aplicar Cupom: Permite aplicar um desconto de 10% no total.

#Exemplos de Uso (Casos Simulados)
Ao executar o script, você verá a saída para os seguintes cenários:

Adicionar Item: O sistema adiciona 2 unidades de "Brigadeiro" ao carrinho e mostra o estoque atualizado.

Adicionar Item Além do Estoque: Uma tentativa de adicionar 40 unidades de "Doce de Leite" que falha, exibindo uma mensagem de erro por falta de estoque.

Remover Item: O "Brigadeiro" é removido do carrinho, e a quantidade de volta ao estoque é mostrada.

Aplicar Cupom: O código adiciona um novo item e, em seguida, calcula o total da compra duas vezes: uma sem e outra com o cupom de desconto "DESCONTO10".

#Princípios de Design Aplicados
O projeto foi construído seguindo dois princípios de design essenciais para um código limpo e fácil de manter:

DRY (Don't Repeat Yourself - Não se Repita): A lógica de atualização de estoque, que seria repetida em várias funções, foi isolada em uma única função (atualizarEstoque). Isso evita erros e torna o código mais fácil de modificar.

KISS (Keep It Simple, Stupid - Mantenha Simples): Cada função tem uma única responsabilidade. Por exemplo, a função de adicionar item só adiciona, e a de listar só lista. Essa clareza torna o código mais fácil de entender e depurar.
