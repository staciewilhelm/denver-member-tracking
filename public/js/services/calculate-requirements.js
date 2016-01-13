(function() {

	'use strict';

	angular
		.module('denverTracking')
		.factory('calcReqs', calcReqs);

		function calcReqs(_) {
			// set all possible requirement headers
			function getHeaders() {
				return ['practice', 'scrimmage', 'bout', 'committee', 'activity', 'facility'];
			}

			// base (league) requirements
			function setBaseReqData(reqData) {
				var headers = this.getHeaders(),
						currentReqTeam = reqData[0].team_id,
						groupedData = _.groupBy(reqData, 'team_id'),
						checkData = new Object(),
						currentReqs = [],
						reqsType = 'League';

				// set currentReqs
				_.each(headers, function(hName) {
					currentReqs[hName] = [];
				});

				_.each(headers, function(hName) {
					_.each(reqData, function(r) {
						if (r.requirement_type_id === 2 && reqsType === 'League')
							reqsType = r.team_name;

						// set requirement types (if not already set)
						if (_.isUndefined(checkData['q'+r.quarter+hName])) {
							checkData['q'+r.quarter+hName] = r[hName];
							currentReqs[hName].push({type:'base', quarter:r.quarter, count:r[hName], amended:null});
							currentReqs[hName].push({type:'remaining', quarter:r.quarter, count:r[hName], attended:0});
						}
					});
				});

				return {reqsType: reqsType, checkData: checkData, reqs: currentReqs};
			};

			// sets the user requirement data (typically after running setBaseReqData)
			function setUserReqData(checkData, currentReqs, relatedData) {
				var headers = this.getHeaders(),
						baseReqIndex, remainingReqIndex, 
						amendedCount, remainingCount, baseCount,
						watchReqs = {};

				_.each(headers, function(hName) {
					watchReqs[hName] = {1:{}, 2:{}, 3:{}, 4:{}};

					// create member (will not have user requirements yet)
					if (!relatedData) {
						_.each(watchReqs[hName], function(obj, qtr) {
							// set base requirement count
							baseCount = checkData['q'+qtr+hName];
							watchReqs[hName][qtr] = {base:baseCount, amended:null, attended:0, remaining:baseCount};
						});

					// edit member
					} else {
						// loop through user requirements
						_.each(relatedData, function(ur) {
							amendedCount = null; // reset amended count

							// set base requirement count
							baseCount = checkData['q'+ur.quarter+hName];

							// find the index of the base requirement
							baseReqIndex = _.findIndex(currentReqs[hName], {type:'base', quarter:ur.quarter});

							// and set the id of the record
							currentReqs[hName][baseReqIndex].id = ur.id;

							// check if the user has an amended requirement
							if (ur['min_'+hName] !== checkData['q'+ur.quarter+hName]) {
								// set both the amended and base count to the user requiremet
								amendedCount = baseCount = ur['min_'+hName];

								// and update the amended count (default is null)
								currentReqs[hName][baseReqIndex].amended = amendedCount;
							}
							// set the remaining requirement count
							// if the base count is more than the user requirement count, subtract
							// otherwise, default to 0
							remainingCount = (baseCount > ur[hName+'_count']) ? (baseCount - ur[hName+'_count']) : 0;

							// find the index of the current requirements
							remainingReqIndex = _.findIndex(currentReqs[hName], {type:'remaining', quarter:ur.quarter}); 
							// set remaining.count (requirements to be met) and
							// the remaining.attended (attended requirements)
							currentReqs[hName][remainingReqIndex].count = remainingCount;
							currentReqs[hName][remainingReqIndex].attended = ur[hName+'_count'];

							watchReqs[hName][ur.quarter] = {base:checkData['q'+ur.quarter+hName], amended: amendedCount, attended:ur[hName+'_count'], remaining:remainingCount};
						});
					}

				});

				return {currentReqs:currentReqs, watchReqs:watchReqs};
			};

			/**
			 * Calculates remaining requirements
			 *
			 * @baseData      object
			 * @relatedData   object
			 * @specificTypes array (optional)
			 */
			function getRemaining(baseData, relatedData, specificTypes) {
				var checkData = new Object(),
						remainingData = new Object(),
						currentQtr = moment().quarter(),
						types = this.getHeaders();

				if (!_.isEmpty(specificTypes)) types = specificTypes;

				_.each(types, function(hName) {
					_.each(baseData, function(r) {
						// set requirement types (if not already set)
						if (_.isUndefined(checkData[hName]) && (r.quarter === currentQtr)) {
							checkData[hName] = r[hName];
							remainingData[hName] = {required:0, remaining:0};
						}
					});
				});

				var userReqs = _.findWhere(relatedData, {quarter: currentQtr});

				if (_.isUndefined(userReqs)) {
					return 'An error occurred';
				} else {
					var totalRequired, totalRemaining;
					_.each(checkData, function(bCount, bIndex) {
						totalRequired = (userReqs['min_'+bIndex] !== bCount) ? userReqs['min_'+bIndex] : bCount;
						// set totalRemaining to 0 if clockin total is greater than requirement total
						totalRemaining = (totalRequired < userReqs[bIndex+'_count']) ? 0 : (totalRequired - userReqs[bIndex+'_count']);

						remainingData[bIndex] = {required: totalRequired, remaining: totalRemaining};
					});
				}

				return remainingData;
			};

			// return the functions
			return {
				getHeaders: getHeaders,
				getRemaining: getRemaining,
				setBaseReqData: setBaseReqData,
				setUserReqData: setUserReqData
			}
		}

})();