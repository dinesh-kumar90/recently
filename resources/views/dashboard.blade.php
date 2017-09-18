@extends('layouts.app')

@section('styles')
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="https://sdks.shopifycdn.com/polaris/latest/polaris.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.1/rangeslider.min.css" />
    <link href="{{ asset('css/style.css') }}?{{ date('YmdH') }}" rel="stylesheet">
@endsection

@section('content')

    <div id="wrapper">
        <form id="form-settings" autocomplete="off" v-on:submit.prevent="onSubmitSetting">
            
            <div class="side-panel-container">
                <section class="side-panel side-panel-index">
                    <header>
                        <h1>Settings</h1>
                    </header>
                    <nav class="tabs">
                        <ul>
                            <li class="active"><a data-nav-panel-id="nav-panel-1">General</a></li>
                            <li class=""><a data-nav-panel-id="nav-panel-2" data-nav-type="desktop" v-on:click="is_desktop = true; is_mobile = false;">Desktop</a></li>
                            <li class=""><a data-nav-panel-id="nav-panel-3" data-nav-type="mobile" v-on:click="is_mobile = true; is_desktop = false;">Mobile</a></li>
                        </ul>
                    </nav>
                    <div class="side-panel-content">
                        <nav id="nav-panel-1" class="nav-panel active">
                            <ul>
                                <li title="General"><a data-panel-id="panel-1"><i aria-hidden="true" class="fa fa-cog fa-fw"></i>
                                    General
                                </a></li>
                                <li title="Message"><a data-panel-id="panel-2"><i aria-hidden="true" class="fa fa-comment fa-fw"></i>
                                    Message
                                </a></li>
                                <li title="Visibility"><a data-panel-id="panel-3"><i aria-hidden="true" class="fa fa-eye fa-fw"></i>
                                    Visibility &amp; Time
                                </a></li>
                                <!-- <li title="Exceptions"><a data-panel-id="panel-4"><i aria-hidden="true" class="fa fa-toggle-off fa-fw"></i>
                                    Exceptions
                                </a></li> -->
                                <li title="Timing"><a data-panel-id="panel-5"><i aria-hidden="true" class="fa fa-hourglass fa-fw"></i>
                                    Timing
                                </a></li>
                            </ul>
                        </nav>
                        <nav id="nav-panel-2" class="nav-panel">
                            <ul>
                                <li title="Design"><a data-panel-id="panel-6"><i aria-hidden="true" class="fa fa-paint-brush fa-fw"></i>
                                    Design
                                </a></li>
                                <li title="Position"><a data-panel-id="panel-7"><i aria-hidden="true" class="fa fa-arrows-alt fa-fw"></i>
                                    Position
                                </a></li>
                            </ul>
                        </nav>
                        <nav id="nav-panel-3" class="nav-panel ">
                            <ul>
                                <li title="Design"><a data-panel-id="panel-8"><i aria-hidden="true" class="fa fa-paint-brush fa-fw"></i>
                                    Design
                                </a></li>
                                <li title="Position"><a data-panel-id="panel-9"><i aria-hidden="true" class="fa fa-arrows-alt fa-fw"></i>
                                    Position
                                </a></li>
                            </ul>
                        </nav>
                    </div>
                </section>
                <section id="panel-1" class="side-panel">
                    <header>
                        <div class="back"><i aria-hidden="true" class="fa fa-chevron-left"></i></div>
                        <h2>General</h2>
                    </header>
                    <div class="side-panel-content">
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">General settings</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item">
                                       <label for="setting-active" class="Polaris-Choice">
                                          <div class="Polaris-Choice__Control">
                                             <div class="Polaris-Checkbox">
                                                <input type="checkbox" id="setting-active" class="Polaris-Checkbox__Input" v-model="setting.active"> 
                                                <div class="Polaris-Checkbox__Backdrop"></div>
                                                <div class="Polaris-Checkbox__Icon">
                                                   <span class="Polaris-Icon">
                                                      <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg">
                                                         <g fill-rule="evenodd">
                                                            <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                            <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                         </g>
                                                      </svg>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="Polaris-Choice__Label">Enable notifications</div>
                                       </label>
                                       <label for="setting-active-desktop" class="Polaris-Choice">
                                          <div class="Polaris-Choice__Control">
                                             <div class="Polaris-Checkbox">
                                                <input type="checkbox" id="setting-active-desktop" class="Polaris-Checkbox__Input" v-model="setting.active_desktop"> 
                                                <div class="Polaris-Checkbox__Backdrop"></div>
                                                <div class="Polaris-Checkbox__Icon">
                                                   <span class="Polaris-Icon">
                                                      <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg">
                                                         <g fill-rule="evenodd">
                                                            <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                            <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                         </g>
                                                      </svg>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="Polaris-Choice__Label">Display on desktop</div>
                                       </label>
                                       <label for="setting-active-mobile" class="Polaris-Choice">
                                          <div class="Polaris-Choice__Control">
                                             <div class="Polaris-Checkbox">
                                                <input type="checkbox" id="setting-active-mobile" class="Polaris-Checkbox__Input" v-model="setting.active_mobile"> 
                                                <div class="Polaris-Checkbox__Backdrop"></div>
                                                <div class="Polaris-Checkbox__Icon">
                                                   <span class="Polaris-Icon">
                                                      <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg">
                                                         <g fill-rule="evenodd">
                                                            <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                            <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                         </g>
                                                      </svg>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="Polaris-Choice__Label">Display on mobile</div>
                                       </label>
                                       <label for="setting-loop" class="Polaris-Choice">
                                          <div class="Polaris-Choice__Control">
                                             <div class="Polaris-Checkbox">
                                                <input type="checkbox" id="setting-loop" class="Polaris-Checkbox__Input"  v-model="setting.loop"> 
                                                <div class="Polaris-Checkbox__Backdrop"></div>
                                                <div class="Polaris-Checkbox__Icon">
                                                   <span class="Polaris-Icon">
                                                      <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg">
                                                         <g fill-rule="evenodd">
                                                            <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                            <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                         </g>
                                                      </svg>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="Polaris-Choice__Label">Loop notifications</div>
                                       </label>
                                       <label for="setting-random" class="Polaris-Choice">
                                          <div class="Polaris-Choice__Control">
                                             <div class="Polaris-Checkbox">
                                                <input type="checkbox" id="setting-random" class="Polaris-Checkbox__Input"  v-model="setting.random"> 
                                                <div class="Polaris-Checkbox__Backdrop"></div>
                                                <div class="Polaris-Checkbox__Icon">
                                                   <span class="Polaris-Icon">
                                                      <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg">
                                                         <g fill-rule="evenodd">
                                                            <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                            <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                         </g>
                                                      </svg>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="Polaris-Choice__Label">Display in random order</div>
                                       </label>
                                       <label for="setting-pause" class="Polaris-Choice">
                                          <div class="Polaris-Choice__Control">
                                             <div class="Polaris-Checkbox">
                                                <input type="checkbox" id="setting-pause" class="Polaris-Checkbox__Input" v-model="setting.pause"> 
                                                <div class="Polaris-Checkbox__Backdrop"></div>
                                                <div class="Polaris-Checkbox__Icon">
                                                   <span class="Polaris-Icon">
                                                      <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg">
                                                         <g fill-rule="evenodd">
                                                            <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                            <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                         </g>
                                                      </svg>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="Polaris-Choice__Label">Pause on hover</div>
                                       </label>
                                       <label for="setting-link" class="Polaris-Choice">
                                          <div class="Polaris-Choice__Control">
                                             <div class="Polaris-Checkbox">
                                                <input type="checkbox" id="setting-link" class="Polaris-Checkbox__Input" v-model="setting.link"> 
                                                <div class="Polaris-Checkbox__Backdrop"></div>
                                                <div class="Polaris-Checkbox__Icon">
                                                   <span class="Polaris-Icon">
                                                      <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg">
                                                         <g fill-rule="evenodd">
                                                            <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                            <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                         </g>
                                                      </svg>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="Polaris-Choice__Label">Link to product</div>
                                       </label>
                                       <label for="setting-close" class="Polaris-Choice">
                                          <div class="Polaris-Choice__Control">
                                             <div class="Polaris-Checkbox">
                                                <input type="checkbox" id="setting-close" class="Polaris-Checkbox__Input" v-model="setting.close"> 
                                                <div class="Polaris-Checkbox__Backdrop"></div>
                                                <div class="Polaris-Checkbox__Icon">
                                                   <span class="Polaris-Icon">
                                                      <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg">
                                                         <g fill-rule="evenodd">
                                                            <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                            <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                         </g>
                                                      </svg>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="Polaris-Choice__Label">Show close button</div>
                                       </label>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </section>
                <section id="panel-2" class="side-panel">
                    <header>
                        <div class="back"><i aria-hidden="true" class="fa fa-chevron-left"></i></div>
                        <h2>Message</h2>
                    </header>
                    <div class="side-panel-content">
                        
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Online store</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item js-tags_wrapper">
                                        <div class="Polaris-TextField Polaris-TextField--multiline"><textarea class="Polaris-TextField__Input message-area js-textarea" v-model="setting.message" v-on:blur="messageHtml">@{{ setting.message }}</textarea>
                                            <div class="Polaris-TextField__Backdrop"></div>
                                        </div>
                                       <div class="message-tags js-tags"><span class="Polaris-Tag">{ name }</span><span class="Polaris-Tag">{ product }</span><span class="Polaris-Tag">{ city }</span><span class="Polaris-Tag">{ short_state }</span><span class="Polaris-Tag">{ state }</span><span class="Polaris-Tag">{ country }</span><span class="Polaris-Tag">{ distance }</span></div>
                                    </div>
                                </div>
                                <label for="setting-distance" class="Polaris-Choice">
                                    <div class="Polaris-Choice__Control">
                                       <div class="Polaris-Checkbox">
                                          <input type="checkbox" id="setting-distance" class="Polaris-Checkbox__Input" v-model="setting.distance" v-on:change="messageHtml"> 
                                          <div class="Polaris-Checkbox__Backdrop"></div>
                                          <div class="Polaris-Checkbox__Icon">
                                             <span class="Polaris-Icon">
                                                <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg">
                                                   <g fill-rule="evenodd">
                                                      <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                      <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                   </g>
                                                </svg>
                                             </span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="Polaris-Choice__Label">Show Order By Distance</div>
                                 </label>
                            </div>
                        </div>
                        
                    </div>
                </section>
                <section id="panel-3" class="side-panel">
                    <header>
                        <div class="back"><i aria-hidden="true" class="fa fa-chevron-left"></i></div>
                        <h2>Visibility</h2>
                    </header>
                    <div class="side-panel-content">
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Notifications per page</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item">
                                        <input type="range" min="0" max="50" v-model="setting.notifications_per_page">
                                        <span>@{{ setting.notifications_per_page }}</span>
                                    </div>
                                    <div class="Polaris-FormLayout__Item">
                                        <div class="Polaris-Labelled__HelpText">
                                            A maximum of 50 notifications will be displayed on each page load.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </section>
                <section id="panel-4" class="side-panel">
                    <header>
                        <div class="back"><i aria-hidden="true" class="fa fa-chevron-left"></i></div>
                        <h2>Exceptions</h2>
                    </header>
                    <div class="side-panel-content">
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Disable on pages</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item">
                                        <div class="Polaris-Connected">
                                            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                <div class="Polaris-TextField"><input type="text" id="page-pattern" placeholder="Add URL pattern" class="Polaris-TextField__Input">
                                                    <div class="Polaris-TextField__Backdrop"></div>
                                                </div>
                                            </div>
                                            <div class="Polaris-Connected__Item Polaris-Connected__Item--connection"><button type="button" class="Polaris-Button"><span class="Polaris-Button__Content"><span>Add</span></span></button></div>
                                        </div>
                                    </div>
                                    <div class="Polaris-FormLayout__Item">
                                        <ul class="exceptions"></ul>
                                        <div class="Polaris-Labelled__HelpText"><a target="_blank" href="https://support.appifiny.co.uk/knowledgebase/settings/"> Learn</a> how to disable notifications on specific pages.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Disable products</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item"><button type="button" class="Polaris-Button Polaris-Button--primary Polaris-Button--fullWidth"><span class="Polaris-Button__Content"><span>Select products</span></span></button></div>
                                    <div class="Polaris-FormLayout__Item">
                                        <ul class="exceptions"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Disable collections</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item"><button type="button" class="Polaris-Button Polaris-Button--primary Polaris-Button--fullWidth"><span class="Polaris-Button__Content"><span>Select products</span></span></button></div>
                                    <div class="Polaris-FormLayout__Item">
                                        <ul class="exceptions"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="panel-5" class="side-panel">
                    <header>
                        <div class="back"><i aria-hidden="true" class="fa fa-chevron-left"></i></div>
                        <h2>Timing</h2>
                    </header>
                    <div class="side-panel-content">
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Initial delay</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item"><label for="setting-initial-delay" class="Polaris-Choice"><div class="Polaris-Choice__Control"><div class="Polaris-Checkbox"><input type="checkbox" id="setting-initial-delay" class="Polaris-Checkbox__Input" v-model="setting.initial_delay"> <div class="Polaris-Checkbox__Backdrop"></div> <div class="Polaris-Checkbox__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg"><g fill-rule="evenodd"><path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path> <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path></g></svg></span></div></div></div> <div class="Polaris-Choice__Label">Initial delay</div></label></div>
                                    <div class="Polaris-FormLayout__Item">
                                        <input type="range" min="0" max="15" v-model="setting.initial_delay_val">
                                        <span>@{{ setting.initial_delay_val }}</span>
                                    </div>
                                    <div class="Polaris-FormLayout__Item">
                                        <div class="Polaris-Labelled__HelpText">The first notification will be shown after a time @{{ setting.initial_delay_val }} seconds.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Time between notifications</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item"><label for="setting-random-interval" class="Polaris-Choice"><div class="Polaris-Choice__Control"><div class="Polaris-Checkbox"><input type="checkbox" id="setting-random-interval" class="Polaris-Checkbox__Input" v-model="setting.interval"> <div class="Polaris-Checkbox__Backdrop"></div> <div class="Polaris-Checkbox__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg"><g fill-rule="evenodd"><path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path> <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path></g></svg></span></div></div></div> <div class="Polaris-Choice__Label">Interval</div></label></div>
                                    <div class="Polaris-FormLayout__Item">
                                        <input type="range" min="0" max="15" v-model="setting.interval_val">
                                        <span>@{{ setting.interval_val }}</span>
                                    </div>
                                    <div class="Polaris-FormLayout__Item">
                                        <div class="Polaris-Labelled__HelpText">There will be a delay of @{{ setting.interval_val }} seconds separating the notifications.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Display for..</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item">
                                        <input type="range" min="0" max="15" v-model="setting.display_time">
                                        <span>@{{ setting.display_time }}</span>
                                    </div>
                                    <div class="Polaris-FormLayout__Item">
                                        <div class="Polaris-Labelled__HelpText">
                                            Each notification will be displayed for @{{ setting.display_time }} seconds.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="panel-6" class="side-panel">
                    <header>
                        <div class="back"><i aria-hidden="true" class="fa fa-chevron-left"></i></div>
                        <h2>Desktop design</h2>
                    </header>
                    <div class="side-panel-content">
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Colors</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item">
                                        <div class="color-container">
                                            <input type="text" id="desktop-background-color" name="background_color" class="jscolor js-colorpicker"  v-on:change="updateColorModel( 'desktop_background_color', $event )" v-model="setting.desktop_background_color" v-bind:style="{ backgroundColor: setting.desktop_background_color }" /> 
                                            <label for="desktop-background-color">Background</label>
                                        </div>
                                        <div class="color-container">
                                            <input type="text" id="desktop-text-color" name="text_color" class="jscolor js-colorpicker"  v-on:change="updateColorModel( 'desktop_text_color', $event )" v-model="setting.desktop_text_color" v-bind:style="{ backgroundColor: setting.desktop_text_color }"> 
                                            <label for="desktop-text-color">Text</label>
                                        </div>
                                        <div class="color-container">
                                            <input type="text" id="desktop-date-color" name="date_color" class="jscolor js-colorpicker"  v-on:change="updateColorModel( 'desktop_date_color', $event )" v-model="setting.desktop_date_color" v-bind:style="{ backgroundColor: setting.desktop_date_color }"> 
                                            <label for="desktop-date-color">Time</label>
                                        </div>
                                        <div class="color-container">
                                            <input type="text" id="desktop-border-color" name="border_color" class="jscolor js-colorpicker"   v-on:change="updateColorModel( 'desktop_border_color', $event )" v-model="setting.desktop_border_color" v-bind:style="{ backgroundColor: setting.desktop_border_color }"> 
                                            <label for="desktop-border-color">Border</label>
                                        </div>
                                        <div class="color-container">
                                            <input type="text" id="desktop-product-color" name="link_color" class="jscolor js-colorpicker" v-on:change="updateColorModel( 'desktop_product_color', $event )" v-model="setting.desktop_product_color" v-bind:style="{ backgroundColor: setting.desktop_product_color }"> 
                                            <label for="desktop-product-color">Product title</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Font</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item">
                                        <div class="Polaris-Select">
                                            <select id="desktop-font" class="Polaris-Select__Input" v-model="setting.desktop_font_family">
                                               <optgroup label="Default">
                                                  <option value="">Theme font</option>
                                               </optgroup>
                                               <optgroup label="Sans-serif">
                                                  <option value="'Avant Garde', Avantgarde, 'Century Gothic', CenturyGothic, 'AppleGothic', sans-serif">Avant Garde</option>
                                                  <option value="'Gill Sans', 'Gill Sans MT', Calibri, sans-serif">Gill Sans</option>
                                                  <option value="'HelveticaNeue', 'Helvetica Neue', Helvetica, Arial, sans-serif">Helvetica Neue</option>
                                                  <option value="Arial, 'Helvetica Neue', Helvetica, sans-serif">Arial</option>
                                                  <option value="Candara, Calibri, Segoe, 'Segoe UI', Optima, Arial, sans-serif">Candara</option>
                                                  <option value="Geneva, Tahoma, Verdana, sans-serif">Geneva</option>
                                               </optgroup>
                                               <optgroup label="Sans-serif | Google Web Fonts">
                                                  <option value="'Droid Sans', sans-serif">Droid Sans</option>
                                                  <option value="'Lato', sans-serif">Lato</option>
                                                  <option value="'Montserrat', sans-serif">Montserrat</option>
                                                  <option value="'Open Sans', sans-serif">Open Sans</option>
                                                  <option value="'PT Sans', sans-serif">PT Sans</option>
                                                  <option value="'Raleway', sans-serif">Raleway</option>
                                                  <option value="'Roboto', sans-serif">Roboto</option>
                                                  <option value="'Source Sans Pro', sans-serif">Source Sans Pro</option>
                                                  <option value="'Ubuntu', sans-serif">Ubuntu</option>
                                               </optgroup>
                                               <optgroup label="Serif">
                                                  <option value="'Big Caslon', 'Book Antiqua', 'Palatino Linotype', Georgia, serif">Big Caslon</option>
                                                  <option value="'Calisto MT', 'Bookman Old Style', Bookman, 'Goudy Old Style', Garamond, 'Hoefler Text', 'Bitstream Charter', Georgia, serif">Calisto MT</option>
                                                  <option value="Baskerville, 'Baskerville Old Face', 'Hoefler Text', Garamond, 'Times New Roman', serif">Baskerville</option>
                                                  <option value="Garamond, Baskerville, 'Baskerville Old Face', 'Hoefler Text', 'Times New Roman', serif">Garamond</option>
                                                  <option value="TimesNewRoman, 'Times New Roman', Times, Baskerville, Georgia, serif">Times New Roman</option>
                                               </optgroup>
                                               <optgroup label="Serif | Google Web Fonts">
                                                  <option value="'Arvo', serif">Arvo</option>
                                                  <option value="'Crimson Text', serif">Crimson Text</option>
                                                  <option value="'Droid Serif', serif">Droid Serif</option>
                                                  <option value="'Lora', serif">Lora</option>
                                                  <option value="'Old Standard TT', serif">Old Standard</option>
                                                  <option value="'PT Serif', serif">PT Serif</option>
                                                  <option value="'Vollkorn', serif">Vollkorn</option>
                                               </optgroup>
                                            </select>
                                            <div class="Polaris-Select__Icon">
                                               <span class="Polaris-Icon">
                                                  <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg">
                                                     <path d="M13 8l-3-3-3 3h6zm-.1 4L10 14.9 7.1 12h5.8z" fill-rule="evenodd"></path>
                                                  </svg>
                                               </span>
                                            </div>
                                            <div class="Polaris-Select__Backdrop"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Notification style</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item">
                                        <div class="Polaris-Select">
                                            <select id="desktop-style" class="Polaris-Select__Input" v-model="setting.desktop_style">
                                            <option value="1">Style 1</option> 
                                            <option value="2">Style 2</option> 
                                            <option value="3">Style 3</option> 
                                            <option value="4">Style 4</option> 
                                            <option value="5">Style 5</option> 
                                            <option value="6">Style 6</option> 
                                            <option value="7">Style 7</option>
                                            </select>
                                            <div class="Polaris-Select__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg"><path d="M13 8l-3-3-3 3h6zm-.1 4L10 14.9 7.1 12h5.8z" fill-rule="evenodd"></path></svg></span></div>
                                            <div class="Polaris-Select__Backdrop"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Animation</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item">
                                        <div class="Polaris-Select">
                                        <select id="desktop-animation" class="Polaris-Select__Input"  v-model="setting.desktop_animation">
                                        <option value="fade">Fade</option>
                                         <option value="slide-vertical">Slide vertical</option> 
                                         <option value="slide-horizontal">Slide horizontal</option> 
                                         <option value="fade-slide-vertical">Fade and slide vertical</option> 
                                         <option value="fade-slide-horizontal">Fade and slide horizontal</option>
                                          <option value="flip-x">Flip</option> 
                                          <option value="rotate">Rotate</option> 
                                          <option value="zoom">Zoom</option> 
                                          <option value="zoom-vertical">Zoom vertical</option> 
                                          <option value="bounce">Bounce</option> 
                                          <option value="bounce-vertical">Bounce vertical</option> 
                                          <option value="bounce-horizontal">Bounce horizontal</option>
                                        </select>
                                            <div class="Polaris-Select__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg"><path d="M13 8l-3-3-3 3h6zm-.1 4L10 14.9 7.1 12h5.8z" fill-rule="evenodd"></path></svg></span></div>
                                            <div class="Polaris-Select__Backdrop"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Round corners</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item">
                                        <input type="range" min="0" max="15" v-model="setting.round_corners">
                                        <span>@{{ setting.round_corners }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Border thickness</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item">
                                        <input type="range" min="0" max="5" v-model="setting.border_width">
                                        <span>@{{ setting.border_width }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="panel-7" class="side-panel">
                    <header>
                        <div class="back"><i aria-hidden="true" class="fa fa-chevron-left"></i></div>
                        <h2>Desktop position</h2>
                    </header>
                    <div class="side-panel-content">
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Distance from top/bottom edge</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item">
                                        <input type="range" min="0" max="100" v-model="setting.desktop_space">
                                        <span>@{{ setting.desktop_space }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Placement</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item">
                                       <label for="desktop-placment-top-left" class="Polaris-Choice">
                                          <div class="Polaris-Choice__Control">
                                             <div class="Polaris-RadioButton">
                                                <input type="radio" id="desktop-placment-top-left" name="desktop-placment" aria-describedby="RadioButton1HelpText" value="top-left" class="Polaris-RadioButton__Input" v-model="setting.desktop_placement"> 
                                                <div class="Polaris-RadioButton__Backdrop"></div>
                                                <div class="Polaris-RadioButton__Icon"></div>
                                             </div>
                                          </div>
                                          <div class="Polaris-Choice__Label">Top left</div>
                                       </label>
                                       <label for="desktop-placment-top-center" class="Polaris-Choice">
                                          <div class="Polaris-Choice__Control">
                                             <div class="Polaris-RadioButton">
                                                <input type="radio" id="desktop-placment-top-center" name="desktop-placment" value="top-center" class="Polaris-RadioButton__Input" v-model="setting.desktop_placement"> 
                                                <div class="Polaris-RadioButton__Backdrop"></div>
                                                <div class="Polaris-RadioButton__Icon"></div>
                                             </div>
                                          </div>
                                          <div class="Polaris-Choice__Label">Top center</div>
                                       </label>
                                       <label for="desktop-placment-top-right" class="Polaris-Choice">
                                          <div class="Polaris-Choice__Control">
                                             <div class="Polaris-RadioButton">
                                                <input type="radio" id="desktop-placment-top-right" name="desktop-placment" value="top-right" class="Polaris-RadioButton__Input" v-model="setting.desktop_placement"> 
                                                <div class="Polaris-RadioButton__Backdrop"></div>
                                                <div class="Polaris-RadioButton__Icon"></div>
                                             </div>
                                          </div>
                                          <div class="Polaris-Choice__Label">Top right</div>
                                       </label>
                                       <label for="desktop-placment-bottom-left" class="Polaris-Choice">
                                          <div class="Polaris-Choice__Control">
                                             <div class="Polaris-RadioButton">
                                                <input type="radio" id="desktop-placment-bottom-left" name="desktop-placment" value="bottom-left" class="Polaris-RadioButton__Input" v-model="setting.desktop_placement"> 
                                                <div class="Polaris-RadioButton__Backdrop"></div>
                                                <div class="Polaris-RadioButton__Icon"></div>
                                             </div>
                                          </div>
                                          <div class="Polaris-Choice__Label">Bottom left</div>
                                       </label>
                                       <label for="desktop-placment-bottom-center" class="Polaris-Choice">
                                          <div class="Polaris-Choice__Control">
                                             <div class="Polaris-RadioButton">
                                                <input type="radio" id="desktop-placment-bottom-center" name="desktop-placment" value="bottom-center" class="Polaris-RadioButton__Input" v-model="setting.desktop_placement"> 
                                                <div class="Polaris-RadioButton__Backdrop"></div>
                                                <div class="Polaris-RadioButton__Icon"></div>
                                             </div>
                                          </div>
                                          <div class="Polaris-Choice__Label">Bottom center</div>
                                       </label>
                                       <label for="desktop-placment-bottom-right" class="Polaris-Choice">
                                          <div class="Polaris-Choice__Control">
                                             <div class="Polaris-RadioButton">
                                                <input type="radio" id="desktop-placment-bottom-right" name="desktop-placment" value="bottom-right" class="Polaris-RadioButton__Input" v-model="setting.desktop_placement"> 
                                                <div class="Polaris-RadioButton__Backdrop"></div>
                                                <div class="Polaris-RadioButton__Icon"></div>
                                             </div>
                                          </div>
                                          <div class="Polaris-Choice__Label">Bottom right</div>
                                       </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="panel-8" class="side-panel">
                    <header>
                        <div class="back"><i aria-hidden="true" class="fa fa-chevron-left"></i></div>
                        <h2>Mobile design</h2>
                    </header>
                    <div class="side-panel-content">
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Colors</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item">
                                        <div class="color-container">
                                            <input type="text" id="mobile-background-color" name="mobile_background_color" class="jscolor js-colorpicker"  v-on:change="updateColorModel( 'mobile_background_color', $event )" v-model="setting.mobile_background_color" v-bind:style="{ backgroundColor: setting.mobile_background_color }" /> 
                                            <label for="mobile-background-color">Background</label>
                                        </div>
                                        <div class="color-container">
                                            <input type="text" id="mobile-text-color" name="mobile_text_color" class="jscolor js-colorpicker"  v-on:change="updateColorModel( 'mobile_text_color', $event )" v-model="setting.mobile_text_color" v-bind:style="{ backgroundColor: setting.mobile_text_color }"> 
                                            <label for="mobile-text-color">Text</label>
                                        </div>
                                        <div class="color-container">
                                            <input type="text" id="mobile-date-color" name="mobile_date_color" class="jscolor js-colorpicker"  v-on:change="updateColorModel( 'mobile_date_color', $event )" v-model="setting.mobile_date_color" v-bind:style="{ backgroundColor: setting.mobile_date_color }"> 
                                            <label for="mobile-date-color">Time</label>
                                        </div>
                                        
                                        <div class="color-container">
                                            <input type="text" id="mobile-product-color" name="mobile_link_color" class="jscolor js-colorpicker" v-on:change="updateColorModel( 'mobile_product_color', $event )" v-model="setting.mobile_product_color" v-bind:style="{ backgroundColor: setting.mobile_product_color }"> 
                                            <label for="mobile-product-color">Product title</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Font</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item">
                                        <div class="Polaris-Select">
                                           <select id="mobile-font" class="Polaris-Select__Input"  v-model="setting.mobile_font_family">
                                              <optgroup label="Default">
                                                 <option value="">Theme font</option>
                                              </optgroup>
                                              <optgroup label="Sans-serif">
                                                 <option value="'Avant Garde', Avantgarde, 'Century Gothic', CenturyGothic, 'AppleGothic', sans-serif">Avant Garde</option>
                                                 <option value="'Gill Sans', 'Gill Sans MT', Calibri, sans-serif">Gill Sans</option>
                                                 <option value="'HelveticaNeue', 'Helvetica Neue', Helvetica, Arial, sans-serif">Helvetica Neue</option>
                                                 <option value="Arial, 'Helvetica Neue', Helvetica, sans-serif">Arial</option>
                                                 <option value="Candara, Calibri, Segoe, 'Segoe UI', Optima, Arial, sans-serif">Candara</option>
                                                 <option value="Geneva, Tahoma, Verdana, sans-serif">Geneva</option>
                                              </optgroup>
                                              <optgroup label="Sans-serif | Google Web Fonts">
                                                 <option value="'Droid Sans', sans-serif">Droid Sans</option>
                                                 <option value="'Lato', sans-serif">Lato</option>
                                                 <option value="'Montserrat', sans-serif">Montserrat</option>
                                                 <option value="'Open Sans', sans-serif">Open Sans</option>
                                                 <option value="'PT Sans', sans-serif">PT Sans</option>
                                                 <option value="'Raleway', sans-serif">Raleway</option>
                                                 <option value="'Roboto', sans-serif">Roboto</option>
                                                 <option value="'Source Sans Pro', sans-serif">Source Sans Pro</option>
                                                 <option value="'Ubuntu', sans-serif">Ubuntu</option>
                                              </optgroup>
                                              <optgroup label="Serif">
                                                 <option value="'Big Caslon', 'Book Antiqua', 'Palatino Linotype', Georgia, serif">Big Caslon</option>
                                                 <option value="'Calisto MT', 'Bookman Old Style', Bookman, 'Goudy Old Style', Garamond, 'Hoefler Text', 'Bitstream Charter', Georgia, serif">Calisto MT</option>
                                                 <option value="Baskerville, 'Baskerville Old Face', 'Hoefler Text', Garamond, 'Times New Roman', serif">Baskerville</option>
                                                 <option value="Garamond, Baskerville, 'Baskerville Old Face', 'Hoefler Text', 'Times New Roman', serif">Garamond</option>
                                                 <option value="TimesNewRoman, 'Times New Roman', Times, Baskerville, Georgia, serif">Times New Roman</option>
                                              </optgroup>
                                              <optgroup label="Serif | Google Web Fonts">
                                                 <option value="'Arvo', serif">Arvo</option>
                                                 <option value="'Crimson Text', serif">Crimson Text</option>
                                                 <option value="'Droid Serif', serif">Droid Serif</option>
                                                 <option value="'Lora', serif">Lora</option>
                                                 <option value="'Old Standard TT', serif">Old Standard</option>
                                                 <option value="'PT Serif', serif">PT Serif</option>
                                                 <option value="'Vollkorn', serif">Vollkorn</option>
                                              </optgroup>
                                           </select>
                                           <div class="Polaris-Select__Icon">
                                              <span class="Polaris-Icon">
                                                 <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg">
                                                    <path d="M13 8l-3-3-3 3h6zm-.1 4L10 14.9 7.1 12h5.8z" fill-rule="evenodd"></path>
                                                 </svg>
                                              </span>
                                           </div>
                                           <div class="Polaris-Select__Backdrop"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Notification style</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item">
                                        <div class="Polaris-Select"><select id="mobile-style" class="Polaris-Select__Input"  v-model="setting.mobile_style"><option value="1">Style 1</option> <option value="2">Style 2</option> <option value="3">Style 3</option> <option value="4">Style 4</option> <option value="5">Style 5</option></select>
                                            <div class="Polaris-Select__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg"><path d="M13 8l-3-3-3 3h6zm-.1 4L10 14.9 7.1 12h5.8z" fill-rule="evenodd"></path></svg></span></div>
                                            <div class="Polaris-Select__Backdrop"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Animation</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item">
                                        <div class="Polaris-Select"><select id="mobile-animation" class="Polaris-Select__Input"  v-model="setting.mobile_animation"><option value="fade">Fade</option> <option value="slide-vertical">Slide</option> <option value="fade-slide-vertical">Fade and slide</option> <option value="flip-x">Flip</option> <option value="zoom">Zoom</option> <option value="bounce">Bounce</option> <option value="bounce-vertical">Bounce vertical</option></select>
                                            <div class="Polaris-Select__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg"><path d="M13 8l-3-3-3 3h6zm-.1 4L10 14.9 7.1 12h5.8z" fill-rule="evenodd"></path></svg></span></div>
                                            <div class="Polaris-Select__Backdrop"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="panel-9" class="side-panel">
                    <header>
                        <div class="back"><i aria-hidden="true" class="fa fa-chevron-left"></i></div>
                        <h2>Mobile position</h2>
                    </header>
                    <div class="side-panel-content">
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Distance from top/bottom edge</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item">
                                        <input type="range" min="0" max="100" v-model="setting.mobile_space">
                                        <span>@{{ setting.mobile_space }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h3 class="Polaris-Subheading">Placement</h3>
                            </div>
                            <div class="Polaris-Card__Section">
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item">
                                       <label for="mobile-placment-top" class="Polaris-Choice">
                                          <div class="Polaris-Choice__Control">
                                             <div class="Polaris-RadioButton">
                                                <input type="radio" id="mobile-placment-top" name="mobile-placment" value="top" class="Polaris-RadioButton__Input"  v-model="setting.mobile_placement"> 
                                                <div class="Polaris-RadioButton__Backdrop"></div>
                                                <div class="Polaris-RadioButton__Icon"></div>
                                             </div>
                                          </div>
                                          <div class="Polaris-Choice__Label">Top</div>
                                       </label>
                                       <label for="mobile-placment-bottom" class="Polaris-Choice">
                                          <div class="Polaris-Choice__Control">
                                             <div class="Polaris-RadioButton">
                                                <input type="radio" id="mobile-placment-bottom" name="mobile-placment" value="bottom" class="Polaris-RadioButton__Input"  v-model="setting.mobile_placement"> 
                                                <div class="Polaris-RadioButton__Backdrop"></div>
                                                <div class="Polaris-RadioButton__Icon"></div>
                                             </div>
                                          </div>
                                          <div class="Polaris-Choice__Label">Bottom</div>
                                       </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <footer>
                <div class="buttons"><button type="button" disabled="disabled" class="Polaris-Button Polaris-Button--disabled"><span class="Polaris-Button__Content"><span>Clear</span></span></button> <button type="submit"  class="Polaris-Button  Polaris-Button--primary"><span class="Polaris-Button__Content"><span>Save</span></span></button></div>
            </footer>
        </form> 
        <div id="ui-layout" class="ui-layout " v-bind:class="{ 'desktop': is_desktop , 'mobile':is_mobile }">
            <div class="ui-sections">
                <div class="ui-layout-section">
                    <div class="ui-layout-item">
                        <section id="preview-container" class="ui-layout-panel">
                            <div class="Polaris-Card">
                                <div id="view-notification">
                                    <div class="Polaris-Card__Header">
                                        <h3 class="Polaris-Heading">Preview notifications</h3>
                                    </div>
                                    <div class="Polaris-Card__Section">
                                        <div id="preview">
                                            <div v-if="is_desktop === true">
                                            
                                                <div id="recently-notification" class="r-container r-hide  r-src-web r-scheme-light" v-bind:class="desktop_classes"  v-bind:style="{ bottom: setting.desktop_space+'px', fontFamily: setting.desktop_font_family}">
                                                
                                                    <div class="r-inner"  v-bind:style="{ color:  setting.desktop_text_color, backgroundColor: setting.desktop_background_color, borderColor: setting.desktop_border_color }">
                                                        <div class="r-thumb"><img alt="" src=""></div>
                                                        <div class="r-content">
                                                            <div class="r-message"><span class="r-product-title" v-bind:style="{ color:  setting.desktop_product_color }"></span></div>
                                                            <div class="r-time" v-bind:style="{ color:  setting.desktop_date_color }"></div>
                                                        </div>
                                                    </div>
                                                    <div class="r-close"></div>
                                                </div>
                                            </div>
                                            <div v-if="is_mobile === true">
                                            
                                                <div id="recently-notification" class="r-container r-hide r-src-web r-scheme-light" v-bind:class="mobile_classes"  v-bind:style="{ bottom: setting.mobile_space+'px', fontFamily: setting.mobile_font_family}" >
                                                
                                                    <div class="r-inner"  v-bind:style="{ color:  setting.mobile_text_color, backgroundColor: setting.mobile_background_color }">
                                                        <div class="r-thumb"><img alt="" src=""></div>
                                                        <div class="r-content">
                                                            <div class="r-message"><span class="r-product-title"  v-bind:style="{ color:  setting.mobile_product_color }"></span></div>
                                                            <div class="r-time"  v-bind:style="{ color:  setting.mobile_date_color }"></div>
                                                        </div>
                                                    </div>
                                                    <div class="r-close"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="Polaris-Card__Section">
                                        <div class="Polaris-Stack Polaris-Stack--alignmentCenter">
                                            <div class="Polaris-Stack__Item">
                                                <div class="Polaris-ButtonGroup Polaris-ButtonGroup--segmented">
                                                    <div aria-label="Previous notification" class="Polaris-ButtonGroup__Item hint--bottom hint--rounded hint--bounce"><button type="button" class="Polaris-Button Polaris-Button--disabled"><span class="Polaris-Button__Content"><span><i class="fa fa-chevron-left"></i></span></span></button></div>
                                                    <div aria-label="Next notification" class="Polaris-ButtonGroup__Item hint--bottom hint--rounded hint--bounce"><button type="button" class="Polaris-Button"><span class="Polaris-Button__Content"><span><i class="fa fa-chevron-right"></i></span></span></button></div>
                                                </div>
                                            </div>
                                            <div class="Polaris-Stack__Item Polaris-Stack__Item--fill"><span class="Polaris-Badge Polaris-Badge--statusInfo no-select">1 / 14</span></div>
                                            <div class="Polaris-Stack__Item"><button type="button" class="Polaris-Button"><span class="Polaris-Button__Content"><span>Edit</span></span></button></div>
                                            <div class="Polaris-Stack__Item"><button type="button" class="Polaris-Button Polaris-Button--destructive"><span class="Polaris-Button__Content"><span>Delete</span></span></button></div>
                                        </div>
                                    </div> -->
                                </div>
                                <!---->
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="info-bar">
            <section id="analytics" class="ui-sidebar-section">
                <section id="section-chart-selector" class="ui-sidebar-section-item section-top">
                    <div class="Polaris-FormLayout">
                        <div role="group">
                            <div class="Polaris-FormLayout__Items">
                                <div class="Polaris-FormLayout__Item">
                                    <div class="Polaris-Select"><select class="Polaris-Select__Input" v-model="analytics_type" v-on:change="refreshAnalytics"><option value="views">Views</option> <option value="clicks">Clicks</option> <option value="purchases">Purchases</option></select>
                                        <div class="Polaris-Select__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg"><path d="M13 8l-3-3-3 3h6zm-.1 4L10 14.9 7.1 12h5.8z" fill-rule="evenodd"></path></svg></span></div>
                                        <div class="Polaris-Select__Backdrop"></div>
                                    </div>
                                </div>
                                <div class="Polaris-FormLayout__Item">
                                    <div class="Polaris-Select"><select class="Polaris-Select__Input" v-model="analytics_group" v-on:change="refreshAnalytics"><option value="month">Last 12 months</option> <option value="week">Last 10 weeks</option> <option value="day">Last 30 days</option></select>
                                        <div class="Polaris-Select__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg"><path d="M13 8l-3-3-3 3h6zm-.1 4L10 14.9 7.1 12h5.8z" fill-rule="evenodd"></path></svg></span></div>
                                        <div class="Polaris-Select__Backdrop"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="section-chart" class="ui-sidebar-section-item section-top">
                    <div id="analytics-chart" >
                        <commit-chart :chart-data="analyticsData"></commit-chart>
                    </div>
                    <div id="analytics-chart-loading">
                        <div class="chart-loading" style="display: none;"></div>
                    </div>
                </section>
                <section class="ui-sidebar-section-item">
                    <div class="ui-sidebar-grid">
                        <div class="ui-sidebar-grid-cell">
                            <div class="Polaris-Subheading">Today's views</div>
                        </div>
                        <div class="ui-sidebar-grid-cell">
                            <div class="Polaris-Subheading">Today's Clicks</div>
                        </div>
                        <div class="ui-sidebar-grid-cell">
                            <div class="Polaris-Subheading">Today's Purchases</div>
                        </div>
                    </div>
                    <div class="ui-sidebar-grid">
                        <div class="ui-sidebar-grid-cell">
                            <div class="number Polaris-DisplayText Polaris-DisplayText--sizeMedium">@{{ view_count }}</div>
                        </div>
                        <div class="ui-sidebar-grid-cell">
                            <div class="number Polaris-DisplayText Polaris-DisplayText--sizeMedium">@{{ clicked_count }}</div>
                        </div>
                        <div class="ui-sidebar-grid-cell">
                            <div class="number Polaris-DisplayText Polaris-DisplayText--sizeMedium">@{{ purchased_count }}</div>
                        </div>
                    </div>
                </section>
                <section class="ui-sidebar-section-item">
                    <h2 class="Polaris-Heading">Realtime activity</h2>
                    <div id="analytics-feed-connecting" class=""></div>
                    <ul id="analytics-feed" class="stream clearfix">
                      <li v-for="stat in reverseOrder(stats)">
                         <div class="feed-item">
                            <div class="flag-icon flag-icon-squared"> <img v-bind:src="'/images/flags/'+stat.country_iso+'.png'"></div> 
                           <div v-if="stat.mobile == 0">
                            Someone just
                            <span v-if="stat.action == 1"  class="feed-badge">Clicked</span><span class="feed-badge" v-else>Viewed</span> <span class="feed-title">@{{ stat.title }}</span> on a desktop device.
                          </div>
                          <div v-else>
                            Someone just
                            <span v-if="stat.action == 1"  class="feed-badge">Clicked</span><span class="feed-badge" v-else>Viewed</span> <span class="feed-title">@{{ stat.title }}</span> on a mobile device.
                          </div>
                        </div>
                         
                      </li>
                    </ul>
                </section>
            </section> <a id="right-fullscreen-toggle" aria-label="Toggle sidebar"><i aria-hidden="true" class="fa fa-caret-right"></i> <i aria-hidden="true" class="fa fa-caret-left"></i></a></div>
    </div>
    
  


    
        
@endsection

@section('scripts')
    @parent

    <script src="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.1/rangeslider.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript">


    $(document).ready(function(){
        $('input[type="range"]').rangeslider();
        $('.tabs li a').on('click', function(){
            $('.tabs li').removeClass('active');
            $(this).parent().addClass('active');
            $('.nav-panel').removeClass('active');
            $('#'+$(this).attr('data-nav-panel-id')).addClass('active');
            if($(this).attr('data-nav-type') == 'desktop'){
                $('#ui-layout').removeClass('mobile');
                $('#ui-layout').addClass('desktop');
            }
            if($(this).attr('data-nav-type') == 'mobile'){
                $('#ui-layout').removeClass('desktop');
                $('#ui-layout').addClass('mobile');
            }
        });

        $('.nav-panel li a').on('click', function(){
            
            $('.side-panel').removeClass('side-panel-active');
            $('#'+$(this).attr('data-panel-id')).addClass('side-panel-active');
        });

        $('.side-panel .back').on('click', function(){
            
            $('.side-panel').removeClass('side-panel-active');
        });
    });

</script>
    <script type="text/javascript">
        window.mainPageTitle = 'Main Page';
            ShopifyApp.ready(function(){
                ShopifyApp.Bar.initialize({
                    title: 'Dashboard'
            });
        });
    </script>
@endsection