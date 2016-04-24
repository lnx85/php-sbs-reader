
(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:SBS" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="SBS.html">SBS</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:SBS_Message" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="SBS/Message.html">Message</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:SBS_Message_AIR" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="SBS/Message/AIR.html">AIR</a>                    </div>                </li>                            <li data-name="class:SBS_Message_CLK" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="SBS/Message/CLK.html">CLK</a>                    </div>                </li>                            <li data-name="class:SBS_Message_ID" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="SBS/Message/ID.html">ID</a>                    </div>                </li>                            <li data-name="class:SBS_Message_MSG" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="SBS/Message/MSG.html">MSG</a>                    </div>                </li>                            <li data-name="class:SBS_Message_SEL" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="SBS/Message/SEL.html">SEL</a>                    </div>                </li>                            <li data-name="class:SBS_Message_STA" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="SBS/Message/STA.html">STA</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:SBS_Message" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="SBS/Message.html">Message</a>                    </div>                </li>                            <li data-name="class:SBS_Reader" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="SBS/Reader.html">Reader</a>                    </div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "SBS.html", "name": "SBS", "doc": "Namespace SBS"},{"type": "Namespace", "link": "SBS/Message.html", "name": "SBS\\Message", "doc": "Namespace SBS\\Message"},
            
            {"type": "Class", "fromName": "SBS", "fromLink": "SBS.html", "link": "SBS/Message.html", "name": "SBS\\Message", "doc": "&quot;Message class is the abstract representation of an SBS-1 Message. It describes general\nmessage attributes.&quot;"},
                                                        {"type": "Method", "fromName": "SBS\\Message", "fromLink": "SBS/Message.html", "link": "SBS/Message.html#method_getType", "name": "SBS\\Message::getType", "doc": "&quot;Get message type.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message", "fromLink": "SBS/Message.html", "link": "SBS/Message.html#method_is", "name": "SBS\\Message::is", "doc": "&quot;Check message type.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message", "fromLink": "SBS/Message.html", "link": "SBS/Message.html#method_getTransmissionType", "name": "SBS\\Message::getTransmissionType", "doc": "&quot;Get transmission type.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message", "fromLink": "SBS/Message.html", "link": "SBS/Message.html#method_getSessionId", "name": "SBS\\Message::getSessionId", "doc": "&quot;Get session identifier.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message", "fromLink": "SBS/Message.html", "link": "SBS/Message.html#method_getAircraftId", "name": "SBS\\Message::getAircraftId", "doc": "&quot;Get aircraft identifier.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message", "fromLink": "SBS/Message.html", "link": "SBS/Message.html#method_getModeS", "name": "SBS\\Message::getModeS", "doc": "&quot;Get Mode S identifier.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message", "fromLink": "SBS/Message.html", "link": "SBS/Message.html#method_getFlight", "name": "SBS\\Message::getFlight", "doc": "&quot;Get flight.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message", "fromLink": "SBS/Message.html", "link": "SBS/Message.html#method_getGenerated", "name": "SBS\\Message::getGenerated", "doc": "&quot;Get message generation date\/time.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message", "fromLink": "SBS/Message.html", "link": "SBS/Message.html#method_getLogged", "name": "SBS\\Message::getLogged", "doc": "&quot;Get message logged date\/time.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message", "fromLink": "SBS/Message.html", "link": "SBS/Message.html#method_factory", "name": "SBS\\Message::factory", "doc": "&quot;Create a new SBS Message.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message", "fromLink": "SBS/Message.html", "link": "SBS/Message.html#method_serialize", "name": "SBS\\Message::serialize", "doc": "&quot;Serialize object.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message", "fromLink": "SBS/Message.html", "link": "SBS/Message.html#method_unserialize", "name": "SBS\\Message::unserialize", "doc": "&quot;Unserialize object.&quot;"},
            
            {"type": "Class", "fromName": "SBS\\Message", "fromLink": "SBS/Message.html", "link": "SBS/Message/AIR.html", "name": "SBS\\Message\\AIR", "doc": "&quot;AIR Message class.&quot;"},
                    
            {"type": "Class", "fromName": "SBS\\Message", "fromLink": "SBS/Message.html", "link": "SBS/Message/CLK.html", "name": "SBS\\Message\\CLK", "doc": "&quot;CLK Message class.&quot;"},
                    
            {"type": "Class", "fromName": "SBS\\Message", "fromLink": "SBS/Message.html", "link": "SBS/Message/ID.html", "name": "SBS\\Message\\ID", "doc": "&quot;ID Message class.&quot;"},
                                                        {"type": "Method", "fromName": "SBS\\Message\\ID", "fromLink": "SBS/Message/ID.html", "link": "SBS/Message/ID.html#method___construct", "name": "SBS\\Message\\ID::__construct", "doc": "&quot;Create a new SEL.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\ID", "fromLink": "SBS/Message/ID.html", "link": "SBS/Message/ID.html#method_getCallsign", "name": "SBS\\Message\\ID::getCallsign", "doc": "&quot;Get callsign.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\ID", "fromLink": "SBS/Message/ID.html", "link": "SBS/Message/ID.html#method_serialize", "name": "SBS\\Message\\ID::serialize", "doc": "&quot;Serialize object.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\ID", "fromLink": "SBS/Message/ID.html", "link": "SBS/Message/ID.html#method_unserialize", "name": "SBS\\Message\\ID::unserialize", "doc": "&quot;Unserialize object.&quot;"},
            
            {"type": "Class", "fromName": "SBS\\Message", "fromLink": "SBS/Message.html", "link": "SBS/Message/MSG.html", "name": "SBS\\Message\\MSG", "doc": "&quot;MSG Message class.&quot;"},
                                                        {"type": "Method", "fromName": "SBS\\Message\\MSG", "fromLink": "SBS/Message/MSG.html", "link": "SBS/Message/MSG.html#method___construct", "name": "SBS\\Message\\MSG::__construct", "doc": "&quot;Create a new MSG.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\MSG", "fromLink": "SBS/Message/MSG.html", "link": "SBS/Message/MSG.html#method_getCallsign", "name": "SBS\\Message\\MSG::getCallsign", "doc": "&quot;Get callsign.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\MSG", "fromLink": "SBS/Message/MSG.html", "link": "SBS/Message/MSG.html#method_getAltitude", "name": "SBS\\Message\\MSG::getAltitude", "doc": "&quot;Get altitude.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\MSG", "fromLink": "SBS/Message/MSG.html", "link": "SBS/Message/MSG.html#method_getGroundSpeed", "name": "SBS\\Message\\MSG::getGroundSpeed", "doc": "&quot;Get ground speed.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\MSG", "fromLink": "SBS/Message/MSG.html", "link": "SBS/Message/MSG.html#method_getTrack", "name": "SBS\\Message\\MSG::getTrack", "doc": "&quot;Get track.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\MSG", "fromLink": "SBS/Message/MSG.html", "link": "SBS/Message/MSG.html#method_getLatitude", "name": "SBS\\Message\\MSG::getLatitude", "doc": "&quot;Get latitude.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\MSG", "fromLink": "SBS/Message/MSG.html", "link": "SBS/Message/MSG.html#method_getLongitude", "name": "SBS\\Message\\MSG::getLongitude", "doc": "&quot;Get longitude.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\MSG", "fromLink": "SBS/Message/MSG.html", "link": "SBS/Message/MSG.html#method_getVerticalRate", "name": "SBS\\Message\\MSG::getVerticalRate", "doc": "&quot;Get vertical rate.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\MSG", "fromLink": "SBS/Message/MSG.html", "link": "SBS/Message/MSG.html#method_getSquawk", "name": "SBS\\Message\\MSG::getSquawk", "doc": "&quot;Get squawk.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\MSG", "fromLink": "SBS/Message/MSG.html", "link": "SBS/Message/MSG.html#method_isAlert", "name": "SBS\\Message\\MSG::isAlert", "doc": "&quot;Get alert flag, squawk has changed.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\MSG", "fromLink": "SBS/Message/MSG.html", "link": "SBS/Message/MSG.html#method_isEmergency", "name": "SBS\\Message\\MSG::isEmergency", "doc": "&quot;Get emergency flag.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\MSG", "fromLink": "SBS/Message/MSG.html", "link": "SBS/Message/MSG.html#method_isSpi", "name": "SBS\\Message\\MSG::isSpi", "doc": "&quot;Get SPI flag, transponder ident has been activated.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\MSG", "fromLink": "SBS/Message/MSG.html", "link": "SBS/Message/MSG.html#method_isOnGround", "name": "SBS\\Message\\MSG::isOnGround", "doc": "&quot;Get on ground flag, ground squat switch is active.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\MSG", "fromLink": "SBS/Message/MSG.html", "link": "SBS/Message/MSG.html#method_serialize", "name": "SBS\\Message\\MSG::serialize", "doc": "&quot;Serialize object.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\MSG", "fromLink": "SBS/Message/MSG.html", "link": "SBS/Message/MSG.html#method_unserialize", "name": "SBS\\Message\\MSG::unserialize", "doc": "&quot;Unserialize object.&quot;"},
            
            {"type": "Class", "fromName": "SBS\\Message", "fromLink": "SBS/Message.html", "link": "SBS/Message/SEL.html", "name": "SBS\\Message\\SEL", "doc": "&quot;SEL Message class.&quot;"},
                                                        {"type": "Method", "fromName": "SBS\\Message\\SEL", "fromLink": "SBS/Message/SEL.html", "link": "SBS/Message/SEL.html#method___construct", "name": "SBS\\Message\\SEL::__construct", "doc": "&quot;Create a new SEL.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\SEL", "fromLink": "SBS/Message/SEL.html", "link": "SBS/Message/SEL.html#method_getCallsign", "name": "SBS\\Message\\SEL::getCallsign", "doc": "&quot;Get callsign.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\SEL", "fromLink": "SBS/Message/SEL.html", "link": "SBS/Message/SEL.html#method_serialize", "name": "SBS\\Message\\SEL::serialize", "doc": "&quot;Serialize object.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Message\\SEL", "fromLink": "SBS/Message/SEL.html", "link": "SBS/Message/SEL.html#method_unserialize", "name": "SBS\\Message\\SEL::unserialize", "doc": "&quot;Unserialize object.&quot;"},
            
            {"type": "Class", "fromName": "SBS\\Message", "fromLink": "SBS/Message.html", "link": "SBS/Message/STA.html", "name": "SBS\\Message\\STA", "doc": "&quot;STA Message class.&quot;"},
                    
            {"type": "Class", "fromName": "SBS", "fromLink": "SBS.html", "link": "SBS/Reader.html", "name": "SBS\\Reader", "doc": "&quot;Reader class is an implementation of SBS-1 Base Station protocol. It can\nconnect to a remote data provider and it can read data in SBS1 (BaseStation)\nformat.&quot;"},
                                                        {"type": "Method", "fromName": "SBS\\Reader", "fromLink": "SBS/Reader.html", "link": "SBS/Reader.html#method___construct", "name": "SBS\\Reader::__construct", "doc": "&quot;Create a new SBS\\Reader.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Reader", "fromLink": "SBS/Reader.html", "link": "SBS/Reader.html#method_connect", "name": "SBS\\Reader::connect", "doc": "&quot;Connect to source (dump1090).&quot;"},
                    {"type": "Method", "fromName": "SBS\\Reader", "fromLink": "SBS/Reader.html", "link": "SBS/Reader.html#method_run", "name": "SBS\\Reader::run", "doc": "&quot;Main reader loop.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Reader", "fromLink": "SBS/Reader.html", "link": "SBS/Reader.html#method_onConnect", "name": "SBS\\Reader::onConnect", "doc": "&quot;Event method called everytime the Reader connects to the remote source. You can check hostname,\nport and timeout settings used for the connection.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Reader", "fromLink": "SBS/Reader.html", "link": "SBS/Reader.html#method_onDataReceive", "name": "SBS\\Reader::onDataReceive", "doc": "&quot;Event method called everytime the Reader receive some data. An array with the received data is\npassed to the method and you can test what values where received.&quot;"},
                    {"type": "Method", "fromName": "SBS\\Reader", "fromLink": "SBS/Reader.html", "link": "SBS/Reader.html#method_onMessage", "name": "SBS\\Reader::onMessage", "doc": "&quot;Event method called everytime the Reader processed a Message. You get the entire \\SBS\\Message\nobject, the message type and the transmission type (only on MSG messages).&quot;"},
                    {"type": "Method", "fromName": "SBS\\Reader", "fromLink": "SBS/Reader.html", "link": "SBS/Reader.html#method_onError", "name": "SBS\\Reader::onError", "doc": "&quot;Event method called everytime an error occured. You get the error number and the error message.&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


