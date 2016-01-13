(function() {

	var loadedOnce = false;

	'use strict';

	angular
		.module('denverTracking')
		.controller('RequirementMngr', RequirementMngr);

		function RequirementMngr(_, $scope, $timeout, $window, $modal, $log, coreData, crudFns) {
			var reqMngr = this;

			reqMngr.showSavedNote = false;
			reqMngr.editingReqs = {};
			reqMngr.loaded = (loadedOnce) ? true : false;

			reqMngr.currentYear = coreData.currentYear;
			reqMngr.currentQtr = coreData.currentQuarter;
			reqMngr.upcomingYrs = coreData.upcomingYears;
			reqMngr.allQuarters = coreData.allQuarters;

			$timeout(function() { reqMngr.loaded = true; }, 1000);

			reqMngr.setReqData = function(allReqData) {
				reqMngr.reqs = allReqData;
				reqMngr.editingReqs = {};
				_.each(allReqData, function(r, rI) {
					reqMngr.editingReqs[reqMngr.reqs[rI].id] = false;
				});
			};

			reqMngr.setTeamData = function(teamData) {
				reqMngr.reqTypes = [{requirement_type_id: 1, team_id: null, name: 'League'}];
				_.each(teamData, function(t) {
					reqMngr.reqTypes.push({requirement_type_id: 2, team_id: t.id, name: t.name});
				});
			};

			reqMngr.addReq = function() {
				var newReqData = JSON.parse($scope.req_type),
					newReq = {
						requirement_type_id: newReqData.requirement_type_id, 
						team_id: newReqData.team_id, 
						year: (_.isUndefined($scope.year) ? reqMngr.currentYear : $scope.year), 
						quarter: (_.isUndefined($scope.quarter) ? reqMngr.currentQtr : $scope.quarter), 
						practice: $scope.practice, 
						scrimmage: $scope.scrimmage, 
						activity: $scope.activity,
						committee: $scope.committee,
						facility: $scope.facility,
						bout: $scope.bout,
						type: {name:''},
						team: null
					};

				newReq.type.name = (newReqData.requirement_type_id === 1) ? 'League' : 'Team';
				if (newReqData.requirement_type_id === 2) newReq.team = {name:newReqData.name};
				reqMngr.reqs.unshift(newReq);

				$scope.req_type = '';
				$scope.year = '';
				$scope.quarter = '';
				$scope.practice = '';
				$scope.scrimmage = '';
				$scope.activity = '';
				$scope.committee = '';
				$scope.facility = '';
				$scope.bout = '';

				crudFns.saveData('requirement', newReq).then(function(success) {
					console.log('saved!',success);
				}, function(error) {
					console.log('error', error);
				});

				reqMngr.showSavedNote = true;

				$timeout(function() { reqMngr.showSavedNote = false; }, 3000);
			};

			reqMngr.modifyReq = function(reqData) {
				reqMngr.editingReqs[reqData.id] = true;
			};

			reqMngr.resetReq = function(reqData) {
				reqMngr.editingReqs[reqData.id] = false;
			};

			reqMngr.updateReq = function(reqData) {
				reqMngr.editingReqs[reqData.id] = false;

				crudFns.updateData('requirement', reqData).then(function(success) {
					console.log('updated!',success);
				}, function(error) {
					console.log('error', error);
				});

			};

			reqMngr.removeReq = function(reqId, reqIndex) {
				reqMngr.editingReqs[reqId] = false;

				crudFns.removeData('requirement', reqId).then(function(success) {
					reqMngr.reqs.splice(reqIndex, 1);
				}, function(error) {
					console.log('error', error);
				});
			};

		};

})();