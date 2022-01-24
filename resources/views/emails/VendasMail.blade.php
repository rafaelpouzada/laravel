<!DOCTYPE html>
<html>
<head>
    <title>Relatório diário de vendas</title>
</head>
<body>
    <p>Olá!</p>
    <p>Segue abaixo o totalizador de venda do dia {{ $vendas[0]->created_at->format('d/m/Y') }}.</p>
    <strong>Muito obrigado</strong>

    <p>Total de vendas: R${{ number_format($vendas->sum('valor'), '2', ',', '.') }}</p>
</body>
</html>
