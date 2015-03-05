/**
 * JavaScript functions for Vote extension.
 *
 * TODO: Should refactor this into a jQuery widget. The widget should get a PageID in its
 *       constructor so it can work on any page for any page and with multiple instances per page.
 *
 * @constructor
 *
 * @author Jack Phoenix <jack@countervandalism.net>
 * @author Daniel A. R. Werner < daniel.a.r.werner@gmail.com >
 */
var VoteNY = function VoteNY() {
	this.MaxRating = 5;
	this.clearRatingTimer = null;
	this.voted_new = [];
	this.id = 0;
	this.last_id = 0;
	this.imagePath = mw.config.get( 'wgExtensionAssetsPath' ) + '/VoteNY/images/';

	/**
	 * Called when voting through the green square voting box
	 *
	 * @param TheVote
	 * @param PageID Integer: internal ID number of the current article
	 */
	this.clickVote = function( TheVote, PageID ) {
		sajax_request_type = 'POST';
		sajax_do_call( 'wfVoteClick', [ TheVote, PageID ], function( request ) {
			document.getElementById( 'PollVotes' ).innerHTML = request.responseText;
			document.getElementById( 'Answer' ).innerHTML =
				'<a href="javascript:void(0);" class="vote-unvote-link">' +
				mediaWiki.msg( 'voteny-unvote-link' ) + '</a>';
		} );
	};

	/**
	 * Called when removing your vote through the green square voting box
	 *
	 * @param PageID Integer: internal ID number of the current article
	 * @param mk Mixed: random token
	 */
	this.unVote = function( PageID ) {
		sajax_request_type = 'POST';
		sajax_do_call( 'wfVoteDelete', [ PageID ], function( request ) {
			document.getElementById( 'PollVotes' ).innerHTML = request.responseText;
			document.getElementById( 'Answer' ).innerHTML =
				'<a href="javascript:void(0);" class="vote-vote-link">' +
				mediaWiki.msg( 'voteny-link' ) + '</a>';
		} );
	};

	/**
	 * Called when adding a vote after a user has clicked the yellow voting stars
	 *
	 * @param PageID Integer: internal ID number of the current article
	 * @param id Integer: ID of the current rating star
	 * @param action Integer: controls which AJAX function will be called
	 */
	this.clickVoteStars = function( TheVote, PageID, id, action ) {
		this.voted_new[id] = TheVote;
		var rsfun;
		if( action == 3 ) {
			rsfun = 'wfVoteStars';
		}
		if( action == 5 ) {
			rsfun = 'wfVoteStarsMulti';
		}

		var resultElement = document.getElementById( 'rating_' + id );
		sajax_request_type = 'POST';
		sajax_do_call( rsfun, [ TheVote, PageID ], resultElement );
	};

	/**
	 * Called when removing your vote through the yellow voting stars
	 *
	 * @param PageID Integer: internal ID number of the current article
	 * @param id Integer: ID of the current rating star
	 */
	this.unVoteStars = function( PageID, id ) {
		var resultElement = document.getElementById( 'rating_' + id );
		sajax_request_type = 'POST';
		sajax_do_call( 'wfVoteStarsDelete', [ PageID ], resultElement );
	};

	this.startClearRating = function( id, rating, voted ) {
		this.clearRatingTimer = setTimeout( function() {
			this.clearRating( id, 0, rating, voted );
		}, 200 );
	};

	this.clearRating = function( id, num, prev_rating, voted ) {
		if( this.voted_new[id] ) {
			voted = this.voted_new[id];
		}

		for( var x = 1; x <= this.MaxRating; x++ ) {
			var star_on, old_rating;
			if( voted ) {
				star_on = 'voted';
				old_rating = voted;
			} else {
				star_on = 'on';
				old_rating = prev_rating;
			}
			var ratingElement = document.getElementById( 'rating_' + id + '_' + x );
			if( !num && old_rating >= x ) {
				ratingElement.src = this.imagePath + 'star_' + star_on + '.gif';
			} else {
				ratingElement.src = this.imagePath + 'star_off.gif';
			}
		}
	};

	this.updateRating = function( id, num, prev_rating ) {
		if( this.clearRatingTimer && this.last_id == id ) {
			clearTimeout( this.clearRatingTimer );
		}
		this.clearRating( id, num, prev_rating );
		for( var x = 1; x <= num; x++ ) {
			document.getElementById( 'rating_' + id + '_' + x ).src = this.imagePath + 'star_voted.gif';
		}
		this.last_id = id;
	};
};

// TODO:Mmake event handlers part of a widget as described in the VoteNY's TODO and reduce this
//       code to instantiating such a widget for the current wiki page if required.
jQuery( document ).ready( function() {
	var vote = new VoteNY();

	// Green voting box's link
	jQuery( '.vote-action' ).on( 'click', '> a', function( event ) {
		if( jQuery( this ).hasClass( 'vote-unvote-link' ) ) {
			vote.unVote( mw.config.get( 'wgArticleId' ) );
		} else {
			vote.clickVote( 1, mw.config.get( 'wgArticleId' ) );
		}
	} );

	// Rating stars
	jQuery( 'img.vote-rating-star' ).click( function() {
		var that = jQuery( this );
		vote.clickVoteStars(
			that.data( 'vote-the-vote' ),
			mw.config.get( 'wgArticleId' ),
			that.data( 'vote-id' ),
			that.data( 'vote-action' )
		);
	} ).mouseover( function() {
		var that = jQuery( this );
		vote.updateRating(
			that.data( 'vote-id' ),
			that.data( 'vote-the-vote' ),
			that.data( 'vote-rating' )
		);
	} ).mouseout( function() {
		var that = jQuery( this );
		vote.startClearRating(
			that.data( 'vote-id' ),
			that.data( 'vote-rating' ),
			that.data( 'vote-voted' )
		);
	} );

	// Remove vote (rating stars)
	jQuery( 'a.vote-remove-stars-link' ).click( function() {
		vote.unVoteStars(
			mw.config.get( 'wgArticleId' ),
			jQuery( this ).data( 'vote-id' )
		);
	} );
} );
