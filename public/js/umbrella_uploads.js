function docNameToElId(name) {
    return name.replace(/\s+/g, '_');
}

function getUploadContext() {
    const projectPage = document.getElementById('projectUploadPage');
    const isProject = Boolean(projectPage);

    return {
        id: document.getElementById(isProject ? 'projectId' : 'umbrellaId'),
        parameter: isProject ? 'project_id' : 'umbrella_id',
        type: isProject ? 'PID' : 'UPID',
        directory: isProject ? '/uploads/project' : '/uploads/umbrella'
    };
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
function applyUploadToRow(targetId, documentName, originalName) {
    const elId = docNameToElId(documentName);

    const nameCell = document.getElementById(elId);
    if (nameCell) nameCell.textContent = originalName;

    const viewCell = document.getElementById('view_' + elId);
    if (viewCell) {
        const context = getUploadContext();
        viewCell.innerHTML = `<a href="view_files.php?${context.parameter}=${encodeURIComponent(targetId)}&document_name=${encodeURIComponent(documentName)}" target="_blank" rel="noopener"
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
    const context = getUploadContext();
    const targetId = context.id ? context.id.value : '';
    resetTable();
    if (!targetId) {
        return;
    }
    try {
        const res = await fetch(`get_uploads.php?${context.parameter}=${encodeURIComponent(targetId)}&type=${encodeURIComponent(context.type)}`);
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
                applyUploadToRow(targetId, documentName, row.original_name);
            }
        });
    } catch (err) {
        console.error('Error loading uploaded files:', err);
        Swal.fire({
            title: 'Could Not Load Files',
            text: `Unable to load uploaded files for this ${context.type === 'PID' ? 'Project' : 'Umbrella'} ID.`,
            icon: 'error'
        });
    }
}

// Called when a user selects a file from an <input type="file">.
async function handleUpload(inputEl) {
    const context = getUploadContext();
    const targetId = context.id ? context.id.value : '';

    if (!targetId) {
        alert(`Please select a ${context.type === 'PID' ? 'Project' : 'Umbrella'} ID before uploading.`);
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
    formData.append(context.parameter, targetId);
    formData.append('upload_type', context.type);
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

        applyUploadToRow(targetId, documentName, data.original_name);
    } catch (err) {
        console.error('Upload error:', err);
        alert('Upload failed. Please try again.');
        if (nameCell) nameCell.textContent = originalText;
    } finally {
        inputEl.value = ''; // allow re-selecting the same file later
    }
}
