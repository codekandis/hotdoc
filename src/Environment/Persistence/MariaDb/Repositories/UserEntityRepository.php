<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Environment\Persistence\MariaDb\Repositories;

use CodeKandis\Persistence\FetchingResultFailedException;
use CodeKandis\Persistence\Repositories\AbstractRepository;
use CodeKandis\Persistence\SettingFetchModeFailedException;
use CodeKandis\Persistence\StatementExecutionFailedException;
use CodeKandis\Persistence\StatementPreparationFailedException;
use CodeKandis\Persistence\TransactionCommitFailedException;
use CodeKandis\Persistence\TransactionRollbackFailedException;
use CodeKandis\Persistence\TransactionStartFailedException;
use CodeKandis\HotDoc\Environment\Entities\EntityPropertyMappings\EntityPropertyMapperBuilder;
use CodeKandis\HotDoc\Environment\Entities\UserEntityInterface;
use ReflectionException;

/**
 * Represents the MariaDB repository for the user entity.
 * @package codekandis\hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class UserEntityRepository extends AbstractRepository implements UserEntityRepositoryInterface
{
	/**
	 * @throws ReflectionException The user entity class to reflect does not exist.
	 * @throws TransactionStartFailedException The transaction failed to start.
	 * @throws TransactionRollbackFailedException The transaction failed to roll back.
	 * @throws TransactionCommitFailedException The transaction failed to commit.
	 * @throws StatementPreparationFailedException The preparation of the statement failed.
	 * @throws StatementExecutionFailedException The execution of the statement failed.
	 * @throws SettingFetchModeFailedException The setting of the fetch mode of the statement failed.
	 * @throws FetchingResultFailedException The fetching of the statment result failed.
	 */
	public function readUserByEMail( UserEntityInterface $user ): ?UserEntityInterface
	{
		$query = <<< END
			SELECT
				`users`.`id`,
				`users`.`isActive`,
				`users`.`name`,
				`users`.`eMail`,
			    `users`.`password`
			FROM
				`users`
			WHERE
				`users`.`eMail` = :eMail
			LIMIT
				0, 1;
		END;

		$userEntityPropertyMapper = ( new EntityPropertyMapperBuilder() )
			->buildUserEntityPropertyMapper();
		$mappedUser               = $userEntityPropertyMapper->mapToArray( $user );
		$arguments                = [
			'eMail' => $mappedUser[ 'eMail' ]
		];

		return $this->databaseConnector->queryFirst( $query, $arguments, $userEntityPropertyMapper );
	}
}
