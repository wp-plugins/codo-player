var app = app || angular.module('App', []);
app.factory('designer', function() {
    return {};
});

var pickerColor;
function updateInfo(color) {
    pickerColor(color);
}

function DesignerCtrl($scope, $http) {
    var $ = jQuery;
    String.prototype.bool = function() {
        return (/^true$/i).test(this);
    };

    var timer;
    pickerColor = function(color) {
        $scope.foreColor = "#" + color;
        $scope.$digest($scope.foreColor);
        clearTimeout(timer);
        timer = setTimeout(function() {
            $scope.SetPlayer();
        }, 500)
    };

    $scope.SetWidth = function() {
        $scope.player1.resize($scope.currSettings.width, $scope.currSettings.height);
    }
    $scope.SetHeight = function() {
        $scope.player1.resize($scope.currSettings.width, $scope.currSettings.height);
    }
    $scope.SetVolume = function() {
        $scope.player1.media.setVolume($scope.currSettings.volume);
    }

    $scope.media = [{
        src: "relative://../media/smashedtv.mp4",
        title: "Some title text",
        poster: "../media/smashedtv.jpg",
        engine: "auto"
    }];

    $scope.SetResponsive = function() {
        if($scope.currSettings.responsive) {
            $scope.currSettings.width = null;
            $scope.currSettings.height = null;
        } else {
            $scope.currSettings.width = $scope.memoryW;
            $scope.currSettings.height = $scope.memoryH;
        }
        $scope.SetPlayer();
    }
    $scope.AddClip = function() {
        $scope.media.push({
            src: "relative://../media/smashedtv.mp4",
            title: "Some title text",
            poster: "../media/smashedtv.jpg",
            engine: "auto"
        });
        if ($scope.media.length == 2) {
            $scope.playlist = "true";
        }
        $scope.SetPlayer();
    }
    $scope.SubmitClip = function() {
        $scope.SetPlayer();
    }
    $scope.RemoveClip = function(i) {
        $scope.media.splice(i, 1);
        if ($scope.media.length == 1) {
            $scope.playlist = "false";
        }
        $scope.SetPlayer();
    }
    $scope.StringToBoolean = function(string) {
        return (/^true$/i).test(string);
    }

    if(!$scope.allInited) {
        $scope.initSettings = {};
        $scope.currSettings = {};
        $scope.currSettings.controls = {};
    }

    $scope.SetPlayer = function() {
        var arr = [];
        for (var i = 0; i < $scope.media.length; i++) {
            delete $scope.media[i].$$hashKey;
            var object = $.extend(true, {}, $scope.media[i]);
            arr.push(object)
        };

        if($scope.player1) $scope.player1.destroy();

        $scope.player1 = CodoPlayer(arr, {
            width: $scope.currSettings.width,
            height: $scope.currSettings.height,
            preload: function() {
                if(typeof $scope.currSettings.preload === "string") {
                    return $scope.currSettings.preload.bool()
                } if(typeof $scope.currSettings.preload === "boolean") {
                    return $scope.currSettings.preload;
                }
                return true;
            }(),
            autoplay: function() {
                if(typeof $scope.currSettings.autoplay === "string") {
                    return $scope.currSettings.autoplay.bool()
                } if(typeof $scope.currSettings.autoplay === "boolean") {
                    return $scope.currSettings.autoplay;
                }
                return false;
            }(),
            loop: function() {
                if(typeof $scope.currSettings.loop === "string") {
                    return $scope.currSettings.loop.bool()
                } if(typeof $scope.currSettings.loop === "boolean") {
                    return $scope.currSettings.loop;
                }
                return false;
            }(),
            volume: $scope.currSettings.volume,
            playlist: function() {
                if(typeof $scope.currSettings.playlist === "string") {
                    return $scope.currSettings.playlist.bool()
                } if(typeof $scope.currSettings.playlist === "boolean") {
                    return $scope.currSettings.playlist;
                }
                return false;
            }(),
            style: $scope.currSettings.style,
            engine: $scope.currSettings.engine,
            controls: {
                show: $scope.currSettings.controls.show,
                play: function() {
                    if(typeof $scope.currSettings.controls.play === "string") {
                        return $scope.currSettings.controls.play.bool()
                    } if(typeof $scope.currSettings.controls.play === "boolean") {
                        return $scope.currSettings.controls.play;
                    }
                    return true;
                }(),
                playBtn: function() {
                    if(typeof $scope.currSettings.controls.playBtn === "string") {
                        return $scope.currSettings.controls.playBtn.bool()
                    } if(typeof $scope.currSettings.controls.playBtn === "boolean") {
                        return $scope.currSettings.controls.playBtn;
                    }
                    return true;
                }(),
                seeking: function() {
                    if(typeof $scope.currSettings.controls.seeking === "string") {
                        return $scope.currSettings.controls.seeking.bool()
                    } if(typeof $scope.currSettings.controls.seeking === "boolean") {
                        return $scope.currSettings.controls.seeking;
                    }
                    return true;
                }(),
                seek: function() {
                    if(typeof $scope.currSettings.controls.seek === "string") {
                        return $scope.currSettings.controls.seek.bool()
                    } if(typeof $scope.currSettings.controls.seek === "boolean") {
                        return $scope.currSettings.controls.seek;
                    }
                    return true;
                }(),
                volume: $scope.currSettings.controls.volume,
                fullscreen: function() {
                    if(typeof $scope.currSettings.controls.fullscreen === "string") {
                        return $scope.currSettings.controls.fullscreen.bool()
                    } if(typeof $scope.currSettings.controls.fullscreen === "boolean") {
                        return $scope.currSettings.controls.fullscreen;
                    }
                    return true;
                }(),
                title: function() {
                    if(typeof $scope.currSettings.controls.title === "string") {
                        return $scope.currSettings.controls.title.bool()
                    } if(typeof $scope.currSettings.controls.title === "boolean") {
                        return $scope.currSettings.controls.title;
                    }
                    return true;
                }(),
                time: function() {
                    if(typeof $scope.currSettings.controls.time === "string") {
                        return $scope.currSettings.controls.time.bool()
                    } if(typeof $scope.currSettings.controls.time === "boolean") {
                        return $scope.currSettings.controls.time;
                    }
                    return true;
                }(),
                hideDelay: $scope.currSettings.controls.hideDelay,
                loadingText: $scope.currSettings.controls.loadingText,
                foreColor: $scope.currSettings.controls.foreColor,
                backColor: $scope.currSettings.controls.backColor,
                progressColor: $scope.currSettings.controls.progressColor,
                bufferColor: $scope.currSettings.controls.bufferColor
            }
        }, "#designer-player");

        if (!$scope.allInited) {
            $.extend(true, $scope.initSettings, $scope.player1.settings);
            $.extend(true, $scope.currSettings, $scope.initSettings);
            $scope.allInited = true;
        }

        var allArr = ["width", "height", "volume", "preload", "autoplay", "loop", "playlist", "style", "engine"];
        var changedArr = [];
        for (var i in allArr) {
            var key = allArr[i];
            if ($scope.currSettings[key] != null && $scope.StringToBoolean($scope.currSettings[key]) !== $scope.initSettings[key]) {
                switch (key) {
                    case "volume":
                        if ($scope.currSettings[key] !== $scope.initSettings[key]) {
                            changedArr.push("\n " + key + ": " + $scope.currSettings[key]);
                        }
                        break;
                    case "style":
                    case "engine":
                        if ($scope.currSettings[key] !== $scope.initSettings[key]) {
                            changedArr.push("\n " + key + ": \"" + $scope.currSettings[key] + "\"");
                        }
                        break;
                    default:
                        changedArr.push("\n " + key + ": " + $scope.currSettings[key]);
                }
            }
        }

        var allArr2 = ["show", "play", "playBtn", "seek", "seeking", "volume", "fullscreen", "title", "time", "loadingText", "hideDelay", "foreColor", "backColor", "progressColor", "bufferColor"];
        var changedArr2 = [];
        for (var i in allArr2) {
            var key = allArr2[i];
            if ($scope.currSettings.controls[key] && $scope.StringToBoolean($scope.currSettings.controls[key]) !== $scope.initSettings.controls[key]) {
                switch (key) {
                    case "hideDelay":
                        if ($scope.currSettings.controls[key] !== $scope.initSettings.controls[key]) {
                            changedArr2.push("\n        " + key + ": " + $scope.currSettings.controls[key]);
                        }
                        break;
                    case "volume":
                        if ($scope.currSettings.controls[key] !== $scope.initSettings.controls[key]) {
                            if($scope.currSettings.controls[key] !== "false") {
                                changedArr2.push("\n        " + key + ": \"" + $scope.currSettings.controls[key] + "\"");
                            } else {
                                changedArr2.push("\n        " + key + ": " + $scope.currSettings.controls[key]);
                            }
                        }
                        break;
                    case "show":
                    case "loadingText":
                    case "foreColor":
                    case "backColor":
                    case "progressColor":
                    case "bufferColor":
                        if ($scope.currSettings.controls[key] !== $scope.initSettings.controls[key]) {
                            changedArr2.push("\n        " + key + ": \"" + $scope.currSettings.controls[key] + "\"");
                        }
                        break;
                    default:
                        changedArr2.push("\n        " + key + ": " + $scope.currSettings.controls[key]);
                }
            }
        }

        var controlsObj = changedArr2.length ? changedArr2.join(",") + "\n  }" : "";

        if(controlsObj.length) {
            changedArr.push("\n controls: {" + controlsObj)
            var settingsObj = ", {" + changedArr.join(",") + "\n}";
        } else {
            var settingsObj = changedArr.length ? ", {" + changedArr.join(",") + "\n}" : "";
        }

        $scope.playerSnippet = "<script src=\"" + $(".codo-player-designer").data("url") + "CodoPlayer.js\" type=\"text/javascript\"></script>\n<script type=\"text/javascript\">\nCodoPlayer(" + JSON.stringify($scope.media, null, 4).replace(/\"([^(\")"]+)\":/g, "$1:") + settingsObj + ")\n</script>";
        setTimeout(function() {
            $(".prettyprint").removeClass("prettyprinted");
            prettyPrint();
        }, 200);
    }
    $scope.SetPlayer();

    $scope.memoryW = Math.round($scope.currSettings.width);
    $scope.memoryH = Math.round($scope.currSettings.height);
    $scope.SetResponsive();
};