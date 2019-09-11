
var fs = require('fs'),
    args = require('system').args,
    page = require('webpage').create();

page.content = fs.read(args[1]);

page.paperSize = {
    format: 'A4',
    orientation: 'portrait',
    margin: {
        top: '0cm',
        bottom: '0.5cm',
        left: '0.5cm',
        right: '0.5cm',
    },
    footer: {
        height: "1.5cm",
        contents: phantom.callback(function(pageNum, numPages) {
            return "<div style='width: 100%; text-transform: uppercase; text-align: center; font-family: Poppins, sans-serif; font-size: 12px; line-height: 11px; color: #153643;'><hr><strong>Herman holloway campus . carvel building . new castle . DELAWARE</strong><br><strong>mailing address: 1901 N. DU Pont HWY . NEW CASTLE . DELAWARE . 19720</strong><br><span style='float:right;font-size:11px;'>" + pageNum + " / " + numPages + "</span>"+
            "</div>";
        })
    }
};

window.setTimeout(function () {
    page.render(args[1],{format: 'pdf', quality: '100'});
    phantom.exit();
}, 1000);
