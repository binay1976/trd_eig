<div class="max-w-5xl mx-auto">

    <!-- Page Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Create Project
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Enter the details to create a new  project.
        </p>
    </div>

    <!-- Form -->
    <form
        action="actions/save_umbrella.php"
        method="POST"
        class="space-y-6"
    >

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- 1. Umbrella Project Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Project Name
                    <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    name="umbrella_project_name"
                    required
                    placeholder="Enter umbrella project name"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                           outline-none"
                >
            </div>


            <!-- 2. Project Code -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Project Code
                    <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    name="project_code"
                    required
                    placeholder="Enter project code"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                           outline-none"
                >
            </div>


            <!-- 3. Department - Dropdown -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Department
                    <span class="text-red-500">*</span>
                </label>

                <select
                    name="department"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg
                           bg-white focus:ring-2 focus:ring-blue-500
                           focus:border-blue-500 outline-none"
                >
                    <option value="">Select Department</option>
                    <option value="Electrical">Electrical</option>
                    <option value="Mechanical">Mechanical</option>
                    <option value="Civil">Civil</option>
                    <option value="Signal">Signal</option>
                    <option value="Telecom">Telecom</option>
                    <option value="Other">Other</option>
                </select>
            </div>


            <!-- 4. Project Type - Dropdown -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Project Type
                    <span class="text-red-500">*</span>
                </label>

                <select
                    name="project_type"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg
                           bg-white focus:ring-2 focus:ring-blue-500
                           focus:border-blue-500 outline-none"
                >
                    <option value="">Select Project Type</option>
                    <option value="New">New Project</option>
                    <option value="Modification">Modification</option>
                    <option value="Upgradation">Upgradation</option>
                    <option value="Replacement">Replacement</option>
                    <option value="Maintenance">Maintenance</option>
                </select>
            </div>


            <!-- 5. Estimated Cost - Number -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Estimated Cost
                    <span class="text-red-500">*</span>
                </label>

                <input
                    type="number"
                    name="estimated_cost"
                    required
                    min="0"
                    step="0.01"
                    placeholder="Enter estimated cost"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                           outline-none"
                >
            </div>


            <!-- 6. Number of Projects -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Number of Projects
                    <span class="text-red-500">*</span>
                </label>

                <input
                    type="number"
                    name="number_of_projects"
                    required
                    min="1"
                    placeholder="Enter number of projects"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                           outline-none"
                >
            </div>


            <!-- 7. Start Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Start Date
                    <span class="text-red-500">*</span>
                </label>

                <input
                    type="date"
                    name="start_date"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                           outline-none"
                >
            </div>


            <!-- 8. Project Location -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Project Location
                    <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    name="project_location"
                    required
                    placeholder="Enter project location"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                           outline-none"
                >
            </div>

        </div>


        <!-- 9. Description -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Project Description
            </label>

            <textarea
                name="description"
                rows="4"
                placeholder="Enter project description"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg
                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                       outline-none resize-none"
            ></textarea>
        </div>


        <!-- Buttons -->
        <div class="flex justify-center gap-4 pt-4">

            <button
                type="reset"
                class="px-6 py-3 bg-gray-200 text-gray-700
                       rounded-lg hover:bg-gray-300
                       font-medium"
            >
                Reset
            </button>

            <button
                type="submit"
                class="px-8 py-3 bg-blue-600 text-white
                       rounded-lg hover:bg-blue-700
                       font-medium shadow-sm"
            >
                Create Umbrella Project
            </button>

        </div>

    </form>
