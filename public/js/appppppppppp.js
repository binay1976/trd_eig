// SPA page switcher — swaps #pageContent's innerHTML via fetch() instead of
// a full page reload. Called by every nav button's onclick="loadPage('...')".
function loadPage(page) {

    const content = document.getElementById("pageContent");

    content.innerHTML = `
        <div class="flex justify-center items-center h-64">
            <div class="text-gray-500">
                Loading...
            </div>
        </div>
    `;

    let pageFile = "";

    switch (page) {

    case "home":
        pageFile = "admin_dashboard.php";
        break;

    case "umbrella":
        pageFile = "create_umbrella.php";
        break;

    case "umbrella_uploads":
        pageFile = "uploads.php?scope=umbrella";
        break;

    case "project":
        pageFile = "create_project.php";
        break;

    case "project_uploads":
        pageFile = "uploads.php?scope=project";
        break;

    case "equipment":
        pageFile = "add_equipment.php";
        break;

    case "create_user":
        pageFile = "create_user.php";
        break;

    case "tree":
        pageFile = "tree_view.php";
        break;

    case "dashboard2":
        pageFile = "admin_dashboard2.php";
        break;

    default:
        pageFile = "home.php";
    }

    // Marks this as an SPA fragment request — lets a page (see
    // admin_dashboard2.php) tell the difference between being fetched in
    // here vs. being opened directly by URL, and render itself accordingly.
    fetch(pageFile, { headers: { 'X-Requested-With': 'Fetch' } })
        .then(response => {

            if (!response.ok) {
                throw new Error(
                    "HTTP Error: " + response.status
                );
            }

            return response.text();
        })
        .then(data => {

            content.innerHTML = data;

            // Re-execute any <script> tags in the injected HTML
            // (browsers block scripts set via innerHTML)
            content.querySelectorAll('script').forEach(function(oldScript) {
                const newScript = document.createElement('script');

                // Copy attributes (type, src, etc.)
                Array.from(oldScript.attributes).forEach(function(attr) {
                    newScript.setAttribute(attr.name, attr.value);
                });

                // Copy inline script content
                newScript.textContent = oldScript.textContent;

                // Append to body to trigger execution, then remove
                document.body.appendChild(newScript);
                newScript.remove();
            });

        })
        .catch(error => {

            console.error(error);

            content.innerHTML = `
                <div class="p-6 bg-red-50 border border-red-200 rounded-lg">
                    <h3 class="font-bold text-red-700">
                        Error Loading Page
                    </h3>

                    <p class="text-red-600 mt-2">
                        ${error.message}
                    </p>
                </div>
            `;
        });
}