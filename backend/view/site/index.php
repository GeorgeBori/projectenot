<div class="container bg-light p-5 rounded">
    <h1>Main page</h1>
    <p class="lead">Welcome to our currency conversion main page!</p>
    <div class="text-end">
        <?php if ($this->isGuest()): ?>
            <a href="/site/login" class="btn btn-outline-primary">Login</a>
            <a href="/site/register" class="btn btn-primary">Register</a>
        <?php else: ?>
            <a href="/converter/index" class="btn btn-primary">Converter</a>
        <?php endif; ?>
    </div>
</div>
