import Swal from 'sweetalert2'

window.addEventListener('alert', event => {
    Swal.fire({
        title: event.detail.message ?? '',
        icon: event.detail.type ?? null,
        ...event.detail.options
    })
});

window.addEventListener('confirming', confirming => {
    window.addEventListener(confirming.detail, event => {
        Swal.fire({
            confirmButtonText: event.detail.options.confirmButtonText ?? 'Yes',
            ...event.detail.options
        }).then((result) => {
            if (result.isConfirmed) { Livewire.emit(event.detail.onConfirmed,event.detail.options["inputAttributes"]); }
            else { const cancelCallback = event.detail.onCancelled; if (!cancelCallback) { return; } Livewire.emit(cancelCallback) }
        })
    });
});

// const Toast = Swal.mixin({
//     toast: true,
//     position: 'top',
//     showConfirmButton: false,
//     showCloseButton: true,
//     timer: 5000,
//     timerProgressBar:true,
//     didOpen: (toast) => {
//         toast.addEventListener('mouseenter', Swal.stopTimer)
//         toast.addEventListener('mouseleave', Swal.resumeTimer)
//     }
// });
