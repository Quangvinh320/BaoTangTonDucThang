document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.main-nav');
  if (toggle && nav) toggle.addEventListener('click', () => {
    const open = nav.classList.toggle('open');
    toggle.setAttribute('aria-expanded', String(open));
  });

  const modal = document.getElementById('artifactModal');
  document.querySelectorAll('[data-artifact-title]').forEach(card => {
    card.addEventListener('click', () => {
      if (!modal) return;
      document.getElementById('modalTitle').textContent = card.dataset.artifactTitle || '';
      document.getElementById('modalDescription').textContent = card.dataset.artifactDesc || '';
      const img = document.getElementById('modalImage');
      img.src = card.dataset.artifactImage || '';
      img.alt = card.dataset.artifactTitle || '';
      modal.classList.add('open');
      modal.setAttribute('aria-hidden', 'false');
    });
  });
  const closeModal = () => {
    if (!modal) return;
    modal.classList.remove('open');
    modal.setAttribute('aria-hidden', 'true');
  };
  document.querySelectorAll('.modal-close').forEach(btn => btn.addEventListener('click', closeModal));
  if (modal) modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });

  const detail = document.getElementById('timelineDetail');
  document.querySelectorAll('[data-timeline-title]').forEach(item => {
    item.addEventListener('click', () => {
      if (!detail) return;
      document.getElementById('detailYear').textContent = item.dataset.timelineYear || '';
      document.getElementById('detailTitle').textContent = item.dataset.timelineTitle || '';
      document.getElementById('detailDescription').textContent = item.dataset.timelineDesc || '';
      detail.hidden = false;
      detail.scrollIntoView({behavior:'smooth', block:'center'});
    });
  });
  if (detail) {
    const close = detail.querySelector('.modal-close');
    if (close) close.addEventListener('click', () => detail.hidden = true);
  }
});
