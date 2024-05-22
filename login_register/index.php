<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h2>Kuwar Singh</h2>
        <nav>
            <a href="#">HOME</a>
            <a href="#">BLOG</a>
            <a href="#">CONTACT</a>
            <a href="#">ABOUT</a>
        </nav>
        <div class="sign-in-up">
            <button type="button">LOGIN</button>
            <button type="button">REGISTER</button>
        </div>
    </header>
    <div class="popup-container">
        <div class="popup">
            <form>
                <h2>
                    <span>USER LOGIN</span>
                    <button type="reset">X</button>
                </h2>
                <input type="text" placeholder="Email or username">
                <input type="password" placeholder="Password">
                <button type="submit" class="login-btn">LOGIN</button>
            </form>
        </div>
    </div>
</body>
</html>