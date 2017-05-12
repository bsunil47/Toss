jQuery.noConflict();
var Script = function () {
    jQuery(".sparkline").each(function(){
        var jQuerydata = jQuery(this).data();

        jQuerydata.valueSpots = {'0:': jQuerydata.spotColor};

        jQuery(this).sparkline( jQuerydata.data || "html", jQuerydata,
            {
                tooltipFormat: '<span style="display:block; padding:0px 10px 12px 0px;">' +
                    '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{percent.1}}%)</span>'
            });
    });


    //income expense progress bar

    jQuery("#balance").sparkline([87,109,111,95,120,99,87,100,67,75,65,87], {
        type: 'bar',
        height: '32',
        barWidth: 5,
        barSpacing: 2,
        barColor: '#c5c5ca'
    });

    jQuery("#item-sold").sparkline([102,109,90,120,70,99,110,80,87,50,65,74], {
        type: 'bar',
        height: '32',
        barWidth: 5,
        barSpacing: 2,
        barColor: '#c5c5ca'
    });

    jQuery("#foreign-visit").sparkline([102,109,120,99,110,80,87,74], {
        type: 'bar',
        height: '32',
        barWidth: 5,
        barSpacing: 2,
        barColor: '#79d4a7'
    });

    jQuery("#monthly-visit").sparkline([99,110,80,102,109,120,87,74], {
        type: 'bar',
        height: '32',
        barWidth: 5,
        barSpacing: 2,
        barColor: '#f47669'
    });

    jQuery("#unique-visit").sparkline([110,105,99,110,102,109,120], {
        type: 'bar',
        height: '32',
        barWidth: 5,
        barSpacing: 2,
        barColor: '#57c8f1'
    });

    jQuery("#page-view-graph").sparkline([102,109,90,120,70,99,110,80,87,50,65,74,102,109,90,120,70,99,110], {
        type: 'bar',
        height: '35',
        barWidth: 5,
        barSpacing: 2,
        barColor: '#a979d1'
    });

    jQuery("#m-g-light").sparkline([102,109,90,120,70,99,110,80,87,50,65,74,102,109,90,120,70,99,110], {
        type: 'bar',
        height: '35',
        barWidth: 5,
        barSpacing: 2,
        barColor: '#e4e4e4'
    });

    jQuery("#m-g-dark").sparkline([102,109,90,120,70,99,110,80,87,50,65,74,102,109,90,120,70,99,110], {
        type: 'bar',
        height: '35',
        barWidth: 5,
        barSpacing: 2,
        barColor: '#5f5f5f'
    });



    jQuery(".weather-chart").each(function(){
        var jQuerydata = jQuery(this).data();

        jQuerydata.valueSpots = {'0:': jQuerydata.spotColor};

        jQuery(this).sparkline( jQuerydata.data || "html", jQuerydata,
            {
                tooltipFormat: '<span style="display:block; padding:0px 10px 12px 0px;">' +
                    '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{percent.1}}%)</span>'
            });




    });


}();
