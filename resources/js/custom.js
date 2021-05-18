if ('serviceWorker' in navigator) {
    window.addEventListener('load', function () {
        navigator.serviceWorker.register('/service-worker.js');
    });
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.select2').select2({
    width: '100%',
    placeholder: 'چی داری تو خونه؟',
    maximumSelectionLength: 3,
    language: "fa"
});
