(function () {
    const revealElements = document.querySelectorAll('.reveal');
    if (revealElements.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        revealElements.forEach((el) => observer.observe(el));
    }

    const lightbox = document.getElementById('galleryLightbox');
    if (!lightbox) return;

    const items = Array.from(document.querySelectorAll('.gallery-item'));
    const img = document.getElementById('galleryLightboxImg');
    const title = document.getElementById('galleryLightboxTitle');
    const category = document.getElementById('galleryLightboxCategory');
    const counter = document.getElementById('galleryLightboxCounter');
    const closeBtn = lightbox.querySelector('.gallery-lightbox-close');
    const prevBtn = lightbox.querySelector('.gallery-lightbox-prev');
    const nextBtn = lightbox.querySelector('.gallery-lightbox-next');
    const zoomBtn = lightbox.querySelector('.gallery-lightbox-zoom');
    const filters = document.querySelectorAll('.gallery-filter');

    let currentIndex = 0;
    let visibleItems = items;

    const openLightbox = (index) => {
        currentIndex = index;
        renderSlide();
        lightbox.classList.add('is-open');
        document.body.classList.add('lightbox-open');
    };

    const closeLightbox = () => {
        lightbox.classList.remove('is-open');
        document.body.classList.remove('lightbox-open');
        img.classList.remove('is-zoomed');
    };

    const renderSlide = () => {
        const item = visibleItems[currentIndex];
        if (!item) return;

        img.src = item.dataset.full;
        img.alt = item.dataset.title || '';
        title.textContent = item.dataset.title || '';
        category.textContent = item.dataset.category || '';
        counter.textContent = `${currentIndex + 1} / ${visibleItems.length}`;
        img.classList.remove('is-zoomed');
    };

    const showPrev = () => {
        currentIndex = (currentIndex - 1 + visibleItems.length) % visibleItems.length;
        renderSlide();
    };

    const showNext = () => {
        currentIndex = (currentIndex + 1) % visibleItems.length;
        renderSlide();
    };

    const toggleZoom = () => {
        img.classList.toggle('is-zoomed');
    };

    items.forEach((item) => {
        item.addEventListener('click', () => {
            if (!item.dataset.full) return;

            visibleItems = Array.from(document.querySelectorAll('.gallery-item:not([hidden])'))
                .filter((el) => el.dataset.full);
            const visibleIndex = visibleItems.indexOf(item);
            openLightbox(visibleIndex >= 0 ? visibleIndex : 0);
        });
    });

    filters.forEach((filter) => {
        filter.addEventListener('click', () => {
            const value = filter.dataset.filter;
            filters.forEach((btn) => btn.classList.toggle('active', btn === filter));

            items.forEach((item) => {
                const match = value === 'all' || item.dataset.category === value;
                item.hidden = !match;
            });
        });
    });

    closeBtn.addEventListener('click', closeLightbox);
    prevBtn.addEventListener('click', showPrev);
    nextBtn.addEventListener('click', showNext);
    zoomBtn.addEventListener('click', toggleZoom);
    img.addEventListener('dblclick', toggleZoom);

    lightbox.addEventListener('click', (event) => {
        if (event.target === lightbox) closeLightbox();
    });

    document.addEventListener('keydown', (event) => {
        if (!lightbox.classList.contains('is-open')) return;

        if (event.key === 'Escape') closeLightbox();
        if (event.key === 'ArrowLeft') showPrev();
        if (event.key === 'ArrowRight') showNext();
    });
})();
