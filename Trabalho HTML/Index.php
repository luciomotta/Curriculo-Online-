<?php
session_start();
require_once "db.php";

// Verificar se o usuário está autenticado
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Principal</title>
  <style>

    .container {
      display: flex;
      gap: 20px;
      max-width: 900px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ff000098; /* Cor de fundo personalizada */

    }

    .form-container {
      width: 50%;
      background-color: #d4cccc;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .resume-container {
      width: 50%;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      page-break-after: always;
      box-sizing: border-box;
      padding: 20mm; /* Margens da folha A4 em milímetros */
    }
    /* Espaçamento da folha A4 em PX */
    .resume-item {
      margin-bottom: 60px;
    }

    .resume-item label {
      font-weight: bold;
    }

    .resume-item img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
      border: 2px solid #333;
    }
          /* Tamanho da LABEL From*/

    textarea {
      width: 100%;
      height: 100px;
    }

    h3 {
      margin-top: 0;
      margin-bottom: 20px;
    }

    @media print {
      body {
        margin: 0;
        padding: 0;
      }

      .container {
        display: block;
        page-break-after: always;
        page-break-inside: avoid;
        margin: 0;
        padding: 0;
        width: 100%;
      }

      .form-container,
      .resume-container::before,
      .resume-container::after {
        display: none;
      }

      .resume-container {
        width: 210mm; /* Largura da folha A4 em milímetros */
        height: 297mm; /* Altura da folha A4 em milímetros */
        padding: 20mm; /* Margens da folha A4 em milímetros */
        border: none;
        box-shadow: none;
        page-break-after: avoid;
        page-break-inside: avoid;
        
      }

      .resume-container p {
        margin: 0;
      }
    }
  </style>
  <script>
    function loadPhoto(event) {
      const file = event.target.files[0];
      const reader = new FileReader();
      reader.onload = function() {
        const photoUrl = reader.result;
        document.getElementById('photo').src = photoUrl;
        document.getElementById('photoUrl').value = photoUrl;
      }
      reader.readAsDataURL(file);
    }

    function updateResume() {
      const photoUrl = document.getElementById('photoUrl').value;
      const name = document.getElementById('name').value;
      const education = document.getElementById('education').value;
      const objectives = document.getElementById('objectives').value;
      const experience = document.getElementById('experience').value;
      const skills = document.getElementById('skills').value;
      const projects = document.getElementById('projects').value;
      const languages = getSelectedLanguages();

      document.getElementById('photo').src = photoUrl;
      document.getElementById('namePreview').textContent = name;
      document.getElementById('educationPreview').textContent = education;
      document.getElementById('objectivesPreview').textContent = objectives;
      document.getElementById('experiencePreview').textContent = experience;
      document.getElementById('skillsPreview').textContent = skills;
      document.getElementById('projectsPreview').textContent = projects;
      document.getElementById('languagesPreview').textContent = languages;
    }

    function getSelectedLanguages() {
      const checkboxes = document.querySelectorAll('input[name=languagesCheckbox]:checked');
      const selectedLanguages = Array.from(checkboxes).map(checkbox => checkbox.value);
      return selectedLanguages.join(', ');
    }
  </script>

</head>

  <div class="container">
    <div class="form-container">
    <?php if (isset($_SESSION["username"])) : ?>
        <a href="logout.php">Sair</a>
        <h2>Bem-vindo, <?php echo $_SESSION["username"]; ?>!</h2>  
    <?php else : ?>
        <p>Você não está autenticado. Por favor, faça login <a href="login.php">aqui</a>.</p>
    <?php endif; ?>

      <form oninput="updateResume()">
        <div class="form-container">
          <label for="photoUrl">Foto do Usuário:</label>
          <input type="file" id="photoFile" accept="image/*" onchange="loadPhoto(event)" />
          <input type="text" id="photoUrl" name="photoUrl" style="display: none;" />
        </div>

        <label for="name">Nome:</label>
        <input type="text" id="name" name="name">

        <label for="education">Escolaridade:</label>
        <input type="text" id="education" name="education">

        <label for="objectives">Objetivos:</label>
        <textarea id="objectives" name="objectives"></textarea>

        <label for="experience">Experiência Profissional:</label>
        <textarea id="experience" name="experience"></textarea>

        <label for="skills">Habilidades:</label>
        <textarea id="skills" name="skills"></textarea>

        <label for="projects">Projetos Relevantes:</label>
        <textarea id="projects" name="projects"></textarea>

        <label>Idiomas:</label>
        <div>
          <input type="checkbox" id="english" name="languagesCheckbox" value="Inglês">
          <label for="english">Inglês</label>
        </div>
        <div>
          <input type="checkbox" id="spanish" name="languagesCheckbox" value="Espanhol">
          <label for="spanish">Espanhol</label>
        </div>
        <div>
          <input type="checkbox" id="french" name="languagesCheckbox" value="Francês">
          <label for="french">Francês</label>
        </div>
      </form>
    </div>

    <div class="resume-container">
      <h3>Visualização:</h3>
      <div id="resumeContainer">
        <div class="resume-item">
          <img id="photo" src="" alt="Foto do Usuário">
        </div>
        <div class="resume-item">
          <label for="namePreview">Nome:</label>
          <p id="namePreview"></p>
        </div>
        <div class="resume-item">
          <label for="educationPreview">Escolaridade:</label>
          <p id="educationPreview"></p>
        </div>
        <div class="resume-item">
          <label for="objectivesPreview">Objetivos:</label>
          <p id="objectivesPreview"></p>
        </div>
        <div class="resume-item">
          <label for="experiencePreview">Experiência Profissional:</label>
          <p id="experiencePreview"></p>
        </div>
        <div class="resume-item">
          <label for="skillsPreview">Habilidades:</label>
          <p id="skillsPreview"></p>
        </div>
        <div class="resume-item">
          <label for="projectsPreview">Projetos Relevantes:</label>
          <p id="projectsPreview"></p>
        </div>
        <div class="resume-item">
          <label for="languagesPreview">Idiomas:</label>
          <p id="languagesPreview"></p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
