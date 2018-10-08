<!DOCTYPE html>
<html>
<head>
  <title>PHP User register Platform</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link type="text/css" rel="stylesheet" href="style.css">
  <link rel="stylesheet" type="text/css" href="semantic/semantic.min.css">
  <script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
  <script src="semantic/semantic.min.js"></script>
</head>
<body>
  <div class="ui vertical segments">
    <div class="ui raised padded segment user-register">
      <form class="ui form user-registration">
        <h1 class="ui dividing header"> User Registration</h1>
        <label>Nome</label>
        <div class="two fields">
          <div class="field">
            <input type="text" name="first_name" minlength="3" class="name-input" placeholder="Nome" required>
          </div>
          <div class="field">
            <input type="text" name="last_name" minlength="3" class="last_name-input" placeholder="Sobrenome" required>
          </div>
        </div>
        <label>E-Mail</label>
        <div class="field">
          <input type="email" name="email" class="email-input" placeholder="Email" required>
        </div>
        <label>Idade</label>
        <div class="field">
          <input type="number" name="age" class="age-input" placeholder="Digite a idade do usuário" required>
        </div>
        <div class="field">
          <input class="ui teal button" type="submit" tabindex="0" value="Registrar">
        </div>
      </form>
    </div>

    <!-- USERS LIST -->
    <div class="ui raised padded segment user-list">
      <div class="ui cards">
        <!-- USER CARD ARE INSERTED HERE -->
    </div>
  </div>
  <script src="page-control.js"></script>
</body>
</html>
