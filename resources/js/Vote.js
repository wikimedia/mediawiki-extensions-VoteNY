/**
 * JavaScript functions for Vote extension.
 *
 * TODO: Should refactor this into a jQuery widget.
 * The widget should get a PageID in its constructor so it can work on any page
 * for any page and with multiple instances per page.
 *
 * @constructor
 *
 * @author Jack Phoenix
 * @author Daniel A. R. Werner < daniel.a.r.werner@gmail.com >
 */
const VoteNY = function VoteNY() {
	this.MaxRating = 5;
	this.clearRatingTimer = null;
	this.voted_new = [];
	this.id = 0;
	this.last_id = 0;
	this.imagePath = mw.config.get( 'wgExtensionAssetsPath' ) + '/VoteNY/resources/images/';

	/**
	 * Called when voting through the green square voting box
	 *
	 * @param TheVote
	 * @param PageID Integer: internal ID number of the current article
	 */
	this.clickVote = function ( TheVote, PageID ) {
		( new mw.Api() ).postWithToken( 'csrf', {
			action: 'voteny',
			format: 'json',
			what: 'vote',
			pageId: PageID,
			voteValue: TheVote
		} ).done( ( data ) => {
			$( '#PollVotes' ).html( data.voteny.result );
			$( '#Answer' ).html(
				'<a href="javascript:void(0);" class="vote-unvote-link">' +
				mediaWiki.msg( 'voteny-unvote-link' ) + '</a>'
			);
		} );
	};

	/**
	 * Called when removing your vote through the green square voting box
	 *
	 * @param PageID Integer: internal ID number of the current article
	 */
	this.unVote = function ( PageID ) {
		( new mw.Api() ).postWithToken( 'csrf', {
			action: 'voteny',
			format: 'json',
			what: 'delete',
			pageId: PageID
		} ).done( ( data ) => {
			$( '#PollVotes' ).html( data.voteny.result );
			$( '#Answer' ).html(
				'<a href="javascript:void(0);" class="vote-vote-link">' +
				mediaWiki.msg( 'voteny-link' ) + '</a>'
			);
		} );
	};

	/**
	 * Called when adding a vote after a user has clicked the yellow voting stars
	 *
	 * @param TheVote
	 * @param PageID Integer: internal ID number of the current article
	 * @param id Integer: ID of the current rating star
	 * @param action Integer: controls which AJAX function will be called
	 */
	this.clickVoteStars = function ( TheVote, PageID, id, action ) {
		this.voted_new[ id ] = TheVote;
		let actionName;
		if ( action == 3 ) {
			actionName = 'stars'; // all other values but 'multi' are ignored anyway
		}
		if ( action == 5 ) {
			actionName = 'multi';
		}

		( new mw.Api() ).postWithToken( 'csrf', {
			action: 'voteny',
			type: 'stars',
			what: actionName,
			voteValue: TheVote,
			pageId: PageID
		} ).done( ( data ) => {
			$( '#rating_' + id ).html( data.voteny.result );
		} );
	};

	/**
	 * Called when removing your vote through the yellow voting stars
	 *
	 * @param PageID Integer: internal ID number of the current article
	 * @param id Integer: ID of the current rating star
	 */
	this.unVoteStars = function ( PageID, id ) {
		( new mw.Api() ).postWithToken( 'csrf', {
			action: 'voteny',
			what: 'delete',
			type: 'stars',
			pageId: PageID
		} ).done( ( data ) => {
			$( '#rating_' + id ).html( data.voteny.result );
		} );
	};

	this.startClearRating = function ( id, rating, voted ) {
		const voteNY = this;
		this.clearRatingTimer = setTimeout( () => {
			voteNY.clearRating( id, 0, rating, voted );
		}, 200 );
	};

	this.clearRating = function ( id, num, prev_rating, voted ) {
		if ( this.voted_new[ id ] ) {
			voted = this.voted_new[ id ];
		}

		for ( let x = 1; x <= this.MaxRating; x++ ) {
			let old_rating = voted || prev_rating,
				star = 'off';

			if ( voted ) {
				star = 'voted';
			} else if ( !num && old_rating >= x ) {
				star = 'on';
			} else if ( !num && x == Math.ceil( old_rating ) ) {
				star = 'half';
			}

			$( '#rating_' + id + '_' + x )
				.attr( 'src', this.imagePath + 'star_' + star + '.gif' );
		}
	};

	this.updateRating = function ( id, num, prev_rating ) {
		if ( this.clearRatingTimer && this.last_id == id ) {
			clearTimeout( this.clearRatingTimer );
		}
		this.clearRating( id, num, prev_rating );
		for ( let x = 1; x <= num; x++ ) {
			$( '#rating_' + id + '_' + x ).attr( 'src', this.imagePath + 'star_voted.gif' );
		}
		this.last_id = id;
	};
};

// TODO: Make event handlers part of a widget as described in the VoteNY's TODO and reduce this
//       code to instantiating such a widget for the current wiki page if required.
$( () => {
	const vote = new VoteNY();

	// Green voting box's link
	$( '.vote-action' ).on( 'click', '> a', function ( event ) {
		if ( $( this ).hasClass( 'vote-unvote-link' ) ) {
			vote.unVote( mw.config.get( 'wgArticleId' ) );
		} else {
			vote.clickVote( 1, mw.config.get( 'wgArticleId' ) );
		}
	} );

	// Rating stars
	// Note: this uses $( 'body' ).on( 'actionName', 'selector'
	// instead of $( 'selector' ).actionName so that the hover effects work
	// correctly even *after* you've voted (say, if you wanted to change your
	// vote with the star ratings without reloading the page).
	$( 'body' ).on( 'click', '.vote-rating-star', function () {
		const that = $( this );
		vote.clickVoteStars(
			that.data( 'vote-the-vote' ),
			$( this ).data( 'page-id' ),
			that.data( 'vote-id' ),
			that.data( 'vote-action' )
		);
	} ).on( 'mouseover', '.vote-rating-star', function () {
		const that = $( this );
		vote.updateRating(
			that.data( 'vote-id' ),
			that.data( 'vote-the-vote' ),
			that.data( 'vote-rating' )
		);
	} ).on( 'mouseout', '.vote-rating-star', function () {
		const that = $( this );
		vote.startClearRating(
			that.data( 'vote-id' ),
			that.data( 'vote-rating' ),
			that.data( 'vote-voted' )
		);
	} );

	// Remove vote (rating stars)
	$( 'body' ).on( 'click', '.vote-remove-stars-link', function () {
		vote.unVoteStars(
			$( this ).data( 'page-id' ),
			$( this ).data( 'vote-id' )
		);
	} );
} );
