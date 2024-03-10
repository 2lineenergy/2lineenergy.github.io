const scrollButton = document.getElementById('scrollButton');
const content = document.querySelector('.content');

scrollButton.addEventListener('click', () => {
  content.scrollIntoView({ behavior: 'smooth' });
});
