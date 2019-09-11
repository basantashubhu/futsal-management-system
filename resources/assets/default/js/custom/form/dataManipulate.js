
function arrangeData(multi) {
    var data = {};
    var multi_data = [];
    var sr = {};
    $.each(multi, function(i, v) {
        $('.' + v).each(function(i1, v1) {
            sr = {};
            $(this).find(':input').each(function(index, val3) {
                sr[$(this).attr("name")] = $(this).val();
            });
            multi_data.push(sr);
        });
        data[v] = multi_data;
        multi_data = [];
    });
    return data;
}