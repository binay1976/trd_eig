function docNameToElId(name) {
    return name.replace(/\s+/g, '_');
}

function getUploadContext() {
    return {
        parameter: window.EIG_UPLOAD_PARAM,
        targetId: window.EIG_SCOPED_VALUE || '',
        type: window.EIG_UPLOAD_SCOPE === 'form' ? 'ULEID' : ''
    };
}

function resetTable() {
    document.querySelectorAll('#uploadTableBody input[type="file"]').forEach((input) => {
        const elId = docNameToElId(input.dataset.document);
        const nameCell = document.getElementById(elId);
        const viewCell = document.getElementById('view_' + elId);
        if (nameCell) nameCell.textContent = 'Not Uploaded';
        if (viewCell) viewCell.innerHTML = '<span class="text-gray-400">Not Available</span>';
    });
}

function documentNameFromId(documentId) {
    const input = document.querySelector(`#uploadTableBody input[data-doc-id="${documentId}"]`);
    return input ? input.dataset.document : null;
}

function applyUploadToRow(targetId, documentId, documentName, originalName) {
    const elId = docNameToElId(documentName);
    const nameCell = document.getElementById(elId);
    const viewCell = document.getElementById('view_' + elId);
    if (nameCell) nameCell.textContent = originalName;
    if (viewCell) {
        viewCell.innerHTML = `<a href="view_file.php?scope=form&unique_form_id=${encodeURIComponent(targetId)}&document_id=${encodeURIComponent(documentId)}" target="_blank" rel="noopener" class="text-blue-600 hover:underline font-medium">View</a>`;
    }
}

async function loadUploadedFiles() {
    const context = getUploadContext();
    resetTable();
    if (!context.targetId) return;

    try {
        const response = await fetch(`get_uploads.php?${context.parameter}=${encodeURIComponent(context.targetId)}&type=${context.type}`);
        const data = await response.json();
        if (!data.success) throw new Error(data.message || 'Unable to load uploaded files.');
        data.uploads.forEach((row) => {
            const documentName = documentNameFromId(row.document_id);
            if (documentName) applyUploadToRow(context.targetId, row.document_id, documentName, row.original_name);
        });
    } catch (error) {
        console.error('Error loading form uploads:', error);
        Swal.fire({ title: 'Could Not Load Files', text: error.message, icon: 'error' });
    }
}

async function handleUpload(inputEl) {
    const context = getUploadContext();
    const file = inputEl.files[0];
    if (!context.targetId || !file) return;

    const documentName = inputEl.dataset.document;
    const documentId = inputEl.dataset.docId;
    const nameCell = document.getElementById(docNameToElId(documentName));
    const originalText = nameCell ? nameCell.textContent : '';
    if (nameCell) nameCell.textContent = 'Uploading...';

    const formData = new FormData();
    formData.append(context.parameter, context.targetId);
    formData.append('upload_type', context.type);
    formData.append('document_id', documentId);
    formData.append('document_name', documentName);
    formData.append('file', file);

    try {
        const response = await fetch('upload_handler.php', { method: 'POST', body: formData });
        const data = await response.json();
        if (!data.success) throw new Error(data.message || 'Upload failed.');
        applyUploadToRow(context.targetId, documentId, documentName, data.original_name);
    } catch (error) {
        console.error('Form upload error:', error);
        if (nameCell) nameCell.textContent = originalText;
        Swal.fire({ title: 'Upload Failed', text: error.message, icon: 'error' });
    } finally {
        inputEl.value = '';
    }
}

document.addEventListener('DOMContentLoaded', loadUploadedFiles);