// ===== INITIALIZE LUCIDE ICONS =====
document.addEventListener('DOMContentLoaded', () => {
  if (window.lucide) {
    lucide.createIcons();
  }

  initNavbar();
  initMobileMenu();
  initScrollAnimations();
  initPortfolioFilter();
  initCountUp();
  initContactForm();
  initBackToTop();
  initSmoothScroll();
  initChatbot();
});

// ===== NAVBAR SCROLL EFFECT =====
function initNavbar() {
  const navbar = document.getElementById('navbar');
  const navLinks = document.querySelectorAll('.nav-link:not(.cta-btn)');
  const sections = document.querySelectorAll('section[id]');

  function onScroll() {
    const scrollY = window.scrollY;

    // Add/remove scrolled class
    if (scrollY > 50) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }

    // Active nav link based on scroll position
    let current = '';
    sections.forEach(section => {
      const sectionTop = section.offsetTop - 120;
      const sectionHeight = section.offsetHeight;
      if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
        current = section.getAttribute('id');
      }
    });

    navLinks.forEach(link => {
      link.classList.remove('active');
      if (link.getAttribute('href') === `#${current}`) {
        link.classList.add('active');
      }
    });
  }

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();
}

// ===== MOBILE MENU =====
function initMobileMenu() {
  const toggle = document.getElementById('menuToggle');
  const navLinks = document.getElementById('navLinks');
  const links = navLinks.querySelectorAll('.nav-link');

  toggle.addEventListener('click', () => {
    toggle.classList.toggle('active');
    navLinks.classList.toggle('active');
    document.body.style.overflow = navLinks.classList.contains('active') ? 'hidden' : '';
  });

  links.forEach(link => {
    link.addEventListener('click', () => {
      toggle.classList.remove('active');
      navLinks.classList.remove('active');
      document.body.style.overflow = '';
    });
  });
}

// ===== SCROLL ANIMATIONS (Intersection Observer) =====
function initScrollAnimations() {
  const elements = document.querySelectorAll('[data-animate]');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const delay = parseInt(entry.target.dataset.delay) || 0;
        setTimeout(() => {
          entry.target.classList.add('visible');
        }, delay);
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.1,
    rootMargin: '0px 0px -40px 0px'
  });

  elements.forEach(el => observer.observe(el));
}

// ===== PORTFOLIO FILTER =====
function initPortfolioFilter() {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const cards = document.querySelectorAll('.portfolio-card');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      // Update active button
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const filter = btn.dataset.filter;

      cards.forEach(card => {
        const category = card.dataset.category;
        if (filter === 'all' || category === filter) {
          card.classList.remove('hidden');
          card.style.animation = 'fadeInCard 0.5s var(--ease-out) forwards';
        } else {
          card.classList.add('hidden');
        }
      });
    });
  });
}

// ===== COUNT UP ANIMATION =====
function initCountUp() {
  const statNumbers = document.querySelectorAll('.stat-number[data-count]');
  let animated = false;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && !animated) {
        animated = true;
        statNumbers.forEach(stat => {
          const target = parseInt(stat.dataset.count);
          animateCount(stat, 0, target, 2000);
        });
        observer.disconnect();
      }
    });
  }, { threshold: 0.5 });

  const statsSection = document.querySelector('.hero-stats');
  if (statsSection) {
    observer.observe(statsSection);
  }
}

function animateCount(element, start, end, duration) {
  const range = end - start;
  const startTime = performance.now();

  function update(currentTime) {
    const elapsed = currentTime - startTime;
    const progress = Math.min(elapsed / duration, 1);

    // EaseOutQuart
    const eased = 1 - Math.pow(1 - progress, 4);
    const current = Math.round(start + range * eased);

    element.textContent = current;

    if (progress < 1) {
      requestAnimationFrame(update);
    }
  }

  requestAnimationFrame(update);
}

// ===== CONTACT FORM =====
function initContactForm() {
  const form = document.getElementById('contactForm');
  const submitBtn = document.getElementById('submitBtn');

  if (!form) return;

  form.addEventListener('submit', (e) => {
    e.preventDefault();

    // Get form data
    const formData = new FormData(form);
    const name = formData.get('name');
    const email = formData.get('email');
    const subject = formData.get('subject');
    const message = formData.get('message');

    // Animate button
    const originalHTML = submitBtn.innerHTML;
    submitBtn.innerHTML = '<span>Mengirim...</span>';
    submitBtn.disabled = true;
    submitBtn.style.opacity = '0.7';

    // Simulate sending (replace with actual API call)
    setTimeout(() => {
      // Create WhatsApp message as fallback
      const waMessage = `Halo SantriGresik.id!%0A%0ANama: ${encodeURIComponent(name)}%0AEmail: ${encodeURIComponent(email)}%0ALayanan: ${encodeURIComponent(subject)}%0APesan: ${encodeURIComponent(message)}`;
      
      submitBtn.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
        <span>Pesan Terkirim!</span>
      `;
      submitBtn.style.opacity = '1';

      // Open WhatsApp after short delay
      setTimeout(() => {
        window.open(`https://wa.me/6281234567890?text=${waMessage}`, '_blank');
        
        // Reset form
        form.reset();
        submitBtn.innerHTML = originalHTML;
        submitBtn.disabled = false;
        
        // Re-initialize Lucide icons for the button
        if (window.lucide) {
          lucide.createIcons();
        }
      }, 1500);
    }, 1000);
  });
}

// ===== BACK TO TOP =====
function initBackToTop() {
  const btn = document.getElementById('backToTop');

  window.addEventListener('scroll', () => {
    if (window.scrollY > 500) {
      btn.classList.add('visible');
    } else {
      btn.classList.remove('visible');
    }
  }, { passive: true });

  btn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

// ===== SMOOTH SCROLL =====
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', (e) => {
      const target = document.querySelector(anchor.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });
}

// ===== DYNAMIC CSS ANIMATION =====
const style = document.createElement('style');
style.textContent = `
  @keyframes fadeInCard {
    from {
      opacity: 0;
      transform: translateY(20px) scale(0.95);
    }
    to {
      opacity: 1;
      transform: translateY(0) scale(1);
    }
  }
`;
document.head.appendChild(style);

// ===== AI CHATBOT =====
function initChatbot() {
  const widget = document.getElementById('chatbot-widget');
  if (!widget) return;

  const toggle = document.getElementById('chatbotToggle');
  const window_ = document.getElementById('chatbotWindow');
  const closeBtn = document.getElementById('chatbotClose');
  const messagesEl = document.getElementById('chatbotMessages');
  const input = document.getElementById('chatbotInput');
  const sendBtn = document.getElementById('chatbotSendBtn');
  const badge = document.getElementById('chatbotBadge');
  const quickRepliesEl = document.getElementById('chatbotQuickReplies');
  const toggleOpen = toggle.querySelector('.chatbot-toggle-open');
  const toggleClose = toggle.querySelector('.chatbot-toggle-close');

  let isOpen = false;

  function openChat() {
    isOpen = true;
    window_.classList.add('open');
    window_.setAttribute('aria-hidden', 'false');
    toggleOpen.style.display = 'none';
    toggleClose.style.display = 'flex';
    badge.style.display = 'none';
    input.focus();
    scrollToBottom();
  }

  function closeChat() {
    isOpen = false;
    window_.classList.remove('open');
    window_.setAttribute('aria-hidden', 'true');
    toggleOpen.style.display = 'flex';
    toggleClose.style.display = 'none';
  }

  toggle.addEventListener('click', () => {
    if (isOpen) { closeChat(); } else { openChat(); }
  });

  closeBtn.addEventListener('click', closeChat);

  // Quick reply buttons
  if (quickRepliesEl) {
    quickRepliesEl.querySelectorAll('.chatbot-quick-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const msg = btn.dataset.msg;
        if (msg) {
          quickRepliesEl.remove();
          sendMessage(msg);
        }
      });
    });
  }

  // Send on button click or Enter key
  sendBtn.addEventListener('click', () => {
    const msg = input.value.trim();
    if (msg) {
      sendMessage(msg);
      input.value = '';
    }
  });

  input.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault();
      const msg = input.value.trim();
      if (msg) {
        sendMessage(msg);
        input.value = '';
      }
    }
  });

  function sendMessage(text) {
    appendMessage(text, 'user');
    showTyping();

    fetch('/api/v1/chatbot', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]') ?.getAttribute('content') ?? '',
        'Accept': 'application/json',
      },
      body: JSON.stringify({ message: text }),
    })
      .then(res => res.json())
      .then(data => {
        removeTyping();
        let replyHtml = escapeHtml(data.reply);
        if (data.show_whatsapp && data.whatsapp_url) {
          replyHtml += `<br><a href="${data.whatsapp_url}" target="_blank" rel="noopener" class="chatbot-wa-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Chat WhatsApp Sekarang
          </a>`;
        }
        appendMessage(replyHtml, 'bot', true);
      })
      .catch(() => {
        removeTyping();
        appendMessage('Maaf, terjadi kesalahan. Silakan coba lagi atau hubungi kami via WhatsApp.', 'bot');
      });
  }

  function appendMessage(text, sender, isHtml = false) {
    const msgEl = document.createElement('div');
    msgEl.classList.add('chatbot-msg', sender === 'bot' ? 'chatbot-msg-bot' : 'chatbot-msg-user');

    const bubble = document.createElement('div');
    bubble.classList.add('chatbot-msg-bubble');
    if (isHtml) {
      bubble.innerHTML = text;
    } else {
      bubble.textContent = text;
    }

    const time = document.createElement('div');
    time.classList.add('chatbot-msg-time');
    time.textContent = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

    msgEl.appendChild(bubble);
    msgEl.appendChild(time);
    messagesEl.appendChild(msgEl);
    scrollToBottom();

    // Re-init Lucide icons if any were added
    if (window.lucide) lucide.createIcons();
  }

  function showTyping() {
    const typing = document.createElement('div');
    typing.id = 'chatbotTyping';
    typing.classList.add('chatbot-msg', 'chatbot-msg-bot', 'chatbot-typing');
    typing.innerHTML = `<div class="chatbot-msg-bubble">
      <span class="chatbot-typing-dot"></span>
      <span class="chatbot-typing-dot"></span>
      <span class="chatbot-typing-dot"></span>
    </div>`;
    messagesEl.appendChild(typing);
    scrollToBottom();
  }

  function removeTyping() {
    const typing = document.getElementById('chatbotTyping');
    if (typing) typing.remove();
  }

  function scrollToBottom() {
    messagesEl.scrollTop = messagesEl.scrollHeight;
  }

  function escapeHtml(str) {
    const div = document.createElement('div');
    div.appendChild(document.createTextNode(str));
    return div.innerHTML;
  }
}
