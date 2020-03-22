<?php
namespace Vojtys\Forms\Croppie;

use Nette\Forms\Controls\BaseControl;
use Nette\Utils\Html;

/**
 * Class CroppieInput
 * @package Vojtys\Forms\Croppie
 */
class CroppieInput extends BaseControl
{
	/** @var Configuration $configuration */
	private $configuration;

	/** @var string $inputClass */
	private $inputClass = 'form-control';

	/** @var string $labelClass */
	private $labelClass = 'btn btn-primary btn-croppie mb-0';

	/**
	 * CroppieInput constructor.
	 * @param string|Object $caption
	 * @param Configuration $configuration
	 */
	public function __construct($caption, Configuration $configuration)
	{
		parent::__construct($caption);

		$this->configuration = $configuration;
	}

	/**
	 * @return Html|string|static
	 */
	public function getControl()
	{
		$control = Html::el('div');
		$control->addAttributes([
			'class' => 'croppie-wrapper',
		]);
		$preview = Html::el('div');
		$preview->addAttributes([
			'class' => 'croppie-preview',
			'data-vojtys-forms-croppie' => '',
			'data-settings' => $this->configuration->getConfiguration(),
			'data-result-size' => $this->configuration->getResultSize(),
		]);
		$hidden = Html::el('input');
		$hidden->addAttributes([
			'class' => 'croppie-value',
			'value' => '',
			'type' => 'hidden',
			'name' => $this->getHtmlName(),
			'id' => $this->getHtmlId(),
			'required' => $this->isRequired(),
			'disabled' => $this->isDisabled(),
		]);
		$input = Html::el('input');
		$input->addAttributes([
			'class' => $this->getInputClass(),
			'type' => 'file',
			'accept' => 'image/*',
			'value' => $this->caption
		]);
		$btn = Html::el('label');
		$btn->addAttributes([
			'class' => $this->getLabelClass(),
			'for' => $this->getHtmlId()
		]);
		$btn->addHtml(Html::el('span')->setText($this->caption));
		$btn->addHtml($input);

		$control->addHtml($preview);
		$control->addHtml($btn);
		$control->addHtml($hidden);

		return $control;
	}

	private function getLabelClass(): string
	{
		return 'btn-croppie ' . $this->labelClass;
	}

	public function setLabelClass(string $opt): void
	{
		$this->labelClass = $opt;
	}

	private function getInputClass(): string
	{
		return 'croppie-upload-btn ' . $this->inputClass;
	}

	public function setInputClass(string $opt): void
	{
		$this->inputClass = $opt;
	}

	public function setConfiguration(Configuration $configuration): void
	{
		$this->configuration = $configuration;
	}

	public function getValue():? Image
	{
		$image = new Image($this->value);

		return $image->getValue();
	}
}