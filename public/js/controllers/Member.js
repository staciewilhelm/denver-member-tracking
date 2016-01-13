(function() {

	var loadedOnce = false;

	'use strict';

	angular
		.module('denverTracking')
		.directive('dataField', dataField)
		
		.directive('textField', textField)
		.directive('venmoField', venmoField)
		.directive('selectField', selectField)
		.directive('datepickerDob', datepickerDob)
		.directive('datepickerJoin', datepickerJoin)
		.directive('datepickerInduction', datepickerInduction)
		.directive('datepickerTransfer', datepickerTransfer)
		.directive('datepickerRetired', datepickerRetired)
		.directive('datepickerActivestandingstart', datepickerActivestandingstart)
		.directive('datepickerActivestandingend', datepickerActivestandingend)
		
		.controller('MemberMngr', MemberMngr)
		.controller('Member', Member);

		function MemberMngr(_, $scope, $window, $modal, $log, coreFns, calcReqs, user) {
			var mMngr = this;

			mMngr.setUserData = function(userData) {
				_.each(userData, function(u) {
					if (_.isNull(u.skater_name)) u.skater_name = '';
				});
				mMngr.users = userData;
			};

			mMngr.predicate = ['last_name', 'first_name'];
			mMngr.predicateIsName = true;

			mMngr.toggleSort = function(selected) {
				mMngr.predicate = coreFns.toggle(selected, mMngr.predicate, mMngr.predicateIsName);
			}

			mMngr.redirect = function(url) {
				$window.location.href = url;
			}

			/* Modal */
			mMngr.modalOpen = function (userId) {
				var modalInstance = $modal.open({
					backdrop: false,
					scope: $scope,
					templateUrl: 'practiceHistory',
					controller: 'ModalPracticeHistory',
					controllerAs: 'mod',
					size: 'lg',
					resolve: {
						user: function () {
							return user.getUsersRequirements(userId).then(function(result) {
								return result;
							}, function(error) {
								console.log(error);
							});
						}
					}
				});

				modalInstance.result.then(function (selectedItem) {
					$scope.selected = selectedItem;
				}, function () {
					$log.info('Modal dismissed at: ' + new Date());
				});
			};

		};

		function Member(_, $http, $scope, $modal, $log, $timeout, coreData, calcReqs) {
			var m = this;

			m.loaded = (loadedOnce) ? true : false;
			m.user = {};
			m.errors = {};
			m.action = 'create';
			m.formAction = '/members/create';

			console.log('loaded?', m.loaded);

			$timeout(function() { m.loaded = true; }, 1000);

			// set default values
			m.roleId = '';
			m.user.role_id = 3;
			m.groupId = '';
			m.memberStatus = '';
			m.memberType = '';
			m.memberLevel = '';
			m.skaterLevel = '';

			m.homeTeams = [];
			m.travelTeams = [];
			m.selectedHomeTeam = null;
			m.seletedTravelTeams = [];

			m.showRecentTransactions = (m.action === 'create') ? false : true;
			m.showRecentClockIns = false;
			m.showUserStandings = false;

			// set options
			m.currentQuarter = coreData.currentQuarter;
			m.memberStatuses = coreData.memberStatuses;
			m.memberTypes = coreData.memberTypes;
			m.memberLevels = coreData.memberLevels;
			m.skaterLevels = coreData.skaterLevels;

			/* Datepicker options*/
			m.today = coreData.today;

			m.dateOptions = coreData.dateOptions;
			m.dateFormat = coreData.dateFormat;

			m.open = function($event, which) {
				// set value to null to eliminate directive error
				m[which] = null;
				$event.preventDefault();
				$event.stopPropagation();
				m.datepickers[which] = true;
			};

			// datepicker initialization
			m.datepickers = {
				dob: false,
				join_date: false,
				induction_date: false,
				transfer_date: false,
				retired_date: false,
				activeStanding_start_date: false,
				activeStanding_end_date: false
			};

			m.setData = function(type, data, relatedData) {
				var pivotData;
				switch (type) {
					case 'committees':
						var allCommittees = [],
								len = data.length,
								mid = len / 2;

						_.each(data, function(committee) {
							committee.checked = false;
							// note the teams the user has selected
							pivotData = _.find(relatedData, function(c) {
								return c.pivot.committee_id === committee.id;
							});

							if (!_.isUndefined(pivotData)) committee.checked = true;

							allCommittees.push(committee);
						});

						m.committees = {left:[], right:[]};

						m.committees.left  = data.slice(0, mid);
						m.committees.right = data.slice(mid, len);

						break;
					case 'groups':
						m.groups = data;
						break;
					case 'positions':
						m.positions = [];

						_.each(data, function(p) {
							pivotData = _.findWhere(relatedData, {id:p.id});
							p.checked = !_.isUndefined(pivotData) ? true : false;

							m.positions.push(p);
						});

						break;
					case 'roles':
						m.roles = data;
						break;
					case 'requirements':
						// base requirements
						// user's custom requirements
						// user's requirements count (aggregate of clock-ins but stored in users_requirements table)
						m.reqHeaders = calcReqs.getHeaders();

						var baseData = calcReqs.setBaseReqData(data),
								userReqData = calcReqs.setUserReqData(baseData.checkData, baseData.reqs, relatedData);

						m.reqsType = baseData.reqsType;

						m.currentReqs = userReqData.currentReqs;
						m.watchReqs = userReqData.watchReqs;

						break;
					case 'teams':
						var homeTeamCaptain = false,
								homeTeamCoach = false;
						_.each(data, function(team) {
							team.checked = team.is_captain = team.is_coach = false;
							// note the teams the user has selected
							pivotData = _.find(relatedData, function(t) {
								return t.pivot.team_id === team.id;
							});

							if (!_.isUndefined(pivotData)) {
								team.checked = true;
								team.is_captain = pivotData.pivot.is_captain ? true : false;
								team.is_coach = pivotData.pivot.is_coach ? true : false;
								// set correct variables
								if (team.team_type_id === 1) {
									m.selectedHomeTeam = team.id;
								} else {
									m.seletedTravelTeams.push(team.id);
								}
							}

							if (team.team_type_id === 1) {
								m.homeTeams.push(team);
							} else {
								m.travelTeams.push(team);
							}
						});

						break;
				}
			};

			m.setUserData = function(userData) {
				m.user = userData;
				console.log('in the edit');
				m.action = 'update';
				m.formAction = '/members/'+m.user.id+'/update';

				m.roleId = userData.role_id;
				m.groupId = userData.group_id;

				m.venmoHandle = m.user.venmo_handle;
				m.identifiesAs = m.user.identifies_as;

				m.memberStatus = userData.mem_status;
				m.user.mem_status = userData.mem_status;
				m.memberType = userData.mem_type;
				m.memberLevel = userData.mem_level;
				m.skaterLevel = userData.skater_level;

				m.dob = userData.dob;
				m.join_date = userData.join_date;
				m.induction_date = userData.induction_date;
				m.transfer_date = userData.transfer_date;
				m.retired_date = userData.retired_date;

				m.isTransfer = userData.is_transfer;
			};

			m.updateReqs = function(qtr, type) {
				var requiredCount = m.watchReqs[type][qtr].base,
						remainingCount = 0;

				// set amended value as new base count
				// if amended is empty, set remaining to original
				requiredCount = _.isEmpty(m.watchReqs[type][qtr].amended) ? m.watchReqs[type][qtr].base : m.watchReqs[type][qtr].amended;

				// set remaining count based on required (base or amended) - already clocked
				remainingCount = (_.isUndefined(m.watchReqs[type][qtr].attended)) ? parseInt(requiredCount) : parseInt(requiredCount) - m.watchReqs[type][qtr].attended;

				// set remaining count to 0 in the case user has met more than required
				if (remainingCount < 0) remainingCount = 0;

				// set remaining requirements
				m.watchReqs[type][qtr].remaining = remainingCount;
			}

			m.setUserBelongsData = function(userClockins, userStandings, userTransactions) {
				// set quarter for each clockin
				m.userClockins = [];
				_.each(userClockins, function(c) {
					c.qtr = moment(c.clocked).quarter();
					m.userClockins.push(c);
				});

				// loop through user standings to ensure each has an end date
				m.userStandings = [];
				_.each(userStandings, function(standing) {
					// if a record does not has an end date, we will mark
					// it as active and pull it out of the listing
					if (_.isEmpty(standing.end_date)) {
						m.activeStanding = standing;
						m.activeStanding_start_date = standing.start_date;
						m.activeStanding_end_date = standing.end_date;
					} else {
						m.userStandings.push(standing);
					}
				});

				// loop through user standings to ensure each has an end date
				m.userTransactions = [];
				_.each(userTransactions, function(t) {
					m.userTransactions.push(t);
				});
			};

			m.submit = function(isValid) {

				if (isValid) {
					alert('our form is amazing');
				} else {
					console.log(isValid);
				}
				var fieldEl;

				if (m.action === 'create') {
					console.log(m.user);
					$http.post('/members/create', m.user)
						.success(function(data) {
							if (data.errors) {
								_.each(data.errors, function(err, errField) {
									m.errors[errField] = err;
									fieldEl = angular.element(document.querySelector('input[name="'+errField+'"]')).addClass('val-err');
								});
							} else {
								console.log('submit the data!');
							}
						}).error(function(msg, code) {
							console.log('error', msg, code);
							//deferred.reject(msg);
						});
				} else {
					console.log('in the edit');
					$http.put('/members/'+m.user.id+'/update', m.user)
				.success(function(data) {
					console.log('success', data);
					//deferred.resolve(data);
				}).error(function(msg, code) {
					console.log('error');
					//deferred.reject(msg);
				});
				}

				//console.log('ohlo');
			}

			m.updateValue = function(type, val) {
				if (!_.isUndefined(val)) {
					switch (type) {
						case 'role':
							m.roleId = val;
							m.user.role_id = val;
							break;
						case 'group':
							m.groupId = val;
							m.user.group_id = val;
							break;
						case 'memberStatus':
							m.memberStatus = val;
							m.user.mem_status = val;
							break;
						case 'memberType':
							m.memberType = val;
							m.user.mem_type = val;
							break;
						case 'memberLevel':
							m.memberLevel = val;
							m.user.mem_level = val;
							break;
						case 'skaterLevel':
							m.skaterLevel = val;
							m.user.skater_level = val;
							break;
					}
				}
			};

			/* Team Roles */
			m.enableTeamRoles = function(team_id) {
				m.selectedHomeTeam = team_id;
			};

			m.enableTTRoles = function(team_id) {
				// Does the filter exist in the sub array.
				var i = m.seletedTravelTeams.indexOf(team_id);

				// If it exists, remove the filter.
				if (i > -1) {
					m.seletedTravelTeams.splice(i, 1);

				// Otherwise add the filter.
				} else {
					m.seletedTravelTeams.push(team_id);
				}
			};

			/* Toggle Sidebar Data */
			m.toggleRecentTransactions = function() {
				if (!m.showRecentTransactions) {
					m.showRecentTransactions = true;
					m.showRecentClockIns = false;
					m.showUserStandings = false;
				}
			};

			m.toggleRecentClockins = function() {
				if (!m.showRecentClockIns) {
					m.showRecentClockIns = true;
					m.showRecentTransactions = false;
					m.showUserStandings = false;
				}
			};

			m.toggleUserStandings = function() {
				if (!m.showUserStandings) {
					m.showUserStandings = true;
					m.showRecentClockIns = false;
					m.showRecentTransactions = false;
				}
			};

			/* Prepend value (ie @) */
			m.prepend = function(val) {
				if (val === '@' && !_.isUndefined(m.venmoHandle)) {
					var stripped = m.venmoHandle.replace(/@/g, '');
					if (stripped.length > 0) m.venmoHandle = '@' + stripped;
				}
			};

		}

		/* directives */
		function dataField() {
			return {
				restrict: 'A', // only activate on element attribute
				require: '?ngModel', // get a hold of NgModelController
				replace: true,
				link: function(scope, element, attrs, ngModel) {
					if (!ngModel) return; // do nothing if no ng-model

					// Specify how UI should be updated
					ngModel.$render = function() {
					  element.html(ngModel.$viewValue);
					};

					// Listen for change events to enable binding
					/*element.on('blur keyup change', function() {
					  scope.$evalAsync(read);
					});*/
					

					scope.$watch(function() {
						//console.log('in the watch');
						return ngModel.$invalid;
					} ,function(newVal,oldVal) {
						//console.log('in the other of the watch');
						//console.log(element.val(), element.prop('required'));
						//console.log('new:'+newVal, 'old: '+oldVal);

						//if (!element.val() && element.prop('required')) {
						//	ngModel.$setValidity('required', false);
						//} else {
						//	ngModel.$setValidity('required', true);
						//}

						

					});
					//read(); // initialize

					// Write data to the model
					function read() {
					  var html = element.html();
					  //console.log(html, attrs, attrs.ngModel);
					  console.log('val: '+element.val(), 'required: '+element.prop('required'), html);
					  // When we clear the content editable the browser leaves a <br> behind
					  // If strip-br attribute is provided then we strip this out
					  if ( attrs.stripBr && html == '<br>' ) {
					    html = '';
					  }
					  
					  if (!element.val() && element.prop('required')) {
					  	console.log('NOT valid');
					  	ngModel.$setValidity('required', false);
					  } else {
					  	console.log('VALID');
					  	ngModel.$setValidity('required', true);
					  }
					  ngModel.$setViewValue(html);
					}
				},
				//templateUrl: 'form-directives/text-condreq-field.html'
			}
		}

		function textField() {
			return {
				restrict: 'E',
				scope: {
					ngmodelVar: '='
				},
				replace: true,
				link: function(scope, element, attrs) {
					scope.fieldType = attrs.fieldtype;
					scope.fieldClass = attrs.fieldclass;
					scope.fieldName = attrs.fieldname;
					scope.isRequired = attrs.isrequired;
					//scope.placeholder = attrs.placeholder;
					//scope.fieldVal = (attrs.submitted) ? attrs.submitted : attrs.original;
					//scope.errorMsg = attrs.errormsg;
				},
				templateUrl: 'form-directives/text-field.html'
			}
		}

		


		function venmoField() {
			return {
				restrict: 'E',
				templateUrl: 'form-directives/venmo-field.html'
			}
		}

		function selectField() {
			return {
				restrict: 'E',
				scope: {
					ngmodelVar: '=',
					ngchangeVar: '=',
					ngselectedVar: '='
				},
				replace: true,
				link: function(scope, element, attrs) {
					scope.fieldName = attrs.fieldname;
					scope.isRequired = attrs.isrequired;
					scope.showChoose = attrs.showchoose;
					if (attrs.choosetext) scope.chooseText = attrs.choosetext;
					scope.fieldOptions = JSON.parse(attrs.fieldoptions);
					//scope.placeholder = attrs.placeholder;
					//scope.fieldVal = (attrs.submitted) ? attrs.submitted : attrs.original;
					//scope.errorMsg = attrs.errormsg;
				},
				templateUrl: 'form-directives/select-field.html'
			}
		}

		function datepickerDob(coreData) {
			return {
				restrict: 'AE',
				templateUrl: 'form-directives/datepicker-dob.html'
			}
		}

		function datepickerJoin(coreData) {
			return {
				restrict: 'AE',
				templateUrl: 'form-directives/datepicker-join.html'
			}
		}

		function datepickerInduction(coreData) {
			return {
				restrict: 'AE',
				templateUrl: 'form-directives/datepicker-induction.html'
			}
		}

		function datepickerTransfer(coreData) {
			return {
				restrict: 'AE',
				templateUrl: 'form-directives/datepicker-transfer.html'
			}
		}

		function datepickerRetired(coreData) {
			return {
				restrict: 'AE',
				templateUrl: 'form-directives/datepicker-retired.html'
			}
		}

		function datepickerActivestandingstart(coreData) {
			return {
				restrict: 'AE',
				templateUrl: 'form-directives/datepicker-standingstart.html'
			}
		}

		function datepickerActivestandingend(coreData) {
			return {
				restrict: 'AE',
				templateUrl: 'form-directives/datepicker-standingend.html'
			}
		}

})();