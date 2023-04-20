[![Stable Version](https://img.shields.io/packagist/v/putyourlightson/craft-resave-expired?label=stable)]((https://packagist.org/packages/putyourlightson/craft-resave-expired))
[![Total Downloads](https://img.shields.io/packagist/dt/putyourlightson/craft-resave-expired)](https://packagist.org/packages/putyourlightson/craft-resave-expired)

<p align="center"><img width="200" src="src/icon.svg"></p>

# Resave Expired Plugin for Craft CMS

The Resave Expired plugin resaves elements when their future post or expiry dates pass. It requires a console command to be run on a regular schedule via a cron job.

This is especially useful with plugins like [Scout](https://plugins.craftcms.com/scout?craft4), that sync entries to Algolia only on save. Caching plugins can also benefit from this.

> [Blitz](https://putyourlightson.com/plugins/blitz) already has this functionality built in, so does *not* require this plugin.

## Documentation

Learn more and read the documentation at [putyourlightson.com/plugins/resave-expired »
](https://putyourlightson.com/plugins/resave-expired)

## License

This plugin is licensed for free under the MIT License.

## Requirements

This plugin requires [Craft CMS](https://craftcms.com/) 4.0.0 or later.

## Installation

To install the plugin, search for “Resave Expired” in the Craft Plugin Store, or install manually using composer.

```shell
composer require putyourlightson/craft-resave-expired
```

---

Created by [PutYourLightsOn](https://putyourlightson.com/).
