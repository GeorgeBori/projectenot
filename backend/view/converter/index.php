<div class="container bg-light p-5 rounded">
    <h1>Header</h1>
    <p class="lead">Welcome to our currency conversion page!</p>
    <?php
    if (isset($value)) {
        echo '<div class="alert alert-info" role="alert">Convertation reslut: ' . $value . '</div>';
    }
    ?>
    <?php
    if (isset($error)) {
        echo '<div class="alert alert-danger" role="alert">Error reslut: ' . $error . '</div>';
    }
    ?>
    <form method="post">
        <div class="mb-3">
            <label for="amount" class="form-label">Amount:</label>
            <input type="number" class="form-control" id="amount" name="amount" step="0.01" min="0">
        </div>

        <div class="mb-3">
            <label for="from" class="form-label">From:</label>
            <select class="form-select" id="from" name="from">
                <?php
                /** @var array $currencies */
                foreach ($currencies as $currency): ?>
                    <option value="<?= $currency->code ?>"><?= $currency->code ?></option>
                <?php
                endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="to" class="form-label">To:</label>
            <select class="form-select" id="to" name="to">
                <?php
                /** @var array $currencies */
                foreach ($currencies as $currency): ?>
                    <option value="<?= $currency->code ?>"><?= $currency->code ?></option>
                <?php
                endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <input type="submit" class="btn btn-primary" value="Convert">
        </div>
    </form>
</div>