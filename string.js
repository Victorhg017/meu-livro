
// Variáveis corretas, com os IDs que você usou no HTML
const toggleBtn = document.getElementById('toggle-livro');       // botão que abre/fecha o submenu
const submenu = document.getElementById('submenu-livro');        // o submenu que desliza
const closeBtn = document.getElementById('closeSubmenuBtn');      // botão fechar dentro do submenu
const overlay = document.getElementById('overlay');               // overlay para fechar clicando fora

function openMenu() {
  submenu.classList.add('open');
  overlay.classList.add('active');
  submenu.setAttribute('aria-hidden', 'false');
  toggleBtn.setAttribute('aria-expanded', 'true');
  const firstLink = submenu.querySelector('a');
  if (firstLink) firstLink.focus();
}

function closeMenu() {
  submenu.classList.remove('open');
  overlay.classList.remove('active');
  submenu.setAttribute('aria-hidden', 'true');
  toggleBtn.setAttribute('aria-expanded', 'false');
  toggleBtn.focus();
}

toggleBtn.addEventListener('click', e => {
  e.preventDefault();
  if (submenu.classList.contains('open')) {
    closeMenu();
  } else {
    openMenu();
  }
});

closeBtn.addEventListener('click', closeMenu);
overlay.addEventListener('click', closeMenu);

document.addEventListener('keydown', e => {
  if (e.key === 'Escape' && submenu.classList.contains('open')) {
    closeMenu();
  }
});
