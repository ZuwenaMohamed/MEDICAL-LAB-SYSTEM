import Alpine from 'alpinejs';
import './bootstrap';
import Swal from 'sweetalert2';

window.Alpine = Alpine;
window.Swal = Swal;

Alpine.start();

window.confirmDelete = function (
    form,
    message = 'Are you sure you want to delete this record?'
) {
    Swal.fire({
        icon: 'warning',
        title: 'Are you sure you want to delete?',
        text: message,
        customClass: {
            popup: 'brand-alert-popup',
            title: 'brand-alert-title',
            confirmButton: 'brand-alert-delete',
            cancelButton: 'brand-alert-cancel',
        },
        buttonsStyling: false,
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
        focusCancel: true,
        background: '#ffffff',
        color: '#111827',
        iconColor: '#dc2626',
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
};

window.confirmDeactivate = function (event, form) {
    event.preventDefault();

    Swal.fire({
        title: 'Deactivate User?',
        text: 'This user will no longer be able to access the system.',
        icon: 'warning',
        iconColor: '#d97706',
        showCancelButton: true,
        confirmButtonText: 'Yes, Deactivate',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
        focusCancel: true,
        background: '#ffffff',
        color: '#111827',
        customClass: {
            popup: 'brand-alert-popup',
            title: 'brand-alert-title',
            htmlContainer: 'brand-alert-html',
            confirmButton: 'brand-alert-delete',
            cancelButton: 'brand-alert-cancel',
        },
        buttonsStyling: false,
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });

    return false;
};

window.confirmActivate = function (event, form) {
    event.preventDefault();

    Swal.fire({
        title: 'Activate User?',
        text: 'This user will regain access to the system.',
        icon: 'question',
        iconColor: '#16a34a',
        showCancelButton: true,
        confirmButtonText: 'Yes, Activate',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
        focusCancel: true,
        background: '#ffffff',
        color: '#111827',
        customClass: {
            popup: 'brand-alert-popup',
            title: 'brand-alert-title',
            htmlContainer: 'brand-alert-html',
            confirmButton: 'brand-alert-delete',
            cancelButton: 'brand-alert-cancel',
        },
        buttonsStyling: false,
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });

    return false;
};

window.showSuccessAlert = function (message) {
    Swal.fire({
        toast: false,
        position: 'center',
        icon: 'success',
        title: 'Success',
        text: message,
        iconColor: '#16a34a',
        confirmButtonText: 'OK',
        timer: 4000,
        timerProgressBar: true,
        background: '#ffffff',
        color: '#111827',
        customClass: {
            popup: 'brand-alert-popup',
            title: 'brand-alert-title',
            htmlContainer: 'brand-alert-html',
            confirmButton: 'brand-alert-cancel',
        },
        buttonsStyling: false,
    });
};