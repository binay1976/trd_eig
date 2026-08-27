function testJS() {
    alert("JavaScript is working!");
}

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
        pageFile = "./upload_umbrella.php";
        break;

    case "project":
        pageFile = "create_project.php";
        break;

    case "project_uploads":
        pageFile = "./upload_project.php";
        break;

    case "equipment":
        pageFile = "create_equipment.php";
        break;

    case "equip_uploads":
        pageFile = "./upload_equip.php";
        break;

    default:
        pageFile = "admin_dashboard.php";
    }

    const pageUrl = new URL(pageFile, window.location.href).href;

    fetch(pageUrl, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
        .then(response => {

            if (!response.ok) {
                throw new Error(
                    "HTTP Error: " + response.status + " while loading " + pageUrl
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
