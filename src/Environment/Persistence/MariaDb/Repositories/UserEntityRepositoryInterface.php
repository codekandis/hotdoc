<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Environment\Persistence\MariaDb\Repositories;

use CodeKandis\HotDoc\Environment\Entities\UserEntityInterface;

/**
 * Represents the interface of all repositories for the user entity.
 * @package codekandis\hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
interface UserEntityRepositoryInterface
{
	/**
	 * Reads an user by its e-mail.
	 * @return UserEntityInterface The read user.
	 */
	public function readUserByEMail( UserEntityInterface $user ): ?UserEntityInterface;
}
