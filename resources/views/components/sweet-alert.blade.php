<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (!window.Swal) {
            console.error('SweetAlert2 is not loaded.');
            return;
        }

        const brandAlert = {
            customClass: {
                popup: 'brand-alert-popup',
                title: 'brand-alert-title',
                htmlContainer: 'brand-alert-html',
                confirmButton: 'brand-alert-confirm',
                cancelButton: 'brand-alert-cancel',
            },
            buttonsStyling: false,
            showConfirmButton: true,
            confirmButtonText: 'Continue',
            confirmButtonColor: '#1d4ed8',
            background: '#ffffff',
            color: '#111827',
        };

        @if (session('action_completed'))
            window.Swal.fire({
                ...brandAlert,
                iconHtml: '<span style="color: #16A34A; font-size: 42px; font-weight: bold;">✓</span>',
                title: @js(session('action_completed')),
                text: @js(session('action_completed')),
                iconColor: '#16A34A',
                showConfirmButton: true,
                confirmButtonText: 'OK',
                            }).then(function () {
                @if (session('success'))
                    window.Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: @js(session('success')),
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 6000,
                        timerProgressBar: true,
                        background: '#22C55E',
                        color: '#FFFFFF',
                        iconColor: '#FFFFFF',
                        customClass: {
                            popup: 'brand-success-popup',
                        },
                    });
                @endif
            });
        @elseif (session('success'))
            window.Swal.fire({
                icon: 'success',
                title: 'Success',
                text: @js(session('success')),
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 6000,
                timerProgressBar: true,
                background: '#22C55E',
                color: '#FFFFFF',
                iconColor: '#FFFFFF',
                customClass: {
                    popup: 'brand-success-popup',
                },
            });
        @endif

        @if (session('error'))
            window.Swal.fire({
                ...brandAlert,
                icon: 'error',
                title: 'Something went wrong',
                text: @js(session('error')),
                confirmButtonText: 'Understood',
            });
        @endif

        @if ($errors->any())
            window.Swal.fire({
                ...brandAlert,
                icon: 'warning',
                title: 'Please check your input',
                html: @js(implode('<br>', $errors->all())),
                confirmButtonText: 'Review',
                iconColor: '#1d4ed8',
            });
        @endif
    });
</script>