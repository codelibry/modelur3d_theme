require("dotenv").config();
const FtpDeploy = require("ftp-deploy");
const ftpDeploy = new FtpDeploy();

const env = process.argv[2];
if (!env || !["staging", "live"].includes(env)) {
  console.error("Usage: node deploy [staging|live]");
  process.exit(1);
}

const prefix = env.toUpperCase();

const config = {
  user: process.env[`${prefix}_FTP_USER`],
  password: process.env[`${prefix}_FTP_PASSWORD`],
  host: process.env[`${prefix}_FTP_HOST`],
  port: 21,
  localRoot: __dirname,
  remoteRoot: "/site-name/wp-content/themes/theme-name",

  include: ["**/*"],

  exclude: [
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
  ],

  deleteRemote: false,
  forcePasv: true,
  sftp: false,
};

console.log(`Пуляєм файли на сєрвачок... (${env})`)

ftpDeploy
    .deploy(config)
    .then((res) => console.log("Вроді як все гуд!"))
    .catch((err) => console.log(err));

ftpDeploy.on("upload-error", function (data) {
    console.log(data.err); // data will also include filename, relativePath, and other goodies
});
