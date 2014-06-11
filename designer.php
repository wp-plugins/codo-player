<?php
    /* Set styles */
    wp_enqueue_style( 'bootstrap', plugin_dir_url(__FILE__).'res/lib/bootstrap/css/bootstrap.min.css' );
    wp_enqueue_style( 'prettiffy', plugin_dir_url(__FILE__).'res/lib/prettify/sunburst.css' );
    wp_enqueue_style( 'common', plugin_dir_url(__FILE__).'res/css/common-wp.css' );
    wp_enqueue_style( 'base', plugin_dir_url(__FILE__).'designer/res/css/base.css' );

    /* Set scripts */
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'bootstrap', plugin_dir_url(__FILE__).'res/lib/bootstrap/js/bootstrap.min.js');
    wp_enqueue_script( 'angular', plugin_dir_url(__FILE__).'res/lib/angular/angular.min.js');
    wp_enqueue_script( 'prettify', plugin_dir_url(__FILE__).'res/lib/prettify/prettify.js');
    wp_enqueue_script( 'jscolor', plugin_dir_url(__FILE__).'res/lib/picker/jscolor.js');
    wp_enqueue_script( 'controller', plugin_dir_url(__FILE__).'designer/res/js/controllers.js');
    wp_enqueue_script( 'CodoPlayer', plugin_dir_url(__FILE__).'CodoPlayer/CodoPlayer.js');

    // remove wp version param from any enqueued scripts
    function vc_remove_wp_ver_css_js( $src ) {
        if ( strpos( $src, 'ver=' ) )
            $src = remove_query_arg( 'ver', $src );
        return $src;
    }
    add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
    add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );

?>

<div class="wrap codo-player-designer" ng-app="App" data-url="<?php echo plugin_dir_url(__FILE__).'CodoPlayer/' ?>">

    <div ng-controller="DesignerCtrl">

        <div class="content-title">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Codo Player</h1>
                    <h2>Setup the player via the visual interface tool</h2>
                </div>
            </div>
        </div>

        <div class="content-1 player">

            <div class="row">
                <div class="col-md-8">
                        <div id="designer-player"></div>
                 </div>

                 <div class="col-md-4">
                    <div class="panel-group panel-group-lists collapse in" id="accordion2">
                      <div class="panel">
                        <div class="panel-heading">
                          <h4 class="panel-title no-margin-top">
                            <a data-toggle="collapse" data-parent="#accordion2" href="#collapseFour" class="">
                             Settings
                            </a>
                          </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse in" style="height: auto;">
                           <div class="panel-body">

                                <label>
                                    <input type="checkbox" ng-model="currSettings.responsive" ng-change="SetResponsive()" /> Responsive
                                </label>

                                <form>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Width
                                            <input type="number" class="form-control" ng-model="currSettings.width" ng-change="SetWidth()" ng-blur="SetPlayer()" min="10" max="940" ng-disabled="currSettings.responsive" />
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Height
                                            <input type="number" class="form-control" ng-model="currSettings.height" ng-change="SetHeight()" ng-blur="SetPlayer()" min="10" max="940" ng-disabled="currSettings.responsive" />
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Volume
                                            <input type="number" class="form-control" ng-model="currSettings.volume" ng-change="SetVolume()" ng-blur="SetPlayer()" min="0" max="100" />
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Preload
                                            <select class="form-control" ng-model="currSettings.preload" ng-change="SetPlayer()">
                                                <option ng-selected="true">true</option>
                                                <option>false</option>
                                            </select>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Autoplay
                                            <select class="form-control" ng-model="currSettings.autoplay" ng-change="SetPlayer()">
                                                <option ng-selected="currSettings.autoplay == true">true</option>
                                                <option ng-selected="currSettings.autoplay == false">false</option>
                                            </select>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Loop
                                            <select class="form-control" ng-model="currSettings.loop" ng-change="SetPlayer()">
                                                <option ng-selected="currSettings.loop == true">true</option>
                                                <option ng-selected="currSettings.loop == false">false</option>
                                            </select>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Playlist
                                            <select class="form-control" ng-model="currSettings.playlist" ng-change="SetPlayer()">
                                                <option ng-selected="currSettings.playlist == true">true</option>
                                                <option ng-selected="currSettings.playlist == false">false</option>
                                            </select>
                                            </p>
                                        </div>
                                        <!-- <div class="col-md-4">
                                            <p>Style
                                            <select class="form-control" ng-model="currSettings.style" ng-change="SetPlayer()">
                                                <option ng-selected="currSettings.style == standard">standard</option>
                                                <option ng-selected="currSettings.style == mini">mini</option>
                                            </select>
                                            </p>
                                        </div> -->
                                    </div>

                                </form>

                              </div>
                            </div>
                          </div>

                          <div class="panel">
                            <div class="panel-heading">
                              <h4 class="panel-title no-margin-top">
                                <a data-toggle="collapse" data-parent="#accordion2" href="#collapseFive" class="collapsed">
                                  Controls
                                </a>
                              </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" style="height: auto;">
                              <div class="panel-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Show
                                            <select class="form-control" ng-model="currSettings.controls.show" ng-change="SetPlayer()">
                                                <option ng-selected="currSettings.controls.show == auto">auto</option>
                                                <option ng-selected="currSettings.controls.show == always">always</option>
                                                <option ng-selected="currSettings.controls.show == never">never</option>
                                            </select>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Play
                                            <select class="form-control" ng-model="currSettings.controls.play" ng-change="SetPlayer()">
                                                <option ng-selected="currSettings.controls.play == true">true</option>
                                                <option ng-selected="currSettings.controls.play == false">false</option>
                                            </select>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Overlay
                                            <select class="form-control" ng-model="currSettings.controls.playBtn" ng-change="SetPlayer()">
                                                <option ng-selected="currSettings.controls.playBtn == true">true</option>
                                                <option ng-selected="currSettings.controls.playBtn == false">false</option>
                                            </select>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Seek
                                            <select class="form-control" ng-model="currSettings.controls.seek" ng-change="SetPlayer()">
                                                <option ng-selected="currSettings.controls.seek == true">true</option>
                                                <option ng-selected="currSettings.controls.seek == false">false</option>
                                            </select>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Seeking
                                            <select class="form-control" ng-model="currSettings.controls.seeking" ng-change="SetPlayer()">
                                                <option ng-selected="currSettings.controls.seeking == true">true</option>
                                                <option ng-selected="currSettings.controls.seeking == false">false</option>
                                            </select>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Fullscreen
                                            <select class="form-control" ng-model="currSettings.controls.fullscreen" ng-change="SetPlayer()">
                                                <option ng-selected="currSettings.controls.fullscreen == true">true</option>
                                                <option ng-selected="currSettings.controls.fullscreen == false">false</option>
                                            </select>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Title
                                            <select class="form-control" ng-model="currSettings.controls.title" ng-change="SetPlayer()">
                                                <option ng-selected="currSettings.controls.title == true">true</option>
                                                <option ng-selected="currSettings.controls.title == false">false</option>
                                            </select>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Time
                                            <select class="form-control" ng-model="currSettings.controls.time" ng-change="SetPlayer()">
                                                <option ng-selected="currSettings.controls.time == true">true</option>
                                                <option ng-selected="currSettings.controls.time == false">false</option>
                                            </select>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Loading
                                            <input type="text" class="form-control" ng-model="currSettings.controls.loadingText" ng-change="SetPlayer()">
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Hide (s)
                                            <input type="text" class="form-control" ng-model="currSettings.controls.hideDelay" ng-change="SetPlayer()">
                                            </p>
                                        </div>
                                    </div>

                                </form>

                              </div>
                            </div>
                          </div>
                          <div class="panel">
                            <div class="panel-heading">
                              <h4 class="panel-title no-margin-top">
                                <a data-toggle="collapse" data-parent="#accordion2" href="#collapseSix" class="collapsed">
                                  Media
                                </a>
                              </h4>
                            </div>
                            <div id="collapseSix" class="panel-collapse collapse" style="height: 0px;">
                              <div class="panel-body">

                                <form>
                                    <div class="row controls" ng-repeat="clip in media">
                                        <div class="col-md-12">
                                            <p>Source
                                                <input type="text" class="form-control" placeholder="Source" ng-model="clip.src" class="source">
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <p>Poster
                                                <input type="text" class="form-control" placeholder="Poster" ng-model="clip.poster" class="poster">
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <p>Title
                                                <input type="text" class="form-control" placeholder="Title" ng-model="clip.title" class="title">
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <p>Engine
                                                <select class="form-control" ng-model="clip.engine" ng-change="SetPlayer()">
                                                    <option value="auto" selected>auto</option>
                                                    <option value="html5">HTML5</option>
                                                    <option value="flash">FLASH</option>
                                                    <option value="youtube">YOUTUBE</option>
                                                </select>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <p>
                                                <button class="btn btn-success" ng-click="SubmitClip($index)">Save</button>
                                                <button class="btn btn-danger" ng-click="RemoveClip($index)">X</button>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <a class="btn btn-primary btn-lg" ng-click="AddClip()">Add new clip</a>
                                        </div>
                                    </div>
                                </form>

                              </div>
                            </div>
                          </div>
                        </div>

                    </div>
                </div>

        </div>

        <div class="content-2">
            <div class="row">

                <div class="col-md-12">

                    <h3 class="no-margin-top">Snippet</h3>
                    <ol>
                        <li>1. Copy the snippet code.</li>
                        <li>2. Go to "Posts -> New/Edit post".</li>
                        <li>3. In an editor select "Text" view, paste the snippet code and save it.</li>
                        <li><strong>To go PRO and have your own custom branding, please <a href="http://codoplayer.com/" target="_blank">visit Codo Player website</a>.</strong></li>
                    </ol>

                    <p>
<pre class="prettyprint"><div ng-bind-template="{{playerSnippet}}"></div></pre>
                    </p>

                </div>
            </div>
        </div>

    </div>

</div>