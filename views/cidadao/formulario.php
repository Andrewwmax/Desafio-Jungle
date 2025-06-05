<h1>Cadastro e Consulta de Cidadãos</h1>

<!-- Formulário de Cadastro -->
<form id="formCadastro">
    <input type="text" name="nome" placeholder="Nome do cidadão" required>
    <input type="hidden" name="action" value="cadastrar">
    <button type="submit">Cadastrar</button>
</form>

<br>

<!-- Formulário de Consulta -->
<form id="formBusca">
    <input type="text" name="nis" placeholder="NIS" required>
    <input type="hidden" name="action" value="buscar">
    <button type="submit">Buscar</button>
</form>

<!-- Modal -->
<div id="modal" class="modal" style="display:none;">
    <div class="modal-content">
        <p id="modal-message"></p>
        <button onclick="fecharModal()">OK</button>
    </div>
</div>

<script>
function exibirModal(mensagem) {
    document.getElementById('modal-message').innerText = mensagem;
    document.getElementById('modal').style.display = 'flex';
}

function fecharModal() {
    document.getElementById('modal').style.display = 'none';
}

document.getElementById('formCadastro').addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    console.log(formData)
    const response = await fetch('/', {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        body: formData
    });
    const data = await response.json();
    console.log(data)
    exibirModal(data.mensagem || 'Erro ao cadastrar');
});

document.getElementById('formBusca').addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const response = await fetch('/', {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        body: formData
    });
    const data = await response.json();
    if (data.cidadao) {
        exibirModal(`Cidadão: ${data.cidadao.nome}\nNIS: ${data.cidadao.nis}`);
    } else {
        exibirModal('Cidadão não encontrado.');
    }
});
</script>

<style>
.modal {
    position: fixed;
    top: 0; left: 0;
    width: 100vw; height: 100vh;
    background: rgba(0, 0, 0, 0.5);
    display: flex; justify-content: center; align-items: center;
    z-index: 1000;
}

.modal-content {
    background: white;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    max-width: 300px;
}
</style>
