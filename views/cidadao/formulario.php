<h1>Cadastro de Cidadãos</h1>

<form method="POST" action="/">
    <label for="nome">Nome do cidadão:</label>
    <input type="text" name="nome" id="nome" required>
    <button type="submit">Cadastrar</button>
</form>

<hr>

<h2>Pesquisar Cidadão pelo NIS</h2>

<form method="GET" action="/">
    <label for="nis">Número do NIS:</label>
    <input type="text" name="nis" id="nis" required pattern="\d{11}" minlength="11" maxlength="11">
    <button type="submit">Pesquisar</button>
</form>
