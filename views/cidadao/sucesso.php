<?php if (isset($data)): ?>
    <script>
        showModal("<?= htmlspecialchars($data['message']) . '\n' . 'Nome: ' . htmlspecialchars($data['nome']) . '\nNIS: ' . htmlspecialchars($data['nis']) ?>");
    </script>
<?php endif; ?>