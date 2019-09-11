$(document).on('click', '.volunteerExportFiscal', function () {
    const self = $(this);
    const exprotType = self.attr('data-export-type');
    const request = $('#siteSettingsFilter').serializeArray().filter(x => !!x.value);
    return console.log(request);
    window.open('fgp_reports/generate/volunteerReportFiscal/' + exprotType);
});