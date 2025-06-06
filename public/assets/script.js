function showModal(message) {
	document.addEventListener("DOMContentLoaded", () => {
		const modal = document.getElementById("modal");
		const modalMessage = document.getElementById("modal-message");
		const modalOk = document.getElementById("modal-ok");

		if (!modal || !modalMessage || !modalOk) {
			console.error("Modal elements not found in DOM.");
			return;
		}

		modalMessage.innerText = message;
		modal.classList.remove("hidden");
		modal.classList.add("fade-in");

		modalOk.onclick = () => {
			modal.classList.remove("fade-in");
			modal.classList.add("fade-out");
			setTimeout(() => {
				modal.classList.add("hidden");
				modal.classList.remove("fade-out");
			}, 500);
			window.location.href = "/"; // Adiciona o redirecionamento
		};
	});
}
/** @deprecated
 *  old
 */
function exibirModal(mensagem) {
	document.getElementById("modal-message").innerText = mensagem;
	document.getElementById("modal").style.display = "flex";
}

function fecharModal() {
	document.getElementById("modal").style.display = "none";
}
{
	/* 
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
}); */
}
