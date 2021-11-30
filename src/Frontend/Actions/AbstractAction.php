<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Actions;

use CodeKandis\HotDoc\Configurations\FrontendConfigurationRegistry;
use CodeKandis\HotDoc\Configurations\FrontendConfigurationRegistryInterface;
use CodeKandis\HotDoc\Frontend\Errors\CommonErrorCodes;
use CodeKandis\HotDoc\Frontend\Errors\CommonErrorMessages;
use CodeKandis\Tiphy\Actions\AbstractAction as OriginAbstractAction;
use CodeKandis\Tiphy\Data\ArrayAccessor;
use CodeKandis\Tiphy\Data\ArrayAccessorInterface;
use CodeKandis\Tiphy\Http\Requests\BadRequestException;

/**
 * Represents the base class of all actions.
 * @package medialogistik/advent-order-processor
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class AbstractAction extends OriginAbstractAction
{
	/**
	 * Stores the input data of the action.
	 * @var ArrayAccessorInterface
	 */
	private ArrayAccessorInterface $inputData;

	/**
	 * Stores the frontend configuration registry of the action.
	 * @var FrontendConfigurationRegistryInterface
	 */
	private FrontendConfigurationRegistryInterface $frontendConfigurationRegistry;

	/**
	 * Gets the input data of the request.
	 * @param string[] $requiredKeys The required object keys of the JSON body.
	 * @return ArrayAccessorInterface The input data of the request.
	 * @throws BadRequestException The request content type is invalid.
	 * @throws BadRequestException The request body is malformed.
	 * @throws BadRequestException The request body is malformed.
	 * @throws BadRequestException The request body is invalid.
	 */
	protected function getInputData( array $requiredKeys = [] ): ArrayAccessorInterface
	{
		if ( true === isset( $this->inputData ) )
		{
			return $this->inputData;
		}

		$requestPostData = new ArrayAccessor( $_GET );

		$isValid         = true;
		$requestData     = [];
		foreach ( $requiredKeys as $requiredKey )
		{
			$isValid = $isValid && true === isset( $requestPostData[ $requiredKey ] );
			if ( false === $isValid )
			{
				break;
			}
			$requestData[ $requiredKey ] = $requestPostData[ $requiredKey ];
		}
		if ( false === $isValid )
		{
			throw new BadRequestException( CommonErrorMessages::INVALID_REQUEST_BODY, CommonErrorCodes::INVALID_REQUEST_BODY );
		}

		$inputData = $requestData + $this->arguments;

		return $this->inputData = new ArrayAccessor( $inputData );
	}

	/**
	 * Gets the frontend configuration registry.
	 * @return FrontendConfigurationRegistryInterface The frontend configuration registry.
	 */
	protected function getFrontendConfigurationRegistry(): FrontendConfigurationRegistryInterface
	{
		return $this->frontendConfigurationRegistry
			   ?? $this->frontendConfigurationRegistry = FrontendConfigurationRegistry::_();
	}
}
