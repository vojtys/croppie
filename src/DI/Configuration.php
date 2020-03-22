<?php
namespace Vojtys\Forms\Croppie;

/**
 * Class Configuration
 * @package Vojtys\Forms\Croppie
 */
class Configuration
{
	public const TYPE_CIRCLE = 'circle';
	public const TYPE_SQUARE = 'square';
	public const TYPE_SIZE_VIEWPORT = 'viewport';
	public const TYPE_SIZE_ORIGINAL = 'original';

	public const BOUNDARY = 100;

	public const CONF_EXIF = 'enableExif';
	public const CONF_VIEWPORT_WIDTH = 'width';
	public const CONF_VIEWPORT_HEIGHT = 'height';
	public const CONF_TYPE = 'type';
	public const CONF_RESULT_SIZE = 'size';

	/** array $params */
	private $params;

	/** @var int $boundary */
	private $boundary = self::BOUNDARY;

	public function __construct(array $params = [])
	{
		$this->params = $params;
	}

	public function getConfiguration()
	{
		return [
			'viewport' => [
				self::CONF_VIEWPORT_WIDTH => $this->getWidth(),
				self::CONF_VIEWPORT_HEIGHT => $this->getHeight(),
				self::CONF_TYPE => $this->getType(),
			],
			'boundary' => [
				self::CONF_VIEWPORT_WIDTH => ($this->getWidth() + $this->getBoundary()),
				self::CONF_VIEWPORT_HEIGHT => ($this->getHeight() + $this->getBoundary()),
			]
		];
	}

	public function toArray(): array
	{
		return [
			self::CONF_VIEWPORT_WIDTH => $this->getWidth(),
			self::CONF_VIEWPORT_HEIGHT => $this->getHeight(),
			self::CONF_TYPE => $this->getType(),
			self::CONF_EXIF => $this->getExif(),
			self::CONF_RESULT_SIZE => $this->getResultSize(),
		];
	}

	public function getWidth():? int
	{
		return $this->params[ self::CONF_VIEWPORT_WIDTH ] ?? null;
	}

	public function setWidth(int $opt): void
	{
		$this->params[ self::CONF_VIEWPORT_WIDTH] = $opt;
	}

	public function getHeight():? int
	{
		return $this->params[ self::CONF_VIEWPORT_HEIGHT ] ?? null;
	}

	public function setHeight(int $opt): void
	{
		$this->params[ self::CONF_VIEWPORT_HEIGHT] = $opt;
	}

	public function getType():? string
	{
		return $this->params[ self::CONF_TYPE ] ?? null;
	}

	public function setType(string $opt): void
	{
		$this->params[self::CONF_TYPE] = $opt;
	}

	public function setTypeCircle(): void
	{
		$this->params[self::CONF_TYPE] = self::TYPE_CIRCLE;
	}

	public function setTypeSquare(): void
	{
		$this->params[self::CONF_TYPE] = self::TYPE_SQUARE;
	}

	public function getBoundary(): int
	{
		return $this->boundary;
	}

	public function setBoundary(int $boundary): void
	{
		$this->boundary = $boundary;
	}

	public function getResultSize():? string
	{
		return $this->params[ self::CONF_RESULT_SIZE ] ?? null;
	}

	public function setResultSize(string $opt): void
	{
		$this->params[self::CONF_RESULT_SIZE] = $opt;
	}

	public function getExif():? string
	{
		return $this->params[ self::CONF_EXIF ] ?? null;
	}
}