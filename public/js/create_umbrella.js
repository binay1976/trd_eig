document.getElementById('umbrellaForm').addEventListener('submit', async function (event) {
    event.preventDefault();

    const form = this;
    const button = document.getElementById('umbrellaSubmitBtn');
    button.disabled = true;
    button.textContent = 'Saving...';

    try {
        const response = await fetch('create_umbrella.php', {
            method: 'POST',
            body: new FormData(form),
            headers: { 'Accept': 'application/json' }
        });
        const responseText = await response.text();
        let data;

        try {
            data = JSON.parse(responseText);
        } catch (parseError) {
            throw new Error(response.ok ? 'The server returned an invalid response.' : `Server error (${response.status}).`);
        }

        if (!response.ok || !data.success) {
            throw new Error(data.message || `Server error (${response.status}).`);
        }

        await Swal.fire({
            title: 'Project Created!',
            html: `${data.message}<br><strong>${data.umbrella_id}</strong>`,
            icon: 'success',
            confirmButtonText: 'OK',
            background: 'rgba(10, 10, 10, 0.92)',
            color: '#ffffff'
        });
        form.reset();
    } catch (error) {
        Swal.fire({
            title: 'Save Failed',
            text: error.message || 'Could not save the project. Please try again.',
            icon: 'error',
            confirmButtonText: 'Try Again',
            background: 'rgba(10, 10, 10, 0.92)',
            color: '#ffffff'
        });
    } finally {
        button.disabled = false;
        button.textContent = 'Create Umbrella Project';
    }
});