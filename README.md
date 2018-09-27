# The Seattle Against Slavery Wordpress Base

This website is built off of the WordPress 12-factor base: fully managed using Composer and configured using environment variables.

# General Concepts and Considerations

**Automatic updates for WordPress or plugins, and theme editing, are disabled intentionally. What you deploy is what gets executed, which makes setups simple to deploy, and, most importantly, reproducible. By requiring that all changes to the site be made in code in the repository here, we prevent the live version of the site from becoming out of sync with our version controlled codebase. Practically speaking, this means that new plugins or Wordpress updates must be made via code updates to this repository, not through the Wordpress admin.**

We use the tool Composer to manage our dependencies and control installation behavior. See the `composer.json` file as an example. You will see a list of required dependencies as well as a `scripts` section that defines the wordpress install along with plugin management.

The WordPress installation is fully contained in top-level `wordpress` and `wp-content` directories upon `composer install`. A `wp-config.php` resides in the root of the project, and uses several different environment variables to control behavior.

[WP-CLI](http://wp-cli.org) is used for easier (or automated) handling of tasks such as enabling plugins or storing configuration options. After a deploy, a set of pre-configured [Composer scripts](https://getcomposer.org/doc/articles/scripts.md) can run several administrative functions using WP-CLI, such as initially configuring the blog and enabling plugins. This means that the installation of plugins and their configuration are part of your version controlled code, so you can easily re-create a blog installation without any manual steps that need separate documentation.

The configuration file is kept as generic as possible; on Heroku, add-ons [JawsDB](https://elements.heroku.com/addons/jawsdb) (for MySQL), [Bucketeer](https://elements.heroku.com/addons/bucketeer) (for S3 storage), and [SendGrid](https://elements.heroku.com/addons/sendgrid) (for E-Mails) are used.

HTTPS is forced for Login and Admin functions, except for local development. `WP_DEBUG` is on; errors do not get displayed, but should get logged to PHP's default error log and are accessible in the Heroku logs.

## Create a new WordPress app with quick deploy

Fork this repository and give it the name of the site you are creating. Then simply use the following button to deploy this application to Heroku:

[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy)

After the deploy, in [Heroku's Dashboard](https://dasboard.heroku.com) under "Settings" for your deployed application, **remove the `WORDPRESS_ADMIN_*` environment variables**. You may then remove this section from the README.

## Automatic Deploys

This repository is connected to a Heroku pipeline. Any commits to the master branch on GitHub will automatically deploy to the staging app in the pipeline.

```
$ git push origin master
```

## Managing plugins and themes

All plugins and themes are managed in the `composer.json` file. There are three steps to add a new plugin:

1. **Ensure that the source of the plugin is listed under `"repositories".** Note that in the list of repositories, you have many source types. `wpackagist`, the `plugins` & 'themes' directories, or as an example, a private repository with the git url. If you are using a private respository, add a new entry in the list of repositories so that composer will know where to find the source.
2. Add your plugin or theme to the `"require"` list. Use version numbers to lock to a specific version or list a minimum version.
3. Use the `"scripts"` section to peform actions with the wp-cli. For example, if you are adding a plugin, make sure to add it to the script named `wordpress-setup-enable-plugins`. If you are adding a new theme, you can have the script `wordpress-activate-theme` set to activate the new theme.

### Updating WordPress and Plugins

In order to ensure that the app remains the same across all deployments, installing plugins through the admin panel is disabled intentionally. You must add all plugins and changes to the `composer.json` file and have it redeployed.

You can either update all dependencies at once with:

```
$ composer update
```

Or you can update specific plugins by specifying the plugin in the update command like so:

```
$ composer update johnpbloch/wordpress
$ composer update wpackagist-plugin/sendgrid-email-delivery-simplified
```

Then add, commit, and push the changes:

```
$ git add composer.json composer.lock
$ git commit -m "Update WordPress and sendgrid plugin"
$ git push origin master
```

# Credentials

## `.env` file

We keep environment variables in a `.env` file for local development. Environment variables are configured in Heroku, but you'll need to set up a `.env` file locally. See the `.env.sample` for the structure of this file. You will need to create a copy of this file, naming it `.env`, and replacing the values with the proper keys. Do no check in your `.env` file--we intentionally keep this separate from the repo to maintain our secret keys.

Note that if you are pulling any themes or plugins from a private repository on Github, you will need to set up `github-oauth` as listed in the `.env.sample` file so that you can access the repos. You can find out how to make a token for access [here](https://help.github.com/articles/creating-a-personal-access-token-for-the-command-line/).

# Running locally with Docker

To exactly replicate the environment and build of the Heroku deploy, we use docker to manage our local dev environment. Download Docker Community Edition for your machine on the [Docker website](https://store.docker.com/search?type=edition&offering=community).

Our docker uses the `docker-compose.yml` file and the `Dockerfile` to create an environment based off the heroku environment & php buildpacks. When you set up docker locally, it will build the exact same app in the exact same enviroment as the deploy to Heroku.

To get started, run:

```bash
docker-compose build
```

to build the wordpress app image and create the services "wordpress" & "db". If you change the Dockerfile or `docker-compose.yml`, run `docker-compose build` to rebuild it.

Then run:

```bash
docker-compose up
```

which will start containers for the `wordpress` & `db` services. You can now access the app by going to `localhost` in your browser.

To stop your container, run

```bash
docker-compose down
```

The file `docker/command.sh` is run to install wordpress and run the composer scripts inside your docker container. Check out that file to see the way the wordpress installation is being run (including the local admin username/password) as well as when the composer scripts get called.
