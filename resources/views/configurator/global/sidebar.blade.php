<div id="sideBar">
    <div class="sideBar sideBar-parent">
        <ul>
            <li data-sidebar="style">
                <div>
                    <div class="icon">
                        <span>
                            <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-style-round.png') }}" alt="">
                        </span>
                    </div>
                    <p class="title">Style</p>
                </div>
            </li>
            <li data-sidebar="outside">
                <div>
                    <div class="icon">
                        <span>
                            <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-main-color.png') }}" alt="">
                        </span>
                    </div>
                    <p class="title">Primary</p>
                </div>
            </li>
            <li data-sidebar="inside">
                <div>
                    <div class="icon">
                        <span>
                            <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-inside-color.png') }}" alt="">
                        </span>
                    </div>
                    <p class="title">Shank</p>
                </div>
            </li>
            <li data-sidebar="edge">
                <div>
                    <div class="icon">
                        <span>
                            <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-edge-color.png') }}" alt="">
                        </span>
                    </div>
                    <p class="title">Edge</p>
                </div>
            </li>
            <li data-sidebar="accent">
                <div>
                    <div class="icon">
                        <span>
                            <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-accent.png') }}" alt="">
                        </span>
                    </div>
                    <p class="title">Accent</p>
                </div>
            </li>
            <li data-sidebar="width">
                <div>
                    <div class="icon">
                        <span>
                            <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-width.png') }}" alt="">
                        </span>
                    </div>
                    <p class="title">Width</p>
                </div>
            </li>
            <li data-sidebar="engraving">
                <div>
                    <div class="icon">
                        <span>
                            <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-engraving.png') }}" alt="">
                        </span>
                    </div>
                    <p class="title">Engraving</p>
                </div>
            </li>
            <li data-sidebar="try-it-on">
                <div>
                    <div class="icon">
                        <span>
                            <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-tryiton.png') }}" alt="">
                        </span>
                    </div>
                    <p class="title">Try It On</p>
                </div>
            </li>
        </ul>
    </div>

    <div id="formArray">

        <div class="sideBar sideBar-level2" id="style" data-step="1">
            <div class="sideBar-block">
                <p class="sideBar-block-title">Choose Style</p>
                <ul>
                    <li>
                        <input type="radio" name="style" value="dome" id="styleDome" data-section="style">
                        <label for="styleDome">
                            <div class="icon">
                                <span>
                                    <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-style-round.png') }}" alt="">
                                </span>
                            </div>
                            <p class="title">Dome</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="style" value="flat" id="styleFlat" data-section="style" data-controls="bezel">
                        <label for="styleFlat">
                            <div class="icon">
                                <span>
                                    <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-style-flat.png') }}" alt="">
                                </span>
                            </div>
                            <p class="title">Flat</p>
                        </label>
                    </li>

                    <li>
                        <input type="radio" name="style" value="bevelEdge" id="bevelBevelEdge" data-section="style">
                        <label for="bevelBevelEdge">
                            <div class="icon">
                                <span>
                                    <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-style-flat-bevel.png') }}" alt="">
                                </span>
                            </div>
                            <p class="title">Bevel Edge</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="style" value="stepEdge" id="bevelStepEdge" data-section="style">
                        <label for="bevelStepEdge">
                            <div class="icon">
                                <span>
                                    <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-style-step-bevel.png') }}" alt="">
                                </span>
                            </div>
                            <p class="title">Step Edge</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="style" value="stepFlat" id="bevelStepFlat" data-section="style">
                        <label for="bevelStepFlat">
                            <div class="icon">
                                <span>
                                    <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-style-stepflat.png') }}" alt="">
                                </span>
                            </div>
                            <p class="title">Step Flat</p>
                        </label>
                    </li>
                </ul>
            </div>

            <div class="acceptCancel">
                <div class="accept">
                    <span>
                        <i class="fal fa-check"></i>
                        <p>Accept</p>
                    </span>
                </div>

                <div class="cancel">
                    <span>
                        <i class="fal fa-times"></i>
                        <p>Cancel</p>
                    </span>
                </div>

                <div class="next">
                    <span>
                        <i class="fal fa-caret-right"></i>
                        <p>Next</p>
                    </span>
                </div>
            </div>
        </div>

        <div class="sideBar sideBar-level2" id="outside" data-step="2">
            <div class="sideBar-block">
                <p class="sideBar-block-title">Choose Outside Color</p>
                <ul>
                    <li>
                        <input type="radio" name="primaryColor" value="black" id="primaryBlack" data-color="black" data-section="primary">
                        <label for="primaryBlack">
                            <div class="icon">
                                <span class="black"></span>
                            </div>
                            <p class="title">Dark Knight</p>
                        </label>
                    </li>

                    <li>
                        <input type="radio" name="primaryColor" value="grey" id="primaryGrey" data-color="grey" data-section="primary">
                        <label for="primaryGrey">
                            <div class="icon">
                                <span class="grey"></span>
                            </div>
                            <p class="title">Galena Grey</p>
                        </label>
                    </li>

                    <li>
                        <input type="radio" name="primaryColor" value="gunmetal" id="primaryGunmetal" data-color="gunmetal" data-section="primary">
                        <label for="primaryGunmetal">
                            <div class="icon">
                                <span class="gunmetal"></span>
                            </div>
                            <p class="title">Moonlit Graphite</p>
                        </label>
                    </li>

                    <li>
                        <input type="radio" name="primaryColor" value="blue" id="primaryBlue" data-color="blue" data-section="primary">
                        <label for="primaryBlue">
                            <div class="icon">
                                <span class="blue"></span>
                            </div>
                            <p class="title">Empire Blue</p>
                        </label>
                    </li>

                    <li>
                        <input type="radio" name="primaryColor" value="yellowGold" id="primaryYellowGold" data-color="yellowGold" data-section="primary">
                        <label for="primaryYellowGold">
                            <div class="icon">
                                <span class="yellowGold"></span>
                            </div>
                            <p class="title">Yellow Gold</p>
                        </label>
                    </li>

                    <li>
                        <input type="radio" name="primaryColor" value="roseGold" id="primaryRoseGold" data-color="roseGold" data-section="primary">
                        <label for="primaryRoseGold">
                            <div class="icon">
                                <span class="roseGold"></span>
                            </div>
                            <p class="title">Rose Gold</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="primaryColor" value="fuschia" id="primaryFuschia" data-color="fuschia" data-section="primary">
                        <label for="primaryFuschia">
                            <div class="icon">
                                <span class="fuschia"></span>
                            </div>
                            <p class="title">Cosmic Flare</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="primaryColor" value="purple" id="primaryPurple" data-color="purple" data-section="primary">
                        <label for="primaryPurple">
                            <div class="icon">
                                <span class="purple"></span>
                            </div>
                            <p class="title">Royal Bliss</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="primaryColor" value="red" id="primaryRed" data-color="red" data-section="primary">
                        <label for="primaryRed">
                            <div class="icon">
                                <span class="red"></span>
                            </div>
                            <p class="title">Crimson Allure</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="primaryColor" value="green" id="primaryGreen" data-color="green" data-section="primary">
                        <label for="primaryGreen">
                            <div class="icon">
                                <span class="green"></span>
                            </div>
                            <p class="title">Emerald Zing</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="primaryColor" value="teal" id="primaryTeal" data-color="teal" data-section="primary">
                        <label for="primaryTeal">
                            <div class="icon">
                                <span class="teal"></span>
                            </div>
                            <p class="title">Aqua Teal</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="primaryColor" value="copper" id="primaryCopper" data-color="copper" data-section="primary">
                        <label for="primaryCopper">
                            <div class="icon">
                                <span class="copper"></span>
                            </div>
                            <p class="title">Copper Sun</p>
                        </label>
                    </li>
                </ul>
            </div>

            <div class="acceptCancel">
                <div class="accept">
                    <span>
                        <i class="fal fa-check"></i>
                        <p>Accept</p>
                    </span>
                </div>

                <div class="cancel">
                    <span>
                        <i class="fal fa-times"></i>
                        <p>Cancel</p>
                    </span>
                </div>

                <div class="next">
                    <span>
                        <i class="fal fa-caret-right"></i>
                        <p>Next</p>
                    </span>
                </div>
            </div>
        </div>

        <div class="sideBar sideBar-level2" id="inside" data-step="3">
            <div class="sideBar-block">
                <p class="sideBar-block-title">Choose Shank Color</p>
                <ul>
                    <li>
                        <input type="radio" name="shankColor" value="black" id="shankBlack" data-color="black" data-section="shank">
                        <label for="shankBlack">
                            <div class="icon">
                                <span class="black"></span>
                            </div>
                            <p class="title">Dark Knight</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="shankColor" value="grey" id="shankGrey" data-color="grey" data-section="shank">
                        <label for="shankGrey">
                            <div class="icon">
                                <span class="grey"></span>
                            </div>
                            <p class="title">Galena Grey</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="shankColor" value="gunmetal" id="shankGunmetal" data-color="gunmetal" data-section="shank">
                        <label for="shankGunmetal">
                            <div class="icon">
                                <span class="gunmetal"></span>
                            </div>
                            <p class="title">Moonlit Graphite</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="shankColor" value="blue" id="shankBlue" data-color="blue" data-section="shank">
                        <label for="shankBlue">
                            <div class="icon">
                                <span class="blue"></span>
                            </div>
                            <p class="title">Empire Blue</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="shankColor" value="yellowGold" id="shankYellowGold" data-color="yellowGold" data-section="shank">
                        <label for="shankYellowGold">
                            <div class="icon">
                                <span class="yellowGold"></span>
                            </div>
                            <p class="title">Yellow Gold</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="shankColor" value="roseGold" id="shankRoseGold" data-color="roseGold" data-section="shank">
                        <label for="shankRoseGold">
                            <div class="icon">
                                <span class="roseGold"></span>
                            </div>
                            <p class="title">Rose Gold</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="shankColor" value="fuschia" id="shankFuschia" data-color="fuschia" data-section="shank">
                        <label for="shankFuschia">
                            <div class="icon">
                                <span class="fuschia"></span>
                            </div>
                            <p class="title">Cosmic Flare</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="shankColor" value="purple" id="shankPurple" data-color="purple" data-section="shank">
                        <label for="shankPurple">
                            <div class="icon">
                                <span class="purple"></span>
                            </div>
                            <p class="title">Royal Bliss</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="shankColor" value="red" id="shankRed" data-color="red" data-section="shank">
                        <label for="shankRed">
                            <div class="icon">
                                <span class="red"></span>
                            </div>
                            <p class="title">Crimson Allure</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="shankColor" value="green" id="shankGreen" data-color="green" data-section="shank">
                        <label for="shankGreen">
                            <div class="icon">
                                <span class="green"></span>
                            </div>
                            <p class="title">Emerald Zing</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="shankColor" value="teal" id="shankTeal" data-color="teal" data-section="shank">
                        <label for="shankTeal">
                            <div class="icon">
                                <span class="teal"></span>
                            </div>
                            <p class="title">Aqua Teal</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="shankColor" value="copper" id="shankCopper" data-color="copper" data-section="shank">
                        <label for="shankCopper">
                            <div class="icon">
                                <span class="copper"></span>
                            </div>
                            <p class="title">Copper Sun</p>
                        </label>
                    </li>
                </ul>
            </div>

            <div class="acceptCancel">
                <div class="accept">
                    <span>
                        <i class="fal fa-check"></i>
                        <p>Accept</p>
                    </span>
                </div>

                <div class="cancel">
                    <span>
                        <i class="fal fa-times"></i>
                        <p>Cancel</p>
                    </span>
                </div>

                <div class="next">
                    <span>
                        <i class="fal fa-caret-right"></i>
                        <p>Next</p>
                    </span>
                </div>
            </div>

        </div>

        <div class="sideBar sideBar-level2" id="edge" data-step="4">
            <div class="sideBar-block">
                <p class="sideBar-block-title">
                    Choose Edge Color
                </p>
                <ul>
                    <li>
                        <input type="radio" name="edgeColor" value="black" id="edgeBlack" data-color="black" data-section="edge">
                        <label for="edgeBlack">
                            <div class="icon">
                                <span class="black"></span>
                            </div>
                            <p class="title">Dark Knight</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeColor" value="grey" id="edgeGrey" data-color="grey" data-section="edge">
                        <label for="edgeGrey">
                            <div class="icon">
                                <span class="grey"></span>
                            </div>
                            <p class="title">Galena Grey</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeColor" value="gunmetal" id="edgeGunmetal" data-color="gunmetal" data-section="edge">
                        <label for="edgeGunmetal">
                            <div class="icon">
                                <span class="gunmetal"></span>
                            </div>
                            <p class="title">Moonlit Graphite</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeColor" value="blue" id="edgeBlue" data-color="blue" data-section="edge">
                        <label for="edgeBlue">
                            <div class="icon">
                                <span class="blue"></span>
                            </div>
                            <p class="title">Empire Blue</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeColor" value="yellowGold" id="edgeYellowGold" data-color="yellowGold" data-section="edge">
                        <label for="edgeYellowGold">
                            <div class="icon">
                                <span class="yellowGold"></span>
                            </div>
                            <p class="title">Yellow Gold</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeColor" value="roseGold" id="edgeRoseGold" data-color="roseGold" data-section="edge">
                        <label for="edgeRoseGold">
                            <div class="icon">
                                <span class="roseGold"></span>
                            </div>
                            <p class="title">Rose Gold</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeColor" value="fuschia" id="edgeFuschia" data-color="fuschia" data-section="edge">
                        <label for="edgeFuschia">
                            <div class="icon">
                                <span class="fuschia"></span>
                            </div>
                            <p class="title">Cosmic Flare</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeColor" value="purple" id="edgePurple" data-color="purple" data-section="edge">
                        <label for="edgePurple">
                            <div class="icon">
                                <span class="purple"></span>
                            </div>
                            <p class="title">Royal Bliss</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeColor" value="red" id="edgeRed" data-color="red" data-section="edge">
                        <label for="edgeRed">
                            <div class="icon">
                                <span class="red"></span>
                            </div>
                            <p class="title">Crimson Allure</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeColor" value="green" id="edgeGreen" data-color="green" data-section="edge">
                        <label for="edgeGreen">
                            <div class="icon">
                                <span class="green"></span>
                            </div>
                            <p class="title">Emerald Zing</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeColor" value="teal" id="edgeTeal" data-color="teal" data-section="edge">
                        <label for="edgeTeal">
                            <div class="icon">
                                <span class="teal"></span>
                            </div>
                            <p class="title">Aqua Teal</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeColor" value="copper" id="edgeCopper" data-color="copper" data-section="edge">
                        <label for="edgeCopper">
                            <div class="icon">
                                <span class="copper"></span>
                            </div>
                            <p class="title">Copper Sun</p>
                        </label>
                    </li>
                </ul>
            </div>
            <div class="sideBar-block">
                <p class="sideBar-block-title">Choose Edge Edge Color</p>
                <ul>
                    <li>
                        <input type="radio" name="edgeEdgeColor" value="black" id="edgeEdgeBlack" data-color="black" data-section="edgeEdge">
                        <label for="edgeEdgeBlack">
                            <div class="icon">
                                <span class="black"></span>
                            </div>
                            <p class="title">Dark Knight</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeEdgeColor" value="grey" id="edgeEdgeGrey" data-color="grey" data-section="edgeEdge">
                        <label for="edgeEdgeGrey">
                            <div class="icon">
                                <span class="grey"></span>
                            </div>
                            <p class="title">Galena Grey</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeEdgeColor" value="gunmetal" id="edgeEdgeGunmetal" data-color="gunmetal" data-section="edgeEdge">
                        <label for="edgeEdgeGunmetal">
                            <div class="icon">
                                <span class="gunmetal"></span>
                            </div>
                            <p class="title">Moonlit Graphite</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeEdgeColor" value="blue" id="edgeEdgeBlue" data-color="blue" data-section="edgeEdge">
                        <label for="edgeEdgeBlue">
                            <div class="icon">
                                <span class="blue"></span>
                            </div>
                            <p class="title">Empire Blue</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeEdgeColor" value="yellowGold" id="edgeEdgeYellowGold" data-color="yellowGold" data-section="edgeEdge">
                        <label for="edgeEdgeYellowGold">
                            <div class="icon">
                                <span class="yellowGold"></span>
                            </div>
                            <p class="title">Yellow Gold</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeEdgeColor" value="roseGold" id="edgeEdgeRoseGold" data-color="roseGold" data-section="edgeEdge">
                        <label for="edgeEdgeRoseGold">
                            <div class="icon">
                                <span class="roseGold"></span>
                            </div>
                            <p class="title">Rose Gold</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeEdgeColor" value="fuschia" id="edgeEdgeFuschia" data-color="fuschia" data-section="edgeEdge">
                        <label for="edgeEdgeFuschia">
                            <div class="icon">
                                <span class="fuschia"></span>
                            </div>
                            <p class="title">Cosmic Flare</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeEdgeColor" value="purple" id="edgeEdgePurple" data-color="purple" data-section="edgeEdge">
                        <label for="edgeEdgePurple">
                            <div class="icon">
                                <span class="purple"></span>
                            </div>
                            <p class="title">Royal Bliss</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeEdgeColor" value="red" id="edgeEdgeRed" data-color="red" data-section="edgeEdge">
                        <label for="edgeEdgeRed">
                            <div class="icon">
                                <span class="red"></span>
                            </div>
                            <p class="title">Crimson Allure</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeEdgeColor" value="green" id="edgeEdgeGreen" data-color="green" data-section="edgeEdge">
                        <label for="edgeEdgeGreen">
                            <div class="icon">
                                <span class="green"></span>
                            </div>
                            <p class="title">Emerald Zing</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeEdgeColor" value="teal" id="edgeEdgeTeal" data-color="teal" data-section="edgeEdge">
                        <label for="edgeEdgeTeal">
                            <div class="icon">
                                <span class="teal"></span>
                            </div>
                            <p class="title">Aqua Teal</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="edgeEdgeColor" value="copper" id="edgeEdgeCopper" data-color="copper" data-section="edgeEdge">
                        <label for="edgeEdgeCopper">
                            <div class="icon">
                                <span class="copper"></span>
                            </div>
                            <p class="title">Copper Sun</p>
                        </label>
                    </li>
                </ul>
            </div>

            <div class="acceptCancel">
                <div class="accept">
                    <span>
                        <i class="fal fa-check"></i>
                        <p>Accept</p>
                    </span>
                </div>

                <div class="cancel">
                    <span>
                        <i class="fal fa-times"></i>
                        <p>Cancel</p>
                    </span>
                </div>

                <div class="next">
                    <span>
                        <i class="fal fa-caret-right"></i>
                        <p>Next</p>
                    </span>
                </div>
            </div>

        </div>

        <div class="sideBar sideBar-level2" id="accent" data-step="5">
            <div class="sideBar-block">
                <p class="sideBar-block-title">Choose Accent Style</p>
                <ul>
                    <li>
                        <input type="radio" name="accent" value="none" id="accentNone" data-section="accent">
                        <label for="accentNone">
                            <div class="icon">
                                <span>
                                    <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-accent-none.png') }}" alt="">
                                </span>
                            </div>
                            <p class="title">None</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="accent" value="thin" id="accentThin" data-section="accent">
                        <label for="accentThin">
                            <div class="icon">
                                <span>
                                    <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-accent-center.png') }}" alt="">
                                </span>
                            </div>
                            <p class="title">Thin</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="accent" value="thick" id="accentThick" data-section="accent">
                        <label for="accentThick">
                            <div class="icon">
                                <span>
                                    <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-accent-thick.png') }}" alt="">
                                </span>
                            </div>
                            <p class="title">Thick</p>
                        </label>
                    </li>
                </ul>
            </div>


            <div class="sideBar-block">
                <p class="sideBar-block-title">Choose Accent Location</p>
                <ul>
                    <li>
                        <input type="radio" name="accentLine" value="center" id="accentLineCenter" data-section="accentLine">
                        <label for="accentLineCenter">
                            <div class="icon">
                                <span>
                                    <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-accent-center.png') }}" alt="">
                                </span>
                            </div>
                            <p class="title">Center</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="accentLine" value="offset" id="accentLineOffset" data-section="accentLine">
                        <label for="accentLineOffset">
                            <div class="icon">
                                <span>
                                    <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-accent-offset.png') }}" alt="">
                                </span>
                            </div>
                            <p class="title">Offset</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="accentLine" value="double" id="accentLineDouble" data-section="accentLine">
                        <label for="accentLineDouble">
                            <div class="icon">
                                <span>
                                    <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-accent-double.png') }}" alt="">
                                </span>
                            </div>
                            <p class="title">Double</p>
                        </label>
                    </li>
                </ul>
            </div>


            <div class="sideBar-block">
                <p class="sideBar-block-title">Two Tone</p>
                <ul>
                    <li>
                        <input type="radio" name="twoTone" value="yes" id="twoToneYes" data-section="twoTone">
                        <label for="twoToneYes">
                            <div class="icon">
                                <span>
                                    <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-twotone-yes.png') }}" alt="">
                                </span>
                            </div>
                            <p class="title">Yes</p>
                        </label>
                    </li>

                    <li>
                        <input type="radio" name="twoTone" value="no" id="twoToneNo" data-section="twoTone">
                        <label for="twoToneNo">
                            <div class="icon">
                                <span>
                                    <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-twotone-no.png') }}" alt="">
                                </span>
                            </div>
                            <p class="title">No</p>
                        </label>
                    </li>

                </ul>
            </div>

            <div class="sideBar-block">
                <p class="sideBar-block-title">Two Tone Position</p>
                <ul>
                    <li>
                        <input type="radio" name="position" value="left" id="positionLeft" data-section="position">
                        <label for="positionLeft">
                            <div class="icon">
                                <span>
                                    <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-twotone-left.png') }}" alt="">
                                </span>
                            </div>
                            <p class="title">Left</p>
                        </label>
                    </li>

                    <li>
                        <input type="radio" name="position" value="right" id="positionRight" data-section="position">
                        <label for="positionRight">
                            <div class="icon">
                                <span>
                                    <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-twotone-right.png') }}" alt="">
                                </span>
                            </div>
                            <p class="title">Right</p>
                        </label>
                    </li>

                </ul>
            </div>

            <div class="sideBar-block">
                <p class="sideBar-block-title">Choose Accent Color</p>
                <ul>
                    <li>
                        <input type="radio" name="accentColor" value="black" id="accentColorBlack" data-color="black" data-section="accentColor">
                        <label for="accentColorBlack">
                            <div class="icon">
                                <span class="black"></span>
                            </div>
                            <p class="title">Dark Knight</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="accentColor" value="grey" id="accentColorGrey" data-color="grey" data-section="accentColor">
                        <label for="accentColorGrey">
                            <div class="icon">
                                <span class="grey"></span>
                            </div>
                            <p class="title">Galena Grey</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="accentColor" value="gunmetal" id="accentColorGunmetal" data-color="gunmetal" data-section="accentColor">
                        <label for="accentColorGunmetal">
                            <div class="icon">
                                <span class="gunmetal"></span>
                            </div>
                            <p class="title">Moonlit Graphite</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="accentColor" value="blue" id="accentColorBlue" data-color="blue" data-section="accentColor">
                        <label for="accentColorBlue">
                            <div class="icon">
                                <span class="blue"></span>
                            </div>
                            <p class="title">Empire Blue</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="accentColor" value="yellowGold" id="accentColorYellowGold" data-color="yellowGold" data-section="accentColor">
                        <label for="accentColorYellowGold">
                            <div class="icon">
                                <span class="yellowGold"></span>
                            </div>
                            <p class="title">Yellow Gold</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="accentColor" value="roseGold" id="accentColorRoseGold" data-color="roseGold" data-section="accentColor">
                        <label for="accentColorRoseGold">
                            <div class="icon">
                                <span class="roseGold"></span>
                            </div>
                            <p class="title">Rose Gold</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="accentColor" value="fuschia" id="accentColorFuschia" data-color="fuschia" data-section="accentColor">
                        <label for="accentColorFuschia">
                            <div class="icon">
                                <span class="fuschia"></span>
                            </div>
                            <p class="title">Cosmic Flare</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="accentColor" value="purple" id="accentColorPurple" data-color="purple" data-section="accentColor">
                        <label for="accentColorPurple">
                            <div class="icon">
                                <span class="purple"></span>
                            </div>
                            <p class="title">Royal Bliss</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="accentColor" value="red" id="accentColorRed" data-color="red" data-section="accentColor">
                        <label for="accentColorRed">
                            <div class="icon">
                                <span class="red"></span>
                            </div>
                            <p class="title">Crimson Allure</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="accentColor" value="green" id="accentColorGreen" data-color="green" data-section="accentColor">
                        <label for="accentColorGreen">
                            <div class="icon">
                                <span class="green"></span>
                            </div>
                            <p class="title">Emerald Zing</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="accentColor" value="teal" id="accentColorTeal" data-color="teal" data-section="accentColor">
                        <label for="accentColorTeal">
                            <div class="icon">
                                <span class="teal"></span>
                            </div>
                            <p class="title">Aqua Teal</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="accentColor" value="copper" id="accentColorCopper" data-color="copper" data-section="accentColor">
                        <label for="accentColorCopper">
                            <div class="icon">
                                <span class="copper"></span>
                            </div>
                            <p class="title">Copper Sun</p>
                        </label>
                    </li>
                </ul>
            </div>

            <div class="acceptCancel">
                <div class="accept">
                    <span>
                        <i class="fal fa-check"></i>
                        <p>Accept</p>
                    </span>
                </div>

                <div class="cancel">
                    <span>
                        <i class="fal fa-times"></i>
                        <p>Cancel</p>
                    </span>
                </div>

                <div class="next">
                    <span>
                        <i class="fal fa-caret-right"></i>
                        <p>Next</p>
                    </span>
                </div>
            </div>
        </div>

        <div class="sideBar sideBar-level2" id="width" data-step="6">
            <div class="sideBar-block">
                <p class="sideBar-block-title">Choose Width</p>
                <ul>
                    <li>
                        <input type="radio" name="width" value="4" id="widthFour" data-section="width">
                        <label for="widthFour">
                            <div class="icon">
                                <span>
                                    <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-width-4mm.png') }}" alt="">
                                </span>
                            </div>
                            <p class="title">4 mm</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="width" value="6" id="widthSix" data-section="width">
                        <label for="widthSix">
                            <div class="icon">
                                <span>
                                    <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-width-6mm.png') }}" alt="">
                                </span>
                            </div>
                            <p class="title">6 mm</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="width" value="8" id="widthEight" data-section="width">
                        <label for="widthEight">
                            <div class="icon">
                                <span>
                                    <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-width-8mm.png') }}" alt="">
                                </span>
                            </div>
                            <p class="title">8 mm</p>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="width" value="10" id="widthTen" data-section="width">
                        <label for="widthTen">
                            <div class="icon">
                                <span>
                                    <img class="img-fluid" src="{{ asset('images/sidebar-icons/icon-width-10mm.png') }}" alt="">
                                </span>
                            </div>
                            <p class="title">10 mm</p>
                        </label>
                    </li>
                </ul>
            </div>
            <div class="acceptCancel">
                <div class="accept">
                    <span>
                        <i class="fal fa-check"></i>
                        <p>Accept</p>
                    </span>
                </div>

                <div class="cancel">
                    <span>
                        <i class="fal fa-times"></i>
                        <p>Cancel</p>
                    </span>
                </div>

                <div class="next">
                    <span>
                        <i class="fal fa-caret-right"></i>
                        <p>Next</p>
                    </span>
                </div>
            </div>
        </div>

        <div class="sideBar sideBar-level2" id="engraving" data-step="7">
            <div class="sideBar-block">
                <p class="sideBar-block-title">Add Engraving</p>
                <ul>
                    <li>
                        Insert Engraving
                    </li>
                </ul>
            </div>

            <div class="acceptCancel">
                <div class="accept">
                    <span>
                        <i class="fal fa-check"></i>
                        <p>Accept</p>
                    </span>
                </div>

                <div class="cancel">
                    <span>
                        <i class="fal fa-times"></i>
                        <p>Cancel</p>
                    </span>
                </div>

                <div class="next">
                    <span>
                        <i class="fal fa-caret-right"></i>
                        <p>Next</p>
                    </span>
                </div>
            </div>
        </div>

        <div class="sideBar sideBar-level2" id="try-it-on" data-step="8">
            <div class="sideBar-block">
                <p class="sideBar-block-title">Try It On</p>
                <ul>
                    <li>
                        Insert Try It On
                    </li>
                </ul>
            </div>

            <div class="acceptCancel">
                <div class="accept">
                    <span>
                        <i class="fal fa-check"></i>
                        <p>Accept</p>
                    </span>
                </div>

                <div class="cancel">
                    <span>
                        <i class="fal fa-times"></i>
                        <p>Cancel</p>
                    </span>
                </div>

            </div>
        </div>
    </div>
</div>



