Foliotek/Croppie 
===============

Foliotek/Croppie control for Nette framework

# Install

```sh
$ composer require vojtys/croppie
```

# Versions

| State  | Version  | Branch   | Nette  | PHP     |
|--------|----------|----------|--------|---------|
| stable | `v0.2`   | `master` | `3.0+` | `>=7.1` |
| stable | `v0.1`   | `master` | `2.4`  | `>=5.6` |

# Configuration

## NEON - add extension

```yaml
extensions:
    croppie: Vojtys\Forms\Croppie\CroppieExtension

croppie:
    width: 300
    height: 300
    enableExif: true
    type: square
    size: original
```

# Usage

```php

public function createComponentTestForm(): Form
{
    $form = new Form();

    $form->addCroppie('image', 'Vybrat obrázek z počítače');
    $form->addSubmit('ok', 'Nahrát obrázek')->getControlPrototype()->class('upload-btn');
    $form->onSuccess[] = [$this, 'imageUploadProcess'];

    return $form;
}

public function imageUploadProcess(Form $form, $values)
{
    /** @var Vojtys\Forms\Croppie\Image $image **/
    $image = $values->image; 
}

```

## CSS

```html
<link rel="stylesheet" type="text/css" href="./assets/css/croppie.css">
<link rel="stylesheet" type="text/css" href="./assets/css/vojtys.croppie.css">
```

## JavaScript

Before `</body>` element.

```html
<script src='./assets/js/croppie.js'></script>
<script src='./assets/js/vojtys.croppie.js'></script>
```


