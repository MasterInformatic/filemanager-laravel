# File Manager Laravel

<p align="center">

  <a href="http://masterinformatic.github.io/filemanager-laravel/docs/installation">Installation</a>
・
  <a href="http://masterinformatic.github.io/filemanager-laravel/docs/integration">Integration</a>
・
  <a href="http://masterinformatic.github.io/filemanager-laravel/docs/config">Config</a>
・
  <a href="https://www.masterinformatic.com/demos/filemanager">Demo</a>
</p>
## Installation

### Download
> run the command

```shell
composer require masterinformatic/filemanager-laravel
```

### Setup


##### Add service providers
```
Intervention\Image\ImageServiceProvider::class

```

##### And add class aliases
```
'ImageUpload' => Intervention\Image\Facades\Image::class

```

##### Publish the package’s config and assets 

```shell
php artisan vendor:publish --tag=mifm_config
php artisan vendor:publish --tag=mifm_public
```

##### Run commands to clear cache 
```shell
php artisan route:clear
php artisan config:clear
```

##### Create symbolic link 

```shell
php artisan storage:link
```

---


## Support

Reach out to me at one of the following places!

- Website at <a href="http://masterinformatic.com" target="_blank">`masterinformatic.com`</a>
- Twitter at <a href="http://twitter.com/MasInfo_oficial" target="_blank">`@MasInfo_oficial`</a>
- Instagram at <a href="https://www.instagram.com/masterinformatic.oficial/" target="_blank">`@masterinformatic.oficial`</a>
- Facebook at <a href="http://facebook.com/masterinformatic.oficial/" target="_blank">`@masterinformatic.oficial`</a>


---


## License

[![License](http://img.shields.io/:license-mit-blue.svg?style=flat-square)](http://badges.mit-license.org)

- **[MIT license](http://opensource.org/licenses/mit-license.php)**
- Copyright 2019 © <a href="http://masterinformatic.com" target="_blank">MasterInformatic</a>.