import fs from 'fs'; // Import the 'fs' module for file system operations
import sortKeys from 'sort-keys'; // Import the 'sort-keys' module

(async () => {
    const composerJsonPath = './composer.json'; // Define the path to the composer.json file
    const composerJson = JSON.parse(fs.readFileSync(composerJsonPath, 'utf-8')); // Read and parse the composer.json file

    // Define the sections to sort within the composer.json
    const sectionsToSort = ['require-dev', 'config', 'scripts', 'extra', 'authors', 'support'];

    // Sort each specified section if it exists in the composer.json
    sectionsToSort.forEach((section) => {
        if (composerJson[section]) {
            composerJson[section] = sortKeys(composerJson[section]);
        }
    });

    // Write the sorted composer.json back to the file with proper formatting
    fs.writeFileSync(composerJsonPath, JSON.stringify(composerJson, null, '\t') + '\n', 'utf-8');
})();
