// الوضع الليلي / النهاري
const themeToggle = document.getElementById('themeToggle');
themeToggle.addEventListener('click', () => {
  document.body.classList.toggle('dark');
  themeToggle.textContent = document.body.classList.contains('dark') ? 'الوضع النهاري' : 'الوضع الليلي';
});

// عناصر الادمن
const adminBtn = document.getElementById('adminBtn');
const adminPanel = document.getElementById('adminPanel');
const loginBtn = document.getElementById('loginBtn');
const closeAdmin = document.getElementById('closeAdmin');
const loginMsg = document.getElementById('loginMsg');

const addGamePanel = document.getElementById('addGamePanel');
const addGameBtn = document.getElementById('addGameBtn');
const closeAddGame = document.getElementById('closeAddGame');

let isAdmin = false;

adminBtn.addEventListener('click', () => {
  adminPanel.classList.remove('hidden');
});

closeAdmin.addEventListener('click', () => {
  adminPanel.classList.add('hidden');
  loginMsg.textContent = '';
});

loginBtn.addEventListener('click', () => {
  const pass = document.getElementById('adminPass').value;
  if (pass === 'aa20132013') {
    isAdmin = true;
    loginMsg.textContent = 'تم تسجيل الدخول كإدمن';
    adminPanel.classList.add('hidden');
    addGamePanel.classList.remove('hidden');
  } else {
    loginMsg.textContent = 'كلمة المرور غير صحيحة';
  }
});

closeAddGame.addEventListener('click', () => {
  addGamePanel.classList.add('hidden');
});

addGameBtn.addEventListener('click', () => {
  if (!isAdmin) {
    alert('يرجى تسجيل الدخول كإدمن أولاً');
    return;
  }

  const title = document.getElementById('gameTitle').value.trim();
  const img = document.getElementById('gameImg').value.trim();
  const link = document.getElementById('gameLink').value.trim();

  if (!title || !img || !link) {
    alert('يرجى ملء جميع الحقول');
    return;
  }

  addGameCard(title, img, link);

  // تنظيف الحقول
  document.getElementById('gameTitle').value = '';
  document.getElementById('gameImg').value = '';
  document.getElementById('gameLink').value = '';

  addGamePanel.classList.add('hidden');
});

function addGameCard(title, img, link) {
  const container = document.getElementById('gamesContainer');
  const card = document.createElement('div');
  card.classList.add('card');

  card.innerHTML = `
    <img src="${img}" alt="${title}" />
    <div class="card-content">
      <h3>${title}</h3>
      <a href="${link}" target="_blank" rel="noopener noreferrer">اللعب الآن</a>
    </div>
  `;

  container.appendChild(card);
}