# The Seattle Against Slavery Website Base

This website is built off of the WordPress 12-factor base: fully managed using Composer and configured using environment variables.
The theme for this website lives at [seattleagainstslavery/seattleagainstslavery](https://github.com/seattleagainstslavery/seattleagainstslavery)

# General Concepts and Considerations

 **Automatic updates for WordPress or plugins, and theme editing, are disabled intentionally. What you deploy is what gets executed, which makes setups simple to deploy, and, most importantly, reproducible. By requiring that all changes to the site be made in code in the repository here, we prevent the live version of the site from becoming out of sync with our version controlled codebase. Practically speaking, this means that new plugins or Wordpress updates must be made via code updates to this repository, not through the Wordpress admin.**

We use the tool Composer to manage our dependencies and control installation behavior. See the `composer.json` file as an example. You will see a list of required dependencies as wewll as a `scripts` section that defines the wordpress install along with plugin management. 

The WordPress installation is fully contained in top-level `wordpress` and `wp-content` directories upon `composer install`. A `wp-config.php` resides in the root of the project, and uses several different environment variables to control behavior. 

[WP-CLI](http://wp-cli.org) is used for easier (or automated) handling of tasks such as enabling plugins or storing configuration options. After a deploy, a set of pre-configured [Composer scripts](https://getcomposer.org/doc/articles/scripts.md) can run several administrative functions using WP-CLI, such as initially configuring the blog, and enabling plugins (this happens either automatically when using a Heroku button deploy, or manually). This means that the installation of plugins and their configuration can be part of your version controlled code, so you can easily re-create a blog installation without any manual steps that need separate documentation.

The configuration file is kept as generic as possible; on Heroku, add-ons [JawsDB](https://elements.heroku.com/addons/jawsdb) (for MySQL), [Bucketeer](https://elements.heroku.com/addons/bucketeer) (for S3 storage), and [SendGrid](https://elements.heroku.com/addons/sendgrid) (for E-Mails) are used.

HTTPS is forced for Login and Admin functions, except for local development. `WP_DEBUG` is on; errors do not get displayed, but should get logged to PHP's default error log, accessible e.g. using `heroku logs`.

## Automatic Deploys

This repository is connected to a Heroku pipeline. Any commits to the master branch on GitHub will automatically deploy to the staging app in the pipeline. 

```
$ git push origin master
```


## Installing a new Plugin or Theme

1. Search for your plugin or theme on [WordPress Packagist](http://wpackagist.org);
1. Click the latest version and check the version selector string in the text box that appears - it will look like `"wpackagist-theme/hueman": "1.5.7"` or `"wpackagist-plugin/akismet": "3.1.7"`;
1. You don't want such an exact version, but instead a more lenient selector like (in the case above) `^1.5.7` or at least `~1.5.7` (see the [Composer docs](https://getcomposer.org/doc/articles/versions.md#next-significant-release-operators) for details);
1. Run `composer require wpackagist-$type/name:^$version`, for example:

    ```
    composer require wpackagist-plugin/akismet:^3.1.7
    ```
    
    or
    
    ```
    composer require wpackagist-plugin/hueman:^1.5.7
    ```

1. Run `git add composer.json composer.lock` and `git commit`;
1. `git push origin master`

## Updating WordPress and Plugins

In order to ensure that the app remains the same across all deployments, installing plugins through the admin panel is disabled intentionally. You must all all plugins and changes to the site to the code base here and have it redeployed.

To update all dependencies:

```
$ composer update
```

Alternatively, run `composer update johnpbloch/wordpress` to only update WordPress, or e.g. `composer update wpackagist-plugin/sendgrid-email-delivery-simplified` to only update that plugin.

Afterwards, add, commit and push the changes:

```
$ git add composer.json composer.lock
$ git commit -m "new WordPress and Plugins"
$ git push origin master
```

# Credentials

## `.env` file

We keep environment variables in a `.env` file for local development. Environment variables are configured in Heroku, but you'll need to set up a `.env` fole locally. See the `.env.sample` for the structure of this file. You will need to create a copy of this file, naming it `.env`, and replacing the values with the proper keys. Do no check in your `.env` file--we intentionally keep this separate from the repo to maintain our secret keys.
Please request a copy of the environment variables to 

## `auth.json` file

The `auth.json` file is used by composer to authenticate when needed for installing packages. Because we pull from private repositories, you'll need to repalce the following entry:

```
  "github-oauth": {
      "github.com": "REPLACEME"
    }
```

with a personal access token from Github. Generate a [personal access token here](https://github.com/settings/tokens). Ensure that your token has permissions set so that it can access the repositories needed (ie, give access with the token to any theme or plugin repositories that are private).

# Running locally with Docker

To exactly replicate the environment and build of the heroku deploy, we use docker to manage our local dev environment. Download Docker Community Edition for your machine on the [Docker website](https://store.docker.com/search?type=edition&offering=community). 

Docker uses the `docker-compose.yml` file and the `Dockerfile` to create an environment based off the heroku environment & php buildpacks. When you set up docker locally, it will build the exact same app in the exact same enviroment as the deploy to Heroku.

To get started, run: `docker-compose build` to build the service. If you change the Dockerfile, run `docker-compose build` to rebuild it.

Then run: `docker-compose up`, which will builds, (re)create, start, and attache to service's container. You can now access the app by going to `localhost` in your browser.

To stop your container, run `docker-compose down`.

The file `docker/command.sh` is run to install wordpress and run the composer scripts inside your docker container. Check out that file to see the way the wordpress installation is being run (including the local admin username/password) as well as when the composer scripts get called.
