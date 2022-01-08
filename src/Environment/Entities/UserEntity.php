<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Environment\Entities;

/**
 * Represents a user entity.
 * @package codekandis\hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class UserEntity extends AbstractPersistableEntity implements UserEntityInterface
{
	/**
	 * Stores the ID.
	 * @var string
	 */
	public string $id = '';

	/**
	 * Stores whether the user is active or not.
	 * @var string
	 */
	public string $isActive = '';

	/**
	 * Stores the name.
	 * @var string
	 */
	public string $name = '';

	/**
	 * Stores the e-mail.
	 * @var string
	 */
	public string $eMail = '';

	/**
	 * Stores the password.
	 * @var string
	 */
	public string $password = '';

	/**
	 * {@inheritDoc}
	 */
	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setId( string $id ): void
	{
		$this->id = $id;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getIsActive(): string
	{
		return $this->isActive;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setIsActive( string $isActive ): void
	{
		$this->isActive = $isActive;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setName( string $name ): void
	{
		$this->name = $name;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getEMail(): string
	{
		return $this->eMail;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setEMail( string $eMail ): void
	{
		$this->eMail = $eMail;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getPassword(): string
	{
		return $this->password;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setPassword( string $password ): void
	{
		$this->password = $password;
	}
}
