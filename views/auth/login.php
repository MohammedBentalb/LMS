<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/forms.css">
    <title>LMS | Register</title>
</head>
<body>
    <section class="parent-c auth-parent">
        <form method="POST" action="/auth/login" class="form auth-form">
            <div class="auth-title">
                <h1>Welcome back</h1>
                <h3>Enter your credentials to access your account</h3>
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
            <p class="error-field" style="text-align: center;"><?= $authError ?? null ?></p>
            <button>Login</button>
            <p class="already">Don't have an account? <span> <a href="/auth/view/register">Register</a></span></p>
        </form>
    </section>
    <script src="/js/auth/login_form.js" type="module" defer></script>
</body>
</html>