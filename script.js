// app.js - basic helpers
document.addEventListener('DOMContentLoaded', () => {
  // Smooth scroll for start button
  const startBtn = document.querySelector('.start-test-btn');
  if(startBtn){
    startBtn.addEventListener('click', e => {
      e.preventDefault();
      window.location = 'questionnaire.php';
    });
  }
});
