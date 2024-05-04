let avatarBtn = document.querySelector('.avatar-container button');
let avatarPanel = document.getElementById('avatar-panel');

avatarBtn.onclick = (event) => {
  event.stopPropagation();
  if (avatarPanel.style.display === 'flex') {
    avatarPanel.style.display = 'none';
  } else {
    avatarPanel.style.display = 'flex';
  }
}
document.addEventListener('click', function(event) {
  if (!avatarPanel.contains(event.target) && event.target !== avatarBtn) {
    avatarPanel.style.display = 'none';
  }
});