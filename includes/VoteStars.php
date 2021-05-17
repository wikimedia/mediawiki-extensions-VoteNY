<?php
/**
 * Class for generating star rating stars.
 */
class VoteStars extends Vote {

	/** @var int */
	public $maxRating = 5;

	/**
	 * Displays voting stars
	 *
	 * @param bool $voted Has the user already voted? False by default
	 * @return string HTML output
	 */
	function display( $voted = false ) {
		$overall_rating = $this->getAverageVote();

		if ( $voted ) {
			$display_stars_rating = $voted;
		} else {
			$display_stars_rating = $this->getAverageVote();
		}

		$id = $this->PageID;

		$output = '<div id="rating_' . $id . '">';
		$output .= '<div class="rating-score">';
		$output .= '<div class="voteboxrate">' . $overall_rating . '</div>';
		$output .= '</div>';
		$output .= '<div class="rating-section">';
		$output .= $this->displayStars( $id, (int)$display_stars_rating, $voted );
		$count = $this->count();
		if ( isset( $count ) ) {
			$output .= ' <span class="rating-total">(' .
				wfMessage( 'voteny-votes', $count )->parse() . ')</span>';
		}
		$already_voted = $this->hasUserAlreadyVoted();
		if ( $already_voted && $this->User->isRegistered() ) {
			$output .= '<div class="rating-voted">' .
				wfMessage( 'voteny-gave-this', $already_voted )->parse() .
			" </div>
			<a href=\"javascript:void(0);\" class=\"vote-remove-stars-link\" data-page-id=\"{$this->PageID}\" data-vote-id=\"{$id}\">("
				. wfMessage( 'voteny-remove' )->escaped() .
			')</a>';
		}
		$output .= '</div>
				<div class="rating-clear">
			</div>';

		$output .= '</div>';
		return $output;
	}

	/**
	 * Displays the actual star images, depending on the state of the user's mouse
	 *
	 * @param int $id ID of the rating (div) element
	 * @param int $rating Average rating
	 * @param int|bool $voted
	 * @return string Generated <img> tag
	 */
	function displayStars( $id, $rating, $voted ) {
		global $wgExtensionAssetsPath;

		if ( !$rating ) {
			$rating = 0;
		}
		if ( !$voted ) {
			$voted = 0;
		}
		$output = '';

		for ( $x = 1; $x <= $this->maxRating; $x++ ) {
			if ( !$id ) {
				$action = 3;
			} else {
				$action = 5;
			}
			$output .= "<img class=\"vote-rating-star\" data-vote-the-vote=\"{$x}\"" .
				" data-page-id=\"{$this->PageID}\"" .
				" data-vote-id=\"{$id}\" data-vote-action=\"{$action}\" data-vote-rating=\"{$rating}\"" .
				" data-vote-voted=\"{$voted}\" id=\"rating_{$id}_{$x}\"" .
				" src=\"{$wgExtensionAssetsPath}/VoteNY/resources/images/star_";
			switch ( true ) {
				case $rating >= $x:
					if ( $voted ) {
						$output .= 'voted';
					} else {
						$output .= 'on';
					}
					break;
				case ( $rating > 0 && $rating < $x && $rating > ( $x - 1 ) ):
					$output .= 'half';
					break;
				case ( $rating < $x ):
					$output .= 'off';
					break;
			}

			$output .= '.gif" alt="" />';
		}

		return $output;
	}

	/**
	 * Displays the average score for the current page
	 * and the total amount of votes.
	 *
	 * @return string
	 */
	function displayScore() {
		$count = $this->count();
		return wfMessage( 'voteny-community-score', $this->getAverageVote() )
			->numParams( $count )->parse() .
			' (' . wfMessage( 'voteny-ratings' )->numParams( $count )->parse() . ')';
	}

}
