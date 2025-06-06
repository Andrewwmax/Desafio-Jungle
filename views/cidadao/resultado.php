<?php if (isset($data)): ?>
    <?php if ($data['found']): ?>
        <script>
            showModal("<?= htmlspecialchars($data['message']) . '\nNIS: ' . htmlspecialchars($data['nis']) ?>");
        </script>
    <?php else: ?>
        <script>
            showModal("<?= htmlspecialchars($data['message']) ?>");
        </script>
    <?php endif; ?>
<?php endif; ?>
