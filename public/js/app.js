// NeonLoot – small front-end helpers (kept simple on purpose)

// 1. Auto-hide the flash message after 3 seconds
document.addEventListener('DOMContentLoaded', function () {
    var flash = document.getElementById('flash');
    if (flash) {
        setTimeout(function () {
            flash.style.transition = 'opacity .5s';
            flash.style.opacity = '0';
            setTimeout(function () { flash.remove(); }, 500);
        }, 3000);
    }

    // 2. Simple client-side validation: highlight empty required fields
    document.querySelectorAll('form[data-validate]').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            var ok = true;
            form.querySelectorAll('[required]').forEach(function (field) {
                if (!field.value.trim()) {
                    field.classList.add('invalid');
                    ok = false;
                } else {
                    field.classList.remove('invalid');
                }
            });
            if (!ok) {
                e.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
    });
});
