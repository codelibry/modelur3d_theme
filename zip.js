const THEME_NAME = '../codelibry.zip';

const fs = require('fs');
const path = require('path');
const archiver = require('archiver');

// Define the name of the zip file
const ZIP_FILE = path.resolve(__dirname, THEME_NAME);

// Remove existing zip file if it exists
if (fs.existsSync(ZIP_FILE)) {
  fs.unlinkSync(ZIP_FILE);
}

// Create output stream
const output = fs.createWriteStream(ZIP_FILE);
const archive = archiver('zip', {
  zlib: { level: 9 }, // maximum compression
});

// Handle errors
archive.on('error', err => {
  throw err;
});

// Pipe archive data to the file
archive.pipe(output);

// Add current directory, excluding specific files/folders
archive.glob('**/*', {
  ignore: [
    "**/node_modules/**",
    "**/.git/**",
    "**/*.map",
    "src/**/*.scss",
    "src/**/*.js",
    "webpack.config.js",
    "deploy.js",
    "zip.js",
    "package.json",
    "package-lock.json",
  ]
});

// Finalize archive
archive.finalize();

// Log success
output.on('close', () => {
  console.log(`Archive created: ${ZIP_FILE}`);
});
