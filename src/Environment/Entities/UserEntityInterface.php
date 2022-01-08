<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Environment\Entities;

/**
 * Represents the interface of any user entity.
 * @package codekandis\hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
interface UserEntityInterface extends EntityInterface
{
	/**
	 * Gets whether the user is active or not.
	 * @return string 1 if the user is active, otherwise 0.
	 */
	public function getIsActive(): string;

	/**
	 * Sets whether the user is active or not.
	 * @param string $isActive 1 if the user is active, otherwise 0.
	 */
	public function setIsActive( string $isActive ): void;

	/**
	 * Gets the name.
	 * @return string The name.
	 */
	public function getName(): string;

	/**
	 * Sets the name.
	 * @param string $name The name.
	 */
	public function setName( string $name ): void;

	/**
	 * Gets the e-mail.
	 * @return string The e-mail.
	 */
	public function getEMail(): string;

	/**
	 * Sets the e-mail.
	 * @param string The e-mail.
	 */
	public function setEMail( string $eMail ): void;

	/**
	 * Gets the password.
	 * @return string The password.
	 */
	public function getPassword(): string;

	/**
	 * Sets the password.
	 * @param string The password.
	 */
	public function setPassword( string $password ): void;
}
