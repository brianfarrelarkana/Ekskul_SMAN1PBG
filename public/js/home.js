const mobileMenu = document.getElementById('mobile-menu');
const mainNav = document.getElementById('main-nav');

mobileMenu.addEventListener('click', () => {
  mainNav.classList.toggle('active');
});

document.querySelectorAll('header nav a').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    document.querySelectorAll('header nav a').forEach(link => link.classList.remove('active'));
    this.classList.add('active');

    if (this.getAttribute('href').startsWith('#')) {
      e.preventDefault();
      const targetId = this.getAttribute('href');
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        if (mainNav.classList.contains('active')) {
          mainNav.classList.remove('active');
        }
        window.scrollTo({
          top: targetElement.offsetTop - 70,
          behavior: 'smooth'
        });
      }
    }
  });
});

window.addEventListener('scroll', () => {
  let current = '';
  const sections = document.querySelectorAll('section');
  const headerHeight = document.querySelector('header').offsetHeight;

  sections.forEach(section => {
    const sectionTop = section.offsetTop - headerHeight - 5;
    if (pageYOffset >= sectionTop) {
      current = section.getAttribute('id');
    }
  });

  if (!current && sections.length > 0 && pageYOffset < sections[0].offsetTop - headerHeight - 5) {
    current = sections[0].getAttribute('id');
  }


  document.querySelectorAll('header nav a').forEach(link => {
    link.classList.remove('active');
    if (link.getAttribute('href').substring(1) === current) {
      link.classList.add('active');
    }
  });
});