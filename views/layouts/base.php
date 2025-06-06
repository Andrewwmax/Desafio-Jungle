<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Cidadãos - Desafio Jungle</title>
    <link rel="stylesheet" href="/assets/style.css">
    <script src="/assets/script.js" defer></script>

    <!-- Adicionado para compatibilidade com alguns navegadores -->
    <script>
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

    </script>
</head>
<body>

    <main>
        <div class="container">
            <?php include __DIR__ . '/../' . $view; ?>
        </div>
    </main>

    <!-- Modal genérico -->
    <div id="modal" class="modal hidden">
        <div class="modal-content">
            <div id="modal-message"></div>
            <button id="modal-ok">OK</button>
        </div>
    </div>

</body>
</html>