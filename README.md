Foliotek/Croppie 
===============

Foliotek/Croppie control for Nette framework

# Install

```sh
$ composer require vojtys/croppie
```

# Configuration

## NEON - add extension

```yaml
extensions:
    croppie: Vojtys\Forms\Croppie\CroppieExtension

croppie:
    width: 300
    height: 300
```

# Usage

## Presenter/Control
```php

/**
 * @return Nette\Application\UI\Form
 */
public function createComponentTestForm()
{
    $form = new Nette\Application\UI\Form();
    $form->addCroppie('image', t('Vybrat obrázek z počítače'));
    $form->addHidden('width');
    $form->addHidden('height');
    $form->addHidden('error')->setDefaultValue(t('Nastala neočekávaná chyba'));
    $form->addSubmit('ok', t('Nahrát obrázek'))->getControlPrototype()->class('upload-btn');
    $form->onValidate[] = [$this, 'imageUploadValidation'];
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
<link rel="stylesheet" type="text/css" href="https://www.mydomain.com/vendor/vojtys/assets/css/croppie.css">
<link rel="stylesheet" type="text/css" href="https://www.mydomain.com/vendor/vojtys/assets/css/vojtys.croppie.css">
```

## JavaScript

Before `</body>` element.

```html
<script src='https://www.mydomain.com/vendor/vojtys/assets/js/croppie.js'></script>
<script src='https://www.mydomain.com/vendor/vojtys/assets/js/vojtys.croppie.js'></script>
```


