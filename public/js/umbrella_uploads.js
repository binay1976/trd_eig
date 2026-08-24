// umbrella_uploads.js

// Convert "Project Approval" -> "Project_Approval" to match DOM element ids
// generated in umbrella_uploads.php.
function docNameToElId(name) {
    return name.replace(/\s+/g, '_');
}

// Reset every row in the table to its default "Not Uploaded" state.
function resetTable() {
    document.querySelectorAll('#uploadTableBody input[type="file"]').forEach((input) => {
        const elId = docNameToElId(input.dataset.document);

        const nameCell = document.getElementById(elId);
        if (nameCell) nameCell.textContent = 'Not Uploaded';

        const viewCell = document.getElementById('view_' + elId);
        if (viewCell) viewCell.innerHTML = '<span class="text-gray-400">Not Available</span>';
    });
}

// Fill in a single row with an uploaded file's info + a working view link.
function applyUploadToRow(umbrellaId, documentName, originalName) {
    const elId = docNameToElId(documentName);

    const nameCell = document.getElementById(elId);
    if (nameCell) nameCell.textContent = originalName;

    const viewCell = document.getElementById('view_' + elId);
    if (viewCell) {
        viewCell.innerHTML = `<a href="view_files.php?umbrella_id=${encodeURIComponent(umbrellaId)}&document_name=${encodeURIComponent(documentName)}" target="_blank" rel="noopener"
            class="text-blue-600 hover:underline font-medium">View</a>`;
    }
}

// Look up the document display name for a given document_id (slug) by
// checking the data-doc-id attribute on the upload inputs.
function documentNameFromId(documentId) {
    const input = document.querySelector(`#uploadTableBody input[data-doc-id="${documentId}"]`);
    return input ? input.dataset.document : null;
}

// Called on page load and whenever the Umbrella ID dropdown changes.
async function loadUploadedFiles() {
    const umbrellaId = document.getElementById('umbrellaId').value;

    resetTable();

    if (!umbrellaId) {
        return;
    }

    try {
        const res = await fetch(`get_uploads.php?umbrella_id=${encodeURIComponent(umbrellaId)}`);
        const data = await res.json();

        if (!data.success) {
            Swal.fire({
                title: 'Could Not Load Files',
                text: data.message || 'Unable to load uploaded files.',
                icon: 'error'
            });
            return;
        }

        data.uploads.forEach((row) => {
            const documentName = documentNameFromId(row.document_id);
            if (documentName) {
                applyUploadToRow(umbrellaId, documentName, row.original_name);
            }
        });
    } catch (err) {
        console.error('Error loading uploaded files:', err);
        Swal.fire({
            title: 'Could Not Load Files',
            text: 'Unable to load uploaded files for this Umbrella ID.',
            icon: 'error'
        });
    }
}

// Called when a user selects a file from an <input type="file">.
async function handleUpload(inputEl) {
    const umbrellaId = document.getElementById('umbrellaId').value;

    if (!umbrellaId) {
        alert('Please select an Umbrella ID before uploading.');
        inputEl.value = '';
        return;
    }

    const file = inputEl.files[0];
    if (!file) return;

    const documentName = inputEl.dataset.document;
    const documentId = inputEl.dataset.docId;
    const elId = docNameToElId(documentName);

    const nameCell = document.getElementById(elId);
    const originalText = nameCell ? nameCell.textContent : '';
    if (nameCell) nameCell.textContent = 'Uploading...';

    const formData = new FormData();
    formData.append('umbrella_id', umbrellaId);
    formData.append('document_id', documentId);
    formData.append('document_name', documentName);
    formData.append('file', file);

    try {
        const res = await fetch('upload_handler.php', {
            method: 'POST',
            body: formData,
        });
        const data = await res.json();

        if (!data.success) {
            alert('Upload failed: ' + (data.message || 'Unknown error'));
            if (nameCell) nameCell.textContent = originalText;
            return;
        }

        applyUploadToRow(umbrellaId, documentName, data.original_name);
    } catch (err) {
        console.error('Upload error:', err);
        alert('Upload failed. Please try again.');
        if (nameCell) nameCell.textContent = originalText;
    } finally {
        inputEl.value = ''; // allow re-selecting the same file later
    }
}
