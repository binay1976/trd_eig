// Drives the 3-column drill-down on admin_dashboard.php: clicking an
// umbrella loads its projects, clicking a project loads its equipment/forms.

// ── Column 1 → 2: umbrella click ──────────────────────────────────────────────
document.getElementById('umbrellaList').addEventListener('click', function (e) {
    const row = e.target.closest('.col-row');
    if (!row) return;

    const umbrellaId = row.dataset.id;

    // Highlight
    document.querySelectorAll('#umbrellaList .col-row').forEach(r => r.classList.remove('active'));
    row.classList.add('active');

    // Reset columns 2 & 3
    setPlaceholder('projectList',   '← Select an umbrella project');
    setPlaceholder('equipmentList', '← Select a project');
    hide('projectCountBadge');
    hide('equipmentCountBadge');

    setLoading('projectList', 'Loading projects…');

    fetch('admin_dashboard.php?umbrella_id=' + encodeURIComponent(umbrellaId))
        .then(res => res.json())
        .then(data => {
            if (!data.success) { setError('projectList', data.message); return; }

            const badge = document.getElementById('projectCountBadge');
            badge.textContent = data.projects.length;
            badge.style.display = 'inline';

            if (data.projects.length === 0) {
                setPlaceholder('projectList', 'No projects found for this umbrella.');
                return;
            }

            document.getElementById('projectList').innerHTML = data.projects.map(p => `
                <div class="col-row" data-id="${escHtml(p.project_id)}"
                     style="display: flex; gap: 8px; align-items: center;">
                    <div style="flex: 1; min-width: 0;">
                        <div style="font-family: monospace; font-size: 0.72rem; color: #5B21B6; font-weight: 600; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            ${escHtml(p.project_id)}
                        </div>
                        <div style="color: #374151; margin-top: 1px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            ${escHtml(p.location || '—')}
                        </div>
                        <div style="font-size: 0.68rem; color: #9CA3AF; margin-top: 2px;">
                            ${escHtml(p.project_type || '')}
                        </div>
                    </div>
                    <div style="width: 50px; text-align: center;">
                        <span style="background: #EDE9FE; color: #5B21B6; font-size: 0.68rem; font-weight: 600; padding: 2px 6px; border-radius: 99px;">
                            ${escHtml(p.type_project)}
                        </span>
                    </div>
                </div>
            `).join('');
        })
        .catch(() => setError('projectList', 'Connection error.'));
});

// ── Column 2 → 3: project click ───────────────────────────────────────────────
document.getElementById('projectList').addEventListener('click', function (e) {
    const row = e.target.closest('.col-row');
    if (!row) return;

    const projectId = row.dataset.id;

    // Highlight
    document.querySelectorAll('#projectList .col-row').forEach(r => r.classList.remove('active'));
    row.classList.add('active');

    setLoading('equipmentList', 'Loading equipment…');
    hide('equipmentCountBadge');

    fetch('admin_dashboard.php?project_id=' + encodeURIComponent(projectId))
        .then(res => res.json())
        .then(data => {
            if (!data.success) { setError('equipmentList', data.message); return; }

            const badge = document.getElementById('equipmentCountBadge');
            badge.textContent = data.equipment.length;
            badge.style.display = 'inline';

            if (data.equipment.length === 0) {
                setPlaceholder('equipmentList', 'No equipment added for this project yet.');
                return;
            }

            document.getElementById('equipmentList').innerHTML = data.equipment.map((eq, i) => {
                const total  = eq.total;
                const filled = eq.filled;

                let badgeColor;
                if (filled === 0)        badgeColor = 'color:#dc2626;background:#fee2e2';   // red
                else if (filled < total) badgeColor = 'color:#ea580c;background:#ffedd5';   // orange
                else                     badgeColor = 'color:#16a34a;background:#dcfce7';   // green

                return `
                <div class="col-row" style="display: flex; gap: 8px; align-items: flex-start; cursor: default;">
                    <div style="width: 24px; text-align: center; color: #9CA3AF; font-size: 0.72rem; padding-top: 1px; flex-shrink: 0;">${i + 1}</div>
                    <div style="width: 70px; flex-shrink: 0; font-family: monospace; font-size: 0.72rem; color: #065F46; font-weight: 600;">${escHtml(eq.form_no)}</div>
                    <div style="flex: 1; min-width: 0; color: #374151; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${escHtml(eq.form_name)}</div>
                    <div style="width: 60px; text-align: center; flex-shrink: 0;">
                        <span style="${badgeColor}; font-size: 0.68rem; font-weight: 600; padding: 2px 6px; border-radius: 99px;">${filled}/${total}</span>
                    </div>
                </div>`;
            }).join('');
        })
        .catch(() => setError('equipmentList', 'Connection error.'));
});

// ── Helpers ───────────────────────────────────────────────────────────────────
function setPlaceholder(id, msg) {
    document.getElementById(id).innerHTML =
        `<div style="padding: 32px 12px; text-align: center; color: #9CA3AF; font-size: 0.82rem;">${msg}</div>`;
}
function setLoading(id, msg) {
    document.getElementById(id).innerHTML =
        `<div style="padding: 32px 12px; text-align: center; color: #9CA3AF; font-size: 0.82rem;">${msg}</div>`;
}
function setError(id, msg) {
    document.getElementById(id).innerHTML =
        `<div style="padding: 32px 12px; text-align: center; color: #EF4444; font-size: 0.82rem;">${msg}</div>`;
}
function hide(id) {
    document.getElementById(id).style.display = 'none';
}
function escHtml(str) {
    if (str === null || str === undefined) return '';
    const d = document.createElement('div');
    d.textContent = String(str);
    return d.innerHTML;
}
