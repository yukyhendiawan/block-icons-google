import fs from 'fs'; // Import the 'fs' module for file system operations

(async () => {
    // Dynamically import the 'sort-package-json' module
    const sortPackageJson = (await import('sort-package-json')).default;

    const packageJsonPath = './package.json'; // Define the path to the package.json file
    const packageJson = JSON.parse(fs.readFileSync(packageJsonPath, 'utf-8')); // Read and parse the package.json file

    // Define the sections to sort within the package.json
    const sectionsToSort = ['scripts', 'devDependencies', 'dependencies'];

    // Sort each specified section if it exists in the package.json
    sectionsToSort.forEach((section) => {
        if (packageJson[section]) {
            packageJson[section] = sortPackageJson({ [section]: packageJson[section] })[section];
        }
    });

    // Write the sorted package.json back to the file with proper formatting
    fs.writeFileSync(packageJsonPath, JSON.stringify(packageJson, null, '\t') + '\n', 'utf-8');
})();
