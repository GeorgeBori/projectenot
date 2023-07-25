<div class="container bg-light p-5 rounded">
    <h1>Register page</h1>
    <p class="lead">Welcome to our currency conversion registration page!</p>
    <?php
    /** @var string $status */
    switch ($status) {
        case 'error':
            echo '<div class="alert alert-danger" role="alert">Registration error!</div>';
            break;
        case 'success':
            echo '<div class="alert alert-success" role="alert">Registration success!</div>';
            break;
        default:
            break;
    }
    ?>
    <form method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <input type="submit" class="btn btn-primary btn-block" value="Register">
    </form>
</div>
