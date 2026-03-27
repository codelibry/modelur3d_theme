document.querySelectorAll('.tabs__btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const tab = btn.dataset.tab;

        document.querySelectorAll('.tabs__btn').forEach(b => b.classList.remove('is-active'));
        document.querySelectorAll('.product-tab__panel').forEach(p => p.classList.remove('is-active'));

        btn.classList.add('is-active');
        document.querySelector(`.product-tab__panel[data-panel="${tab}"]`).classList.add('is-active');
    });
});