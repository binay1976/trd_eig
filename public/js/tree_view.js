function makeChip(text, cls) {
    const span = document.createElement('span');
    span.className = 'eig-node ' + cls;
    span.textContent = text;
    return span;
}

function makeClickableChip(text, cls, onClick) {
    const span = makeChip(text, cls);
    span.style.cursor = 'pointer';
    span.title = 'Click to view';
    span.addEventListener('click', onClick);
    return span;
}

function makeEmpty(text) {
    const span = document.createElement('span');
    span.className = 'eig-node-empty';
    span.textContent = text;
    return span;
}

// ── View-only popup ───────────────────────────────────────────────────────
function openEigModal(url, title) {
    document.getElementById('eigModalTitle').textContent = title;
    document.getElementById('eigModalFrame').src = url;
    document.getElementById('eigModalOverlay').classList.remove('hidden');
}
function closeEigModal() {
    document.getElementById('eigModalOverlay').classList.add('hidden');
    document.getElementById('eigModalFrame').src = 'about:blank';
}

// Builds the view_file.php URL for one upload, scoped correctly (umbrella /
// project / form) so the file lookup on the other end matches.
function uploadViewUrl(scope, param, scopedId, upload) {
    const params = new URLSearchParams();
    params.set('scope', scope);
    params.set(param, scopedId);
    params.set('document_name', upload.label);
    return 'view_files.php?' + params.toString();
}

// Renders an upload list as its own small nested <ul>, or null if empty.
// scope/param/scopedId identify which upload flow these belong to, needed
// to build a working view link for each one.
function buildUploadsList(uploads, scope, param, scopedId) {
    if (!uploads || uploads.length === 0) return null;

    const ul = document.createElement('ul');
    uploads.forEach((u) => {
        const li = document.createElement('li');
        const chip = makeClickableChip('📎 ' + u.label + ': ' + u.original_name, 'eig-node-upload', function () {
            openEigModal(uploadViewUrl(scope, param, scopedId, u), u.label + ' — ' + u.original_name);
        });
        li.appendChild(chip);
        ul.appendChild(li);
    });
    return ul;
}

function buildFormInstanceLi(inst) {
    const li = document.createElement('li');

    const statusText = inst.is_filled ? '✓ Filled' : '○ Not filled';
    const chip = makeClickableChip('Form ' + inst.label + ' — ' + statusText, 'eig-node-instance', function () {
        openEigModal(
            'view_form.php?unique_form_id=' + encodeURIComponent(inst.unique_form_id),
            'Form ' + inst.label + ' (Read Only)'
        );
    });
    li.appendChild(chip);

    const uploadsUl = buildUploadsList(inst.uploads, 'form', 'unique_form_id', inst.unique_form_id);
    if (uploadsUl) {
        li.appendChild(uploadsUl);
    } else {
        const emptyUl = document.createElement('ul');
        const e = document.createElement('li');
        e.appendChild(makeEmpty('No uploads for this form instance.'));
        emptyUl.appendChild(e);
        li.appendChild(emptyUl);
    }

    return li;
}

function buildFormLi(form) {
    const li = document.createElement('li');
    li.appendChild(makeChip('📄 ' + form.form_no + ' — ' + form.form_name, 'eig-node-form'));

    const ul = document.createElement('ul');
    form.instances.forEach((inst) => ul.appendChild(buildFormInstanceLi(inst)));
    li.appendChild(ul);

    return li;
}

function buildProjectLi(project) {
    const li = document.createElement('li');

    const label = project.id + (project.location ? ' — ' + project.location : '') + ' (' + project.type_project + ')';
    li.appendChild(makeChip('📁 ' + label, 'eig-node-project'));

    const ul = document.createElement('ul');

    // Project's own uploads
    const uploadsLi = document.createElement('li');
    const uploadsUl = buildUploadsList(project.uploads, 'project', 'project_id', project.id);
    if (uploadsUl) {
        uploadsLi.appendChild(makeChip('Project Documents', 'eig-node-form'));
        uploadsLi.appendChild(uploadsUl);
    } else {
        uploadsLi.appendChild(makeEmpty('No project-level documents uploaded.'));
    }
    ul.appendChild(uploadsLi);

    // Forms added to this project
    if (project.forms.length === 0) {
        const noFormsLi = document.createElement('li');
        noFormsLi.appendChild(makeEmpty('No equipment/forms added to this project yet.'));
        ul.appendChild(noFormsLi);
    } else {
        project.forms.forEach((form) => ul.appendChild(buildFormLi(form)));
    }

    li.appendChild(ul);
    return li;
}

function renderTree(container, data) {
    container.innerHTML = '';

    const rootUl = document.createElement('ul');
    rootUl.className = 'eig-tree';

    const rootLi = document.createElement('li');

    const u = data.umbrella;
    const label = '🌳 ' + u.id + (u.name ? ' — ' + u.name : '') + (u.zone ? ' [' + u.zone + '/' + u.division + ']' : '');
    rootLi.appendChild(makeChip(label, 'eig-node-umbrella'));

    const safeId = encodeURIComponent(u.id.replace(/[^A-Za-z0-9_-]/g, '_'));

    const reportChip = makeClickableChip('📄 View PDF Report', 'eig-node-form', function () {
    openEigModal(
        'final_report.php?umbrella_id=' + encodeURIComponent(u.id),
        'Umbrella Report — ' + u.id
    );
    });
    reportChip.style.marginLeft = '0.5rem';
    rootLi.appendChild(reportChip);

    const bookChip = makeClickableChip('📖 View Full Book', 'eig-node-form', function () {
        openEigModal(
            'final_report_book.php?umbrella_id=' + encodeURIComponent(u.id),
            'Full Book — ' + u.id
        );
    });
    bookChip.style.marginLeft = '0.5rem';
    rootLi.appendChild(bookChip);

    const rootChildUl = document.createElement('ul');

    // Umbrella's own uploads
    const umbUploadsLi = document.createElement('li');
    const umbUploadsUl = buildUploadsList(u.uploads, 'umbrella', 'umbrella_id', u.id);
    if (umbUploadsUl) {
        umbUploadsLi.appendChild(makeChip('Umbrella Documents', 'eig-node-form'));
        umbUploadsLi.appendChild(umbUploadsUl);
    } else {
        umbUploadsLi.appendChild(makeEmpty('No umbrella-level documents uploaded.'));
    }
    rootChildUl.appendChild(umbUploadsLi);

    // Projects
    if (data.projects.length === 0) {
        const noProjLi = document.createElement('li');
        noProjLi.appendChild(makeEmpty('No projects created under this umbrella yet.'));
        rootChildUl.appendChild(noProjLi);
    } else {
        data.projects.forEach((project) => rootChildUl.appendChild(buildProjectLi(project)));
    }

    rootLi.appendChild(rootChildUl);
    rootUl.appendChild(rootLi);
    container.appendChild(rootUl);
}

async function loadTree() {
    const umbrellaId = document.getElementById('treeUmbrellaId').value;
    const container  = document.getElementById('treeContainer');

    if (!umbrellaId) {
        container.innerHTML = '<div class="flex items-center justify-center h-64 text-gray-400 text-sm">🌳 Select an umbrella above to grow its tree.</div>';
        return;
    }

    container.innerHTML = '<div class="flex items-center justify-center h-64 text-gray-400 text-sm">Loading…</div>';

    try {
        const res = await fetch('tree_view.php?umbrella_id=' + encodeURIComponent(umbrellaId));
        const data = await res.json();

        if (!data.success) {
            container.innerHTML = '<div class="flex items-center justify-center h-64 text-red-500 text-sm">' + (data.message || 'Could not load tree.') + '</div>';
            return;
        }

        renderTree(container, data);
    } catch (err) {
        console.error('Error loading tree:', err);
        container.innerHTML = '<div class="flex items-center justify-center h-64 text-red-500 text-sm">Connection error. Please try again.</div>';
    }
}
