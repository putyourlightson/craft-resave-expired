[![Stable Version](https://img.shields.io/packagist/v/putyourlightson/craft-resave-expired?label=stable)]((https://packagist.org/packages/putyourlightson/craft-resave-expired))
[![Total Downloads](https://img.shields.io/packagist/dt/putyourlightson/craft-resave-expired)](https://packagist.org/packages/putyourlightson/craft-resave-expired)

<p align="center"><img width="200" src="src/icon.svg"></p>

# Resave Expired Plugin for Craft CMS

The Resave Expired plugin resaves elements when their future post or expiry dates pass. It requires a CLI command to be run on a regular schedule via a cron job. 

```shell
php craft resave-expired/elements/resave-expired
```

Since expiry dates are only registered on element save, you can run the following command after installing the plugin, which will resave all elements’ expiry dates.

```shell
php craft resave-expired/elements/resave-expiry-dates
```

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
