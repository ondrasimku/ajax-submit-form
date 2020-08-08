<!DOCTYPE html>
<html lang="cz" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Login - PHP</title>
  </head>

  <body>
  <h1> My AJAX login form</h1>
    <div class="error-message" id="error">
      <ul id="form-messages">
      </ul>
    </div>
    <div class="login-form">
        <label for="username">Username</label>
        <input type="text" id="username"><br>
        <label for="password">Password</label>
        <input type="password" id="password">
        <input type="submit" id="submit" value="Submit">
    </div>
  </body>

  <script type="text/javascript">

      const form = {
        username: document.getElementById('username'),
        password: document.getElementById('password'),
        submit: document.getElementById('submit'),
        messages: document.getElementById('form-messages'),
      };

      console.log(form);

      form.submit.addEventListener('click', () => {

          console.log('Button pressed!');
        const request = new XMLHttpRequest();

        request.onload = () => {

          let responseObject = null;

          try {
            responseObject = JSON.parse(request.responseText);
          } catch (e) {
            console.error('JSON chyba!');
          }

          if(responseObject) {
            handleResponse(responseObject);
          }

        };

        const requestData = `username=${form.username.value}&password=${form.password.value}`;

        console.log(requestData);

        request.open('post', 'login.php');
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.send(requestData);

      });

      function handleResponse(responseObject) {

        if(responseObject.ok) {
          window.location.href = "main.html";
        } else {
          console.log(responseObject.ok);
          while(form.messages.firstChild) {
            form.messages.removeChild(form.messages.firstChild);
          }

          responseObject.messages.forEach((message) => {
            const li = document.createElement('li');
            li.textContent = message;
            form.messages.appendChild(li);
          });

          document.getElementById('error').style.display = "block";

        }

      }



  </script>
</html>
