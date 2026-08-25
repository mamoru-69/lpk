(() => {
    if (typeof Swal === 'undefined') return;

    const swalDefaults = {
        confirmButtonColor: '#c8202f',
        cancelButtonColor: '#64748b',
    };

    const showFlash = () => {
        const data = window.__flashMessages;
        if (!data) return;

        if (data.success) {
            Swal.fire({
                ...swalDefaults,
                icon: 'success',
                title: 'Berhasil',
                text: data.success,
                confirmButtonText: 'OK',
            });
            return;
        }

        if (data.error) {
            Swal.fire({
                ...swalDefaults,
                icon: 'error',
                title: 'Gagal',
                text: data.error,
                confirmButtonText: 'OK',
            });
            return;
        }

        if (data.warning) {
            Swal.fire({
                ...swalDefaults,
                icon: 'warning',
                title: 'Perhatian',
                text: data.warning,
                confirmButtonText: 'Mengerti',
            });
            return;
        }

        if (data.info) {
            Swal.fire({
                ...swalDefaults,
                icon: 'info',
                title: 'Informasi',
                text: data.info,
                confirmButtonText: 'OK',
            });
            return;
        }

        if (Array.isArray(data.errors) && data.errors.length) {
            Swal.fire({
                ...swalDefaults,
                icon: 'error',
                title: 'Validasi Gagal',
                html: `<ul style="text-align:left;margin:0;padding-left:1.2rem;">${data.errors.map((e) => `<li>${e}</li>`).join('')}</ul>`,
                confirmButtonText: 'Perbaiki',
            });
        }
    };

    const bindConfirmForms = () => {
        document.querySelectorAll('form[data-confirm]').forEach((form) => {
            form.addEventListener('submit', (event) => {
                if (form.dataset.confirmed === '1') {
                    form.dataset.confirmed = '0';
                    return;
                }

                event.preventDefault();

                Swal.fire({
                    ...swalDefaults,
                    icon: 'warning',
                    title: form.dataset.confirmTitle || 'Konfirmasi',
                    text: form.dataset.confirm,
                    showCancelButton: true,
                    confirmButtonText: form.dataset.confirmYes || 'Ya, lanjutkan',
                    cancelButtonText: form.dataset.confirmNo || 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.dataset.confirmed = '1';
                        form.submit();
                    }
                });
            });
        });
    };

    document.addEventListener('DOMContentLoaded', () => {
        showFlash();
        bindConfirmForms();
    });
})();
