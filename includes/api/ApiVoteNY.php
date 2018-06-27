<?php
/**
 * VoteNY API module
 *
 * @file
 * @ingroup API
 * @date 21 November 2015
 * @see https://www.mediawiki.org/wiki/API:Extensions#ApiSampleApiExtension.php
 */
class ApiVoteNY extends ApiBase {

	/**
	 * @var Vote|VoteStars Instance of the Vote or VoteStars class, set in execute() below
	 */
	private $vote;

	/**
	 * Main entry point.
	 */
	public function execute() {
		$user = $this->getUser();

		// Get the request parameters
		$params = $this->extractRequestParams();

		$action = $params['what'];

		// If the "what" param isn't present, we don't know what to do!
		if ( !$action || $action === null ) {
			$this->dieUsageMsg( 'missingparam' );
		}

		// Need to have sufficient user rights to proceed...
		if ( !$user->isAllowed( 'voteny' ) ) {
			$this->dieUsageMsg( 'badaccess-group0' );
		}

		// Ensure that the page ID is present and that it really is numeric
		$pageId = $params['pageId'];

		if ( !$pageId || $pageId === null || !is_numeric( $pageId ) ) {
			$this->dieUsageMsg( [ 'missingparam', 'pageId' ] );
		}

		// Vote value is needed for actual vote actions, i.e. everything but "delete"
		$voteValue = $params['voteValue'];

		if ( !( $voteValue || $voteValue === null ) && $action !== 'delete' ) {
			$this->dieUsageMsg( [ 'missingparam', 'voteValue' ] );
		}

		// Set the private class member variable and do something...
		if ( isset( $params['type'] ) && $params['type'] && $params['type'] == 'stars' ) {
			$this->vote = new VoteStars( $pageId );

			switch ( $action ) {
				case 'delete':
					$this->vote->delete();
					$output = $this->vote->display();
					break;
				case 'multi':
					if ( $this->vote->UserAlreadyVoted() ) {
						$this->vote->delete();
					}
					$this->vote->insert( $voteValue );
					$output = $this->vote->displayScore();
					break;
				case 'vote':
				default:
					if ( $this->vote->UserAlreadyVoted() ) {
						$this->vote->delete();
					}
					$this->vote->insert( $voteValue );
					$output = $this->vote->display( $voteValue );
					break;
			}
		} else {
			$this->vote = new Vote( $pageId );

			switch ( $action ) {
				case 'delete':
					$this->vote->delete();
					$output = $this->vote->count( 1 );
					break;
				case 'vote':
				default:
					$this->vote->insert( $voteValue );
					$output = $this->vote->count( 1 );
					break;
			}
		}

		// Top level
		$this->getResult()->addValue( null, $this->getModuleName(),
			[ 'result' => $output ]
		);

		return true;
	}

	public function needsToken() {
		return 'csrf';
	}

	public function isWriteMode() {
		return true;
	}

	/**
	 * @return array
	 */
	public function getAllowedParams() {
		return [
			'what' => [
				ApiBase::PARAM_TYPE => 'string',
				ApiBase::PARAM_REQUIRED => true
			],
			'pageId' => [
				ApiBase::PARAM_TYPE => 'integer',
				ApiBase::PARAM_REQUIRED => true
			],
			'voteValue' => [
				ApiBase::PARAM_TYPE => 'integer',
			],
			'type' => [
				ApiBase::PARAM_TYPE => 'string',
			]
		];
	}

	/**
	 * @see ApiBase::getExamplesMessages()
	 */
	protected function getExamplesMessages() {
		return [
			'action=voteny&what=vote&pageId=666' => 'apihelp-voteny-example-1',
			'action=voteny&what=delete&pageId=666' => 'apihelp-voteny-example-2',
			'action=voteny&what=vote&type=stars&pageId=666&voteValue=3' => 'apihelp-voteny-example-3',
			'action=voteny&what=delete&type=stars&pageId=666' => 'apihelp-voteny-example-4',
			'action=voteny&what=multi&type=stars&pageId=666&voteValue=4' => 'apihelp-voteny-example-5'
		];
	}
}
