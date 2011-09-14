/**
 * JavaScript functions for Vote extension
 *
 * @file
 * @ingroup Extensions
 * @author Jack Phoenix <jack@countervandalism.net>
 * @date 19 June 2011
 */
var VoteNY = {
	MaxRating: 5,
	clearRatingTimer: '',
	voted_new: [],
	id: 0,
	last_id: 0,
	imagePath: wgScriptPath + '/extensions/VoteNY/images/',

	/**
	 * Called when voting through the green square voting box
	 * @param TheVote
	 * @param PageID Integer: internal ID number of the current article
	 * @param mk Mixed: random token
	 */
	clickVote: function( TheVote, PageID, mk ) {
		sajax_request_type = 'POST';
		sajax_do_call( 'wfVoteClick', [ TheVote, PageID, mk ], function( request ) {
			document.getElementById( 'votebox' ).style.cursor = 'default';
			document.getElementById( 'PollVotes' ).innerHTML = request.responseText;
			var unvoteMessage;
			if ( typeof( mediaWiki ) == 'undefined' ) {
				unvoteMessage = _UNVOTE_LINK;
			} else {
				unvoteMessage = mediaWiki.msg( 'vote-unvote-link' );
			}
			document.getElementById( 'Answer' ).innerHTML =
				"<a href=javascript:VoteNY.unVote(" + PageID + ",'" + mk +
				"')>" + unvoteMessage + '</a>';
		} );
	},

	/**
	 * Called when removing your vote through the green square voting box
	 * @param PageID Integer: internal ID number of the current article
	 * @param mk Mixed: random token
	 */
	unVote: function( PageID, mk ) {
		sajax_request_type = 'POST';
		sajax_do_call( 'wfVoteDelete', [ PageID, mk ], function( request ) {
			document.getElementById( 'votebox' ).style.cursor = 'pointer';
			document.getElementById( 'PollVotes' ).innerHTML = request.responseText;
			var voteMessage;
			if ( typeof( mediaWiki ) == 'undefined' ) {
				voteMessage = _VOTE_LINK;
			} else {
				voteMessage = mediaWiki.msg( 'vote-link' );
			}
			document.getElementById( 'Answer' ).innerHTML =
				'<a href=javascript:VoteNY.clickVote(1,' + PageID + ',"' + mk +
				'")>' + voteMessage + '</a>';
		} );
	},

	/**
	 * Called when adding a vote after a user has clicked the yellow voting stars
	 * @param PageID Integer: internal ID number of the current article
	 * @param mk Mixed: random token
	 * @param id Integer: ID of the current rating star
	 * @param action Integer: controls which AJAX function will be called
	 */
	clickVoteStars: function( TheVote, PageID, mk, id, action ) {
		VoteNY.voted_new[id] = TheVote;
		var rsfun;
		if( action == 3 ) {
			rsfun = 'wfVoteStars';
		}
		if( action == 5 ) {
			rsfun = 'wfVoteStarsMulti';
		}

		var resultElement = document.getElementById( 'rating_' + id );
		sajax_request_type = 'POST';
		sajax_do_call( rsfun, [ TheVote, PageID, mk ], resultElement );
	},

	/**
	 * Called when removing your vote through the yellow voting stars
	 * @param PageID Integer: internal ID number of the current article
	 * @param mk Mixed: random token
	 * @param id Integer: ID of the current rating star
	 */
	unVoteStars: function( PageID, mk, id ) {
		var resultElement = document.getElementById( 'rating_' + id );
		sajax_request_type = 'POST';
		sajax_do_call( 'wfVoteStarsDelete', [ PageID, mk ], resultElement );
	},

	startClearRating: function( id, rating, voted ) {
		VoteNY.clearRatingTimer = setTimeout(
			"VoteNY.clearRating('" + id + "',0," + rating + ',' + voted + ')',
			200
		);
	},

	clearRating: function( id, num, prev_rating, voted ) {
		if( VoteNY.voted_new[id] ) {
			voted = VoteNY.voted_new[id];
		}

		for( var x = 1; x <= VoteNY.MaxRating; x++ ) {
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
				ratingElement.src = VoteNY.imagePath + 'star_' + star_on + '.gif';
			} else {
				ratingElement.src = VoteNY.imagePath + 'star_off.gif';
			}
		}
	},

	updateRating: function( id, num, prev_rating ) {
		if( VoteNY.clearRatingTimer && VoteNY.last_id == id ) {
			clearTimeout( VoteNY.clearRatingTimer );
		}
		VoteNY.clearRating( id, num, prev_rating );
		for( var x = 1; x <= num; x++ ) {
			document.getElementById( 'rating_' + id + '_' + x ).src = VoteNY.imagePath + 'star_voted.gif';
		}
		VoteNY.last_id = id;
	}
};