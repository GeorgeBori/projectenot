<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Hello, world!</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Example</a>
        <button class="navbar-toggler" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link active" href="/">Home</a>
                </li>
                <?php
                if (!$this->isGuest()): ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="/converter/index">Converter</a>
                    </li>
                <?php
                endif; ?>
            </ul>
            <div class="vr"></div>
            <ul class="navbar-nav ms-auto">
                <?php
                if ($this->isGuest()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/site/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/site/register">Register</a>
                    </li>
                <?php
                else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/site/logout">Logout</a>
                    </li>
                <?php
                endif; ?>
            </ul>
        </div>
    </div>
</nav>

<main class="container">
