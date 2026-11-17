const openBtn = document.getElementById('openBtn');
const closeBtn = document.getElementById('closeBtn');
const modalOverlay = document.getElementById('modalOverlay');

openBtn.addEventListener('click', () => {
  modalOverlay.classList.add('ativo');
});

closeBtn.addEventListener('click', () => {
  modalOverlay.classList.remove('ativo');
});

modalOverlay.addEventListener('click', (event) => {
  if (event.target === modalOverlay) {
    modalOverlay.classList.remove('ativo');
  }
});
