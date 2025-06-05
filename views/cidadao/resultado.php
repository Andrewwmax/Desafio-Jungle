<?php if ($encontrado): ?>
    <div class="mensagem">
        <strong>Resultado encontrado:</strong><br>
        Nome: <?= htmlspecialchars($cidadao->getNome()) ?><br>
        NIS: <?= $cidadao->getNis() ?>
    </div>
    <div>
        <button onclick="history.back()">Voltar</button>
    </div>
<?php else: ?>
    <div class="mensagem" style="background: #ffdddd; border-left-color: #f44336;">
        <strong>Cidadão não encontrado.</strong>
    </div>
    <div>
        <button onclick="history.back()">Voltar</button>
    </div>
<?php endif; ?>
