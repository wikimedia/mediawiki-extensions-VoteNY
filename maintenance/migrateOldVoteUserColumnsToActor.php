<?php
/**
 * @file
 * @ingroup Maintenance
 */
$IP = getenv( 'MW_INSTALL_PATH' );
if ( $IP === false ) {
	$IP = __DIR__ . '/../../..';
}
require_once "$IP/maintenance/Maintenance.php";

/**
 * Run automatically with update.php
 *
 * @since May 2020
 */
class MigrateOldVoteUserColumnsToActor extends LoggedUpdateMaintenance {
	public function __construct() {
		parent::__construct();
		// @codingStandardsIgnoreLine
		$this->addDescription( 'Migrates data from old vote_user_id column in the Vote table to the new actor columns.' );
	}

	/**
	 * Get the update key name to go in the update log table
	 *
	 * @return string
	 */
	protected function getUpdateKey() {
		return __CLASS__;
	}

	/**
	 * Message to show that the update was done already and was just skipped
	 *
	 * @return string
	 */
	protected function updateSkippedMessage() {
		return 'Vote has already been migrated to use the actor columns.';
	}

	/**
	 * Do the actual work.
	 *
	 * @return bool True to log the update as done
	 */
	protected function doDBUpdates() {
		$dbw = $this->getDB( DB_MASTER );

		$res = $dbw->select(
			'Vote',
			[
				'vote_user_id'
			],
			'',
			__METHOD__,
			[ 'DISTINCT' ]
		);
		foreach ( $res as $row ) {
			$user = User::newFromId( $row->vote_user_id );
			// We check that the id does not equal 0 because
			// if a wiki has already migrated, new entries will have 0.
			if ( $user->getId() != 0 ) {
				$dbw->update(
					'Vote',
					[
						'vote_actor' => $user->getActorId( $dbw )
					],
					[
						'vote_user_id' => $row->vote_user_id
					],
					__METHOD__
				);
			}
		}

		return true;
	}
}

$maintClass = MigrateOldVoteUserColumnsToActor::class;
require_once RUN_MAINTENANCE_IF_MAIN;
