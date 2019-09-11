
var fs = require('fs'),
    args = require('system').args,
    page = require('webpage').create();

page.content = fs.read(args[1]);

page.paperSize = {
    format: 'A4',
    orientation: 'portrait',
    footer: {
        height: "1cm",
        contents: phantom.callback(function(pageNum, numPages) {
            return "<span style='float:right;font-size:11px;'>" + pageNum + " / " + numPages + "</span>";
        })
    }
};

window.setTimeout(function () {
    page.render(args[1],{format: 'pdf', quality: '100'});
    phantom.exit();
}, 1000);
