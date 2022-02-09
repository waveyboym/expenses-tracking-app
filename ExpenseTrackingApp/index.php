<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Expenses Tracking App</title>
</head>
<body>
    <div class="main-login-form">
        <div class="main-img">

        </div>
        <div class="login">
            <h1>Expenses Tracking App</h1>
            <h2>Login here</h2>
            <form action="loginsignupFiles/loginFile.php" method="post">
                <input type="text" name="Userid" placeholder="Username">
                <br>
                <input type="password" name="Userpwd" placeholder="Password">
                <br>
                <button type="submit" name="submit">Login</button>
            </form>
            <h3>Don't have an account?</h3>
            <h4 onclick=switchForm()>SignUp here</h4>
        </div>
    </div>
</body>
</html>

<script>
let switchForm = function(){
    let getSignupClass = document.querySelector(".signup");
    let getLoginClass = document.querySelector(".login");
    let getMainForm = document.querySelector(".main-login-form");

    if(getLoginClass != null){
        let newSignUp = document.createElement("div");
        newSignUp.className = "signup";

        newSignUp.innerHTML = '<h1>Expenses Tracking App</h1>'
                            +'<h2>SignUp here</h2>'
                            +'<form action="loginsignupFiles/signupFile.php" method="post">'
                                +'<input type="text" name="Userid" placeholder="Username">'
                                +'<br>'
                                +'<input type="password" name="Userpwd" placeholder="Password">'
                                +'<br>'
                                +'<input type="password" name="Userpwdrpt" placeholder="Repeat Password">'
                                +'<br>'
                                +'<input type="text" name="Usereml" placeholder="Email">'
                                +'<br>'
                                +'<button type="submit" name="submit">Sign Up</button>'
                            +'</form>'
                            +'<h3 onclick=switchForm()>Actually, I do have an account</h3>';
        getMainForm.replaceChild(newSignUp, getLoginClass);
              
    }
    else if(getSignupClass != null){
        let newLogin = document.createElement("div");
        newLogin.className = "login";

        newLogin.innerHTML = '<h1>Expenses Tracking App</h1>'
                            +'<h2>Login here</h2>'
                            +'<form action="loginsignupFiles/loginFile.php" method="post">'
                                +'<input type="text" name="Userid" placeholder="Username">'
                                +'<br>'
                                +'<input type="password" name="Userpwd" placeholder="Password">'
                                +'<br>'
                                +'<button type="submit" name="submit">Login</button>'
                            +'</form>'
                            +"<h3>Don't have an account?</h3>"
                            +'<h4 onclick=switchForm()>SignUp here</h4>';

        getMainForm.replaceChild(newLogin, getSignupClass); 
       
    }
}
</script>