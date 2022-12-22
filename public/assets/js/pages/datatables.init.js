// $.DataTableInit = function(selector = '.table',res = false,url = false,data = {}){
$.DataTableInit = function(res){
    var config = {};
    var reqsno = 0;

    if ( typeof res.config !== 'undefined' && res.config != false) {
        config = res.config;
    }
    if ( typeof res.url !== 'undefined' && res.url != false) {
        config['serverSide'] = true;
        data = {};
        if ( typeof res.data !== 'undefined' && res.data != false) {
            data = res.data;
        }
        data['_token'] = $('meta[name="csrf-token"]').attr('content');
        config['ajax'] = {
            url: res.url,
            type: "POST",
            data: data,
            beforeSend: function() {
                reqsno++;
                if(reqsno > 1){
                    $(res.selector).dataTableSettings[0].jqXHR.abort();
                }
            }
        };
    }
    config['aLengthMenu'] = [[ 10, 20, 50, 100 ,-1],[10,20,50,100,"All"]];
    config['dom'] = 'Blfrtip';
    config['buttons'] = ["csv", "excel"];
    new DataTable(res.selector,config);
    // $(res.selector).DataTable(config);

}