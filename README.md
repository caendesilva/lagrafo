# Lagrafo, for when you just want some documentation.

<p><a href="https://packagist.org/packages/desilva/lagrafo"><img style="display:inline;margin:2px;" src="https://img.shields.io/packagist/v/desilva/lagrafo.svg?style=flat-square" alt="Latest Version on Packagist"></a>
<a href="https://packagist.org/packages/desilva/lagrafo"><img style="display:inline;margin:2px;" src="https://img.shields.io/packagist/dt/desilva/lagrafo.svg?style=flat-square" alt="Total Downloads"></a>
<img style="display:inline;margin:2px;" src="https://github.com/caendesilva/lagrafo/actions/workflows/main.yml/badge.svg" alt="GitHub Actions"></p>

> **Important** I'm #CodingInPublic, this is not at all ready for production use.

<p class="lead">
Lagrafo is a simple to the point, documentation site package for Laravel, built to just get some damn documentation without any fuss, configuration, or code.
</p>

The package is opinionated and may not suit your needs. I originally created it for my own use,
and don't indend to spending a lot of time on adding an extensive feature set to it.
If you want a more robust and highly customizable static documentation site, check ouy my other project, HydePHP at [hydephp.github.io](https://hydephp.github.io/)!

> The layout is currently not responsive, but I'm working on it.

## Installation

You can install the package via composer:

```bash
composer require desilva/lagrafo
```

## Usage

Place markdown files in the `resources/docs` directory,
and access them through the `/docs/<markdown-slug>` route.

Lagrafo does not really offer any customization options,
though you can override the automatic sidebar order and labels using optional front matter.

## About
### Features
- Markdown documentation files are automatically discovered
- Automatic sidebar
- No configuration
- Laravel powered routing
- Lightweight frontend
- Basic search feature that can return API results


### Screenshot

![Screenshot](https://user-images.githubusercontent.com/95144705/165140594-98bbee16-b121-4a82-b8cb-5e39be44afa0.png)


## Resources

### Contributing

Feel free to fork the project and submit pull requests!
I'd love to get proper tests in place, if that's something you're interested in.

### Security

If you discover any security related issues, please email caen@desilva.se instead of using the issue tracker.

### Credits

-   [Caen De Silva](https://github.com/desilva)
-   [All Contributors](../../contributors)

### License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
