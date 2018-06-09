# Seattle Against Slavery Theme
This is a custom WordPress theme based on [Foundation 6](https://foundation.zurb.com/sites.html).

## Requirements
- [Node.js](http://nodejs.org)
- [Sass](http://Sass-lang.com/)
- GCC. Windows users can install it through [MinGW](http://www.mingw.org/), and Mac users can install it through the [Xcode Command-line Tools](http://osxdaily.com/2014/02/12/install-command-line-tools-mac-os-x/).

## Quickstart
### 1. Clone the repository and install with npm
```bash
$ cd my-wordpress-folder/wp-content/themes/
$ git clone https://github.com/seattleagainstslavery/seattleagainstslavery.org.git
$ cd seattleagainstslavery.org
$ npm install
```

### 2. Configuration
#### YAML config file
The project includes a `config-default.yml` file. To make changes to the configuration, make a copy of `config-default.yml` and name it `config.yml` and make changes to that file. The `config.yml` file is ignored by git so that each environment can use a different configuration with the same git repo.

At the start of the build process a check is done to see if a `config.yml` file exists. If `config.yml` exists, the configuration will be loaded from `config.yml`. If `config.yml` does not exist, `config-default.yml` will be used as a fallback.

#### Browsersync setup
If you want to take advantage of [Browsersync](https://www.browsersync.io/) (automatic browser refresh when a file is saved), simply open your `config.yml` file after creating it in the previous step, and put your local dev-server address and port (e.g http://localhost:8888) in the `url` property under the `BROWSERSYNC` object.

### 3. Get started
```bash
$ npm start
```

### 4. Compile assets for production
When building for production, the CSS and JS will be minified. To minify the assets in your `/dist` folder, run

```bash
$ npm run build
```

#### To create a .zip file of your theme, run:
```
$ npm run package
```

Running this command will build and minify the theme's assets and place a .zip archive of the theme in the `packaged` directory. This excludes the developer files/directories from your theme like `/node_modules`, `/src`, etc. to keep the theme lightweight.

### Project structure
In the `/src` folder you will the working files for all our assets. Every time you make a change to a file that is watched by Gulp, the output will be saved to the `/dist` folder. The contents of this folder are the compiled code that you should not touch (unless you have a good reason for it).

The `/page-templates` folder contains templates that can be selected in the Pages section of the WordPress admin panel. To create a new page-template, simply create a new file in this folder and make sure to give it a template name.

I guess the rest is quite self explanatory. Feel free to ask if you feel stuck.

### Styles and Sass Compilation
 * `style.css`: Do not worry about this file. (For some reason) it's required by WordPress. All styling are handled in the Sass files described below
 * `src/assets/scss/app.scss`: Make imports for all your styles here
 * `src/assets/scss/global/*.scss`: Global settings
 * `src/assets/scss/components/*.scss`: Buttons etc.
 * `src/assets/scss/modules/*.scss`: Topbar, footer etc.
 * `src/assets/scss/templates/*.scss`: Page template styling
 * `dist/assets/css/app.css`: This file is loaded in the `<head>` section of your document, and contains the compiled styles for your project.

### JavaScript Compilation
All JavaScript files, including Foundation's modules, are imported through the `src/assets/js/app.js` file. The files are imported using module dependency with [webpack](https://webpack.js.org/) as the module bundler.

If you're unfamiliar with modules and module bundling, check out [this resource for node style require/exports](http://openmymind.net/2012/2/3/Node-Require-and-Exports/) and [this resource to understand ES6 modules](http://exploringjs.com/es6/ch_modules.html).

If you need to output additional JavaScript files separate from `app.js`, do the following:
* Create new `custom.js` file in `src/assets/js/`. If you will be using jQuery, add `import $ from 'jquery';` at the top of the file.
* In `config.yml`, add `src/assets/js/custom.js` to `PATHS.entries`.
* Build (`npm start`)
* You will now have a `custom.js` file outputted to the `dist/assets/js/` directory.

## Documentation
* [Zurb Foundation Docs](http://foundation.zurb.com/docs/)
* [WordPress Codex](http://codex.wordpress.org/)
