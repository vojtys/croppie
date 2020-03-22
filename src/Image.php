<?php
namespace Vojtys\Forms\Croppie;

use Nette;

/**
 * Class Image
 * @package Vojtys\Forms\Croppie
 */
class Image
{
	/** @var array $data */
	protected $data;

	/** @var Nette\Utils\Image $image */
	protected $image;


	public function __construct(string $data)
	{
		$this->data = $this->jsonDecode($data);
		$this->image = $this->createImage();
	}

	public function getValue():? Image
	{
		return empty($this->getNetteImage()) ? null : $this;
	}

	public function getNetteImage():? Nette\Utils\Image
	{
		return $this->image ?? null;
	}

	public function getName():? string
	{
		return $this->data['fileinfo']['name'] ?? null;
	}

	public function getType():? string
	{
		return $this->data['fileinfo']['type'] ?? null;
	}

	private function createImage():? Nette\Utils\Image
	{
		if (empty($this->data)) {
			return null;
		}

		try {
			$imageData = $this->data['image'];
			list($type, $imageData) = explode(';', $imageData);
			list(, $imageData) = explode(',', $imageData);
			$image = Nette\Utils\Image::fromString(base64_decode($imageData));
		} catch (Nette\Utils\ImageException $e) {

			return null;
		}

		return $image;
	}

	private function jsonDecode($rawData):? array
	{
		try {
			$data = Nette\Utils\Json::decode($rawData, \Nette\Utils\Json::FORCE_ARRAY);
		} catch (Nette\Utils\JsonException $e) {

			return null;
		}

		return $data;
	}
}