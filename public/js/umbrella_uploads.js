const MAX_UPLOAD_SIZE = 10 * 1024 * 1024;
const ALLOWED_EXTENSIONS = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png'];

function loadUploadedFiles() {
    const umbrellaId = document.getElementById('umbrellaId').value;

    document.querySelectorAll('[data-document]').forEach(function (input) {
        const cellId = input.dataset.document.replaceAll(' ', '_');
        const cell = document.getElementById(cellId);
        cell.textContent = 'Not Uploaded';
        cell.className = 'px-4 py-4 text-sm text-gray-500';
    });

    if (!umbrellaId) {
        return;
    }
}

function handleUpload(input) {
    const umbrellaId = document.getElementById('umbrellaId').value;

    if (!umbrellaId) {
        input.value = '';
        Swal.fire({ title: 'Select Umbrella ID', text: 'Please select an Umbrella ID first.', icon: 'warning' });
        return;
    }

    if (!input.files.length) {
        return;
    }

    const file = input.files[0];
    const extension = file.name.split('.').pop().toLowerCase();

    if (file.size > MAX_UPLOAD_SIZE) {
        input.value = '';
        Swal.fire({ title: 'File Too Large', text: 'The maximum file size is 10 MB.', icon: 'error' });
        return;
    }

    if (!ALLOWED_EXTENSIONS.includes(extension)) {
        input.value = '';
        Swal.fire({ title: 'Invalid File Type', text: 'Allowed file types: PDF, Word, Excel, JPG and PNG.', icon: 'error' });
        return;
    }

    const documentName = input.dataset.document;
    const viewCell = document.getElementById(
        'view_' + documentName.replaceAll(' ', '_')
        );

        viewCell.innerHTML = `
            <a href="view_files.php?umbrella_id=${encodeURIComponent(umbrellaId)}&document_name=${encodeURIComponent(documentName)}"
            target="_blank"
            class="inline-block px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                View File
            </a>
        `;

    const formData = new FormData();
    formData.append('umbrella_id', umbrellaId);
    formData.append('document_name', input.dataset.document);
    formData.append('file', file);
    formData.append('upload_type', 'umbrella');
    // formData.append('upload_type', 'project');
    // formData.append('upload_type', 'equipment');
    input.disabled = true;

    fetch('upload.php', { method: 'POST', body: formData, headers: { 'Accept': 'application/json' } })
        .then(async function (response) {
            const responseText = await response.text();
            let data;
            try {
                data = JSON.parse(responseText);
            } catch (error) {
                throw new Error('The server returned an invalid upload response.');
            }
            if (!response.ok || !data.success) {
                throw new Error(data.message || 'The upload failed.');
            }
            return data;
        })
        .then(function (data) {
            const cellId = input.dataset.document.replaceAll(' ', '_');
            const cell = document.getElementById(cellId);
            cell.textContent = data.file_name;
            cell.className = 'px-4 py-4 text-sm text-green-600 font-medium';
            Swal.fire({ title: 'Upload Successful', text: data.message, icon: 'success' });
        })
        .catch(function (error) {
            input.value = '';
            Swal.fire({ title: 'Upload Failed', text: error.message, icon: 'error' });
        })
        .finally(function () {
            input.disabled = false;
        });
}