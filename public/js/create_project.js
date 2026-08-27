// Drives create_project.php's form: category-dependent field visibility
// below, then AJAX-submits to create_project.php further down this file.

// ── Dependent dropdown: Project Category → Type of Project + station/KM fields ─
(function () {
    const categorySelect = document.getElementById('project_category');
    const typeSelect     = document.getElementById('type_project');

    const fieldFromStation = document.getElementById('field_from_station');
    const fieldToStation   = document.getElementById('field_to_station');
    const fieldStation     = document.getElementById('field_station');
    const fieldRouteKm     = document.getElementById('field_route_km');
    const fieldTrackKm     = document.getElementById('field_track_km');

    function setFieldVisible(fieldDiv, visible) {
        const input = fieldDiv.querySelector('input, select');
        fieldDiv.classList.toggle('hidden', !visible);
        if (input) input.disabled = !visible;
    }

    categorySelect.addEventListener('change', function () {
        const category = this.value; // '', 'OHE', or 'PSI'

        // Filter "Type of Project" options to match the selected category
        Array.from(typeSelect.options).forEach(function (opt) {
            if (!opt.value) return; // keep the placeholder option
            opt.hidden = category !== '' && opt.dataset.group !== category;
        });

        // Reset selection if it's no longer valid for this category
        const selectedOpt = typeSelect.selectedOptions[0];
        if (!selectedOpt || selectedOpt.hidden) {
            typeSelect.value = '';
        }

        // Auto-select the only option when category is OHE
        if (category === 'OHE') {
            typeSelect.value = 'OHE';
        }

        // Toggle station fields
        setFieldVisible(fieldFromStation, category === 'OHE');
        setFieldVisible(fieldToStation,   category === 'OHE');
        setFieldVisible(fieldStation,     category === 'PSI');

        // Toggle Route KM / Track KM (OHE only)
        setFieldVisible(fieldRouteKm, category === 'OHE');
        setFieldVisible(fieldTrackKm, category === 'OHE');
    });

    // Run once on load in case of browser autofill/back-navigation
    categorySelect.dispatchEvent(new Event('change'));
})();

document.getElementById('projectForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const btn      = document.getElementById('projectSubmitBtn');
    const formData = new FormData(this);

    btn.disabled    = true;
    btn.textContent = 'Saving...';

    fetch('create_project.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .then(text => {
        let data;
        try {
            data = JSON.parse(text);
        } catch(err) {
            Swal.fire({
                title: 'Server Error',
                html: '<pre style="font-size:11px;text-align:left;overflow:auto;max-height:200px;color:#f87171">' + text + '</pre>',
                icon: 'error',
                background: 'rgba(10,10,10,0.92)',
                color: '#ffffff'
            });
            return;
        }

        if (data.success) {
            Swal.fire({
                title: 'Project Created!',
                html: `<div style="font-size:15px;margin-top:8px;">
                           ${data.message}<br>
                           <strong style="font-size:13px;color:#60a5fa;">${data.project_id}</strong>
                       </div>`,
                icon: 'success',
                confirmButtonText: 'OK',
                background: 'rgba(10,10,10,0.92)',
                color: '#ffffff',
                showClass: { popup: 'animate__animated animate__zoomIn' }
            }).then(() => {
                document.getElementById('projectForm').reset();
            });
        } else {
            Swal.fire({
                title: 'Error',
                text: data.message,
                icon: 'error',
                confirmButtonText: 'Try Again',
                background: 'rgba(10,10,10,0.92)',
                color: '#ffffff'
            });
        }
    })
    .catch(() => {
        Swal.fire({
            title: 'Connection Error',
            text: 'Could not reach the server. Please try again.',
            icon: 'error',
            background: 'rgba(10,10,10,0.92)',
            color: '#ffffff'
        });
    })
    .finally(() => {
        btn.disabled    = false;
        btn.textContent = 'Create Project';
    });
});
