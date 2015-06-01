/**
 * Created by fliak on 31.5.15.
 */

var app = angular.module('app');


app.controller('OnSiteNotificationEngine', function ($scope, $injector, $http, $rootScope, configService, $location, AppConfig, $attrs, NotificationShowSupervisor) {

    $.extend($scope, {
        ok: function()  {
            $scope.closePopup().then(function() {
                if ($scope.relatedLink) {
                    window.location.href = $scope.relatedLink;
                }
            });
        }
    });

    //Дадаць праверку на юзер профіль
    //if (location.href === '')   {
    //
    //}





    var agentUri = $attrs.agentUri;


    var config = AppConfig.on_site_notification;

    var endpoint = config.endpoint;


    var url = endpoint + 'pending/' + agentUri;

    $.get(url)
        .success(function(response)  {
            console.log('succ', response);
            if (response && Array.isArray(response) && response.length > 0) {

                for (var i in response) {
                    var notification = response[i];

                    if (location.href === notification.related_link)    {
                        continue;
                    }

                    if (!NotificationShowSupervisor.canBeShown(notification)) {
                        continue;
                    }


                    $scope.$apply(function () {
                        $scope.notification = notification;
                        $scope.action = notification.action;
                        $scope.message = notification.message;
                        $scope.showNotification = true;
                        $scope.relatedLink = notification.related_link;
                    });

                    break;  //show only first notification

                }
            }
        })
        .error(function(response)   {
            console.log('error', response);
        });


    $scope.closePopup = function()  {

        return NotificationShowSupervisor.setShown($scope.notification).then(function()    {
            $scope.showNotification = false;
        }, function()   {
            console.log('error', response);
        });

    }



});

app.factory('NotificationShowSupervisor', function($http, AppConfig) {
    var config = AppConfig.on_site_notification;

    var endpoint = config.endpoint;

    return {

        _getInternalId: function(id)  {
            return 'on_site_notification_' + id;
        },

        _getById: function(id)  {
            id = this._getInternalId(id);

            var dataString = localStorage[id];
            if (dataString) {
                return JSON.parse(dataString);
            }
            else    {
                return {};
            }
        },

        _setById: function(id, info)  {
            var internalId = this._getInternalId(id);

            localStorage[internalId] = JSON.stringify(info);

            var url = endpoint + 'shown/' + id;

            return $http.get(url);
        },

        canBeShown: function(notification)  {

            var info = this._getById(notification.id);

            var termBetweenLimit = notification.show_strategy.term_between_show || 0;


            var now = new Date();

            if (termBetweenLimit && info.lastExpositionDate) {

                var lastExpositionDate = new Date(info.lastExpositionDate);

                var diff = (now - lastExpositionDate) / 1000;
                if (diff < termBetweenLimit)   {
                    return false;
                }
            }

            return true;
        },

        setShown: function(notification)    {
            var info = this._getById(notification.id);
            info.origin = notification;
            info.lastExpositionDate = (new Date()).valueOf();
            var shownTimes = Math.max(info.shownTimes, notification.shown_times);
            shownTimes++;

            info.shownTimes = shownTimes;

            return this._setById(notification.id, info);
        }


    }
});