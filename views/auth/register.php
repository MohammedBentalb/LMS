<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/forms.css">
    <title>LMS | Registeration</title>
</head>
<body>
    <section class="parent-c auth-parent">

        <form method="POST" action="/auth/register" class="form auth-form">
            <div class="auth-title">
                <h1>Create an account</h1>
                <h3>Start your learning journey today</h3>
            </div>
            <div class="form-field">
                <label for="user-name">Name:</label>
                <input id="user-name" name="user-name" type="text" placeholder="Mohammed bentalb">
                <p class="error-field is-hidden" data-error-name="name" ></p>
            </div>
            <div class="form-field">
                <label for="user-email">Email:</label>
                <input id="user-email" name="user-email" type="email" placeholder="example@gmail.com">
                <p class="error-field is-hidden" data-error-name="email" ></p>
            </div>
            <div class="form-field">
                <label for="user-password">Password:</label>
                <input id="user-password" name="user-password" type="password" placeholder="********" min=8>
                <p class="error-field is-hidden" data-error-name="password" ></p>
            </div>
            <div class="form-field">
                <label for="user-match">Confirm Password:</label>
                <input id="user-match" name="user-match" type="password" placeholder="********" min=8>
                <p class="error-field is-hidden" data-error-name="match"></p>
            </div>
            <p class="error-field" style="text-align: center;"><?= $authError ?? null ?></p>
            <button>Register</button>
            <p class="already">Already have an account? <span> <a href="/auth/view/login">Log in</a></span></p>
        </form>
    </section>
    <script src="/js/auth/register_form.js" type="module" defer></script>
</body>
</html>